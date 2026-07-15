<?php

namespace App\Imports;

use App\Models\Materiel;
use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Centre;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class MaterielsImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsOnError
{
    use Importable, SkipsErrors;

    private ?int $lastMarcheNum = null;
    private ?int $lastCabNum = null;
    private ?string $currentYear = null;
    private array $lastOrdrePerCentre = [];
    private array $validationErrors = [];
    private int $successCount = 0;

    private function normalize(array $row): array
    {
        foreach ($row as $key => $value) {
            if (is_string($value)) {
                $value = preg_replace('/[^\S ]/u', ' ', $value);
                $value = trim($value);
                $row[$key] = $value;
            }
        }
        if (isset($row['date_affectation'])) {
            if (is_numeric($row['date_affectation'])) {
                $row['date_affectation'] = ExcelDate::excelToDateTimeObject($row['date_affectation'])->format('Y-m-d');
            } elseif ($row['date_affectation'] instanceof \DateTimeInterface) {
                $row['date_affectation'] = $row['date_affectation']->format('Y-m-d');
            } else {
                $row['date_affectation'] = \Carbon\Carbon::parse($row['date_affectation'])->format('Y-m-d');
            }
        }
        return $row;
    }

    private function addValidationError(string $message): void
    {
        $this->validationErrors[] = $message;
    }

    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    public function model(array $row)
    {
        $row = $this->normalize($row);

        if (empty($row['num_serie'])) {
            return null;
        }

        $row['num_serie'] = strtoupper($row['num_serie']);

        if (strlen($row['num_serie']) > 15) {
            $this->addValidationError("Le numéro de série '{$row['num_serie']}' dépasse 15 caractères.");
            return null;
        }

        if (!preg_match('/^SN [A-Z0-9]{8}$/', $row['num_serie'])) {
            $this->addValidationError("Le numéro de série '{$row['num_serie']}' ne respecte pas le format SN suivi de 8 caractères alphanumériques (ex: SN A1B2C3D4).");
            return null;
        }

        if (Materiel::find($row['num_serie'])) {
            $this->addValidationError("Le numéro de série '{$row['num_serie']}' existe déjà dans la base.");
            return null;
        }

        $famille = Famille::whereRaw('LOWER(nom_famille) = ?', [strtolower($row['famille'])])->first();
        if (!$famille) {
            $this->addValidationError("Famille '{$row['famille']}' introuvable (SN: {$row['num_serie']}). Valeurs disponibles : " . Famille::pluck('nom_famille')->implode(', '));
            return null;
        }
        $sousFamille = SousFamille::whereRaw('LOWER(nom_sous_famille) = ?', [strtolower($row['sous_famille'])])
            ->where('id_famille', $famille->id_famille)
            ->first();
        if (!$sousFamille) {
            $disponibles = $famille->sousFamilles()->pluck('nom_sous_famille')->implode(', ');
            $this->addValidationError("Sous-famille '{$row['sous_famille']}' introuvable pour '{$famille->nom_famille}' (SN: {$row['num_serie']}). Disponibles : {$disponibles}");
            return null;
        }
        $marque = Marque::whereRaw('LOWER(nom_marque) = ?', [strtolower($row['marque'])])
            ->where('id_sous_famille', $sousFamille->id_sous_famille)
            ->first();
        if (!$marque) {
            $disponibles = $sousFamille->marques()->pluck('nom_marque')->implode(', ');
            $this->addValidationError("Marque '{$row['marque']}' introuvable pour '{$sousFamille->nom_sous_famille}' (SN: {$row['num_serie']}). Disponibles : {$disponibles}");
            return null;
        }
        $modele = Modele::whereRaw('LOWER(nom_modele) = ?', [strtolower($row['modele'])])
            ->where('id_marque', $marque->id_marque)
            ->first();
        if (!$modele) {
            $disponibles = $marque->modeles()->pluck('nom_modele')->implode(', ');
            $this->addValidationError("Modèle '{$row['modele']}' introuvable pour '{$marque->nom_marque}' (SN: {$row['num_serie']}). Disponibles : {$disponibles}");
            return null;
        }

        $allowedEtats = ['BON', 'EN_PANNE', 'HORS_USAGE'];
        $etat = strtoupper($row['etat'] ?? '');
        if (!in_array($etat, $allowedEtats)) {
            $this->addValidationError("État '{$row['etat']}' invalide (SN: {$row['num_serie']}). Valeurs autorisées : " . implode(', ', $allowedEtats) . ".");
            return null;
        }

        if (empty($row['date_affectation'])) {
            $this->addValidationError("La date d'affectation est requise (SN: {$row['num_serie']}).");
            return null;
        }

        try {
            $dateAffectation = \Carbon\Carbon::parse($row['date_affectation']);
            if ($dateAffectation->isAfter(now()->startOfDay())) {
                $this->addValidationError("La date d'affectation '{$row['date_affectation']}' ne peut pas être dans le futur (SN: {$row['num_serie']}).");
                return null;
            }
        } catch (\Exception $e) {
            $this->addValidationError("La date d'affectation '{$row['date_affectation']}' est invalide (SN: {$row['num_serie']}).");
            return null;
        }

        $centre = Centre::where('code_bureau', $row['code_bureau'])->first();
        if (!$centre) {
            $this->addValidationError("Centre '{$row['code_bureau']}' introuvable (SN: {$row['num_serie']}).");
            return null;
        }

        $machine = null;
        $num_ordre = null;
        $isPosteDeTravail = strtolower($famille->nom_famille) === 'poste de travail';

        if ($isPosteDeTravail) {
            $centre = Centre::where('code_bureau', $row['code_bureau'])->lockForUpdate()->first();
            if (!$centre->relationLoaded('region') && !$centre->region) {
                $this->addValidationError("Région non définie pour le centre '{$centre->code_bureau}' (SN: {$row['num_serie']}).");
                return null;
            }
            $regionAbbr = $centre->region->abreviation;

            if (!isset($this->lastOrdrePerCentre[$row['code_bureau']])) {
                $maxOrdre = Materiel::where('code_bureau', $row['code_bureau'])
                    ->whereNotNull('num_ordre')
                    ->max('num_ordre');
                $numOrdre = max(($centre->dernier_num_ordre ?? 0), $maxOrdre ?? 0);
            } else {
                $numOrdre = $this->lastOrdrePerCentre[$row['code_bureau']];
            }

            do {
                $numOrdre++;
                $machine = sprintf('%s%d-%03d', $regionAbbr, $centre->code_bureau, $numOrdre);
                $num_ordre = $numOrdre;
            } while (Materiel::where('machine', $machine)->exists());

            $this->lastOrdrePerCentre[$row['code_bureau']] = $numOrdre;
            $centre->update(['dernier_num_ordre' => $numOrdre]);
        }

        $year = now()->format('Y');
        if ($this->currentYear !== $year) {
            $this->currentYear = $year;
            $lastMarche = Materiel::where('num_marche', 'like', "I-{$year}-%")
                ->orderBy('num_marche', 'desc')->first();
            $this->lastMarcheNum = $lastMarche ? (int) substr($lastMarche->num_marche, -3) : 0;
        }
        $this->lastMarcheNum++;
        $num_marche = sprintf('I-%s-%03d', $year, $this->lastMarcheNum);

        if ($this->lastCabNum === null) {
            $lastCab = Materiel::orderBy('cab', 'desc')->first();
            $this->lastCabNum = $lastCab ? (int) substr($lastCab->cab, 3) : 200000;
        }
        $this->lastCabNum++;
        $cab = 'BAM' . $this->lastCabNum;

        $this->successCount++;

        return new Materiel([
            'num_serie'        => $row['num_serie'],
            'id_modele'        => $modele->id_modele,
            'code_bureau'      => $row['code_bureau'],
            'cab'              => $cab,
            'num_marche'       => $num_marche,
            'date_affectation' => $row['date_affectation'],
            'num_ordre'        => $num_ordre,
            'machine'          => $machine,
            'etat'             => $etat,
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
