<?php

namespace App\Imports;

use App\Models\Materiel;
use App\Models\Famille;
use App\Models\SousFamille;
use App\Models\Marque;
use App\Models\Modele;
use App\Models\Centre;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class MaterielsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    use Importable;

    private ?int $lastMarcheNum = null;
    private ?int $lastCabNum = null;
    private ?string $currentYear = null;
    private array $lastOrdrePerCentre = [];

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

    public function model(array $row)
    {
        $row = $this->normalize($row);

        if (empty($row['num_serie'])) {
            return null;
        }

        if (Materiel::find($row['num_serie'])) {
            throw new \Exception("Le numéro de série '{$row['num_serie']}' existe déjà dans la base.");
        }

        $famille = Famille::whereRaw('LOWER(nom_famille) = ?', [strtolower($row['famille'])])->first();
        if (!$famille) {
            throw new \Exception("Famille '{$row['famille']}' introuvable. Valeurs disponibles : " . Famille::pluck('nom_famille')->implode(', '));
        }
        $sousFamille = SousFamille::whereRaw('LOWER(nom_sous_famille) = ?', [strtolower($row['sous_famille'])])
            ->where('id_famille', $famille->id_famille)
            ->first();
        if (!$sousFamille) {
            $disponibles = $famille->sousFamilles()->pluck('nom_sous_famille')->implode(', ');
            throw new \Exception("Sous-famille '{$row['sous_famille']}' introuvable pour '{$famille->nom_famille}'. Disponibles : {$disponibles}");
        }
        $marque = Marque::whereRaw('LOWER(nom_marque) = ?', [strtolower($row['marque'])])
            ->where('id_sous_famille', $sousFamille->id_sous_famille)
            ->first();
        if (!$marque) {
            $disponibles = $sousFamille->marques()->pluck('nom_marque')->implode(', ');
            throw new \Exception("Marque '{$row['marque']}' introuvable pour '{$sousFamille->nom_sous_famille}'. Disponibles : {$disponibles}");
        }
        $modele = Modele::whereRaw('LOWER(nom_modele) = ?', [strtolower($row['modele'])])
            ->where('id_marque', $marque->id_marque)
            ->first();
        if (!$modele) {
            $disponibles = $marque->modeles()->pluck('nom_modele')->implode(', ');
            throw new \Exception("Modèle '{$row['modele']}' introuvable pour '{$marque->nom_marque}'. Disponibles : {$disponibles}");
        }

        $isPosteDeTravail = strtolower($famille->nom_famille) === 'poste de travail';

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

        $machine = null;
        $num_ordre = null;
        if ($isPosteDeTravail) {
            $centre = Centre::where('code_bureau', $row['code_bureau'])
                ->lockForUpdate()
                ->firstOrFail();
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
            } while (Materiel::where('machine', $machine)->exists()
                && isset($this->lastOrdrePerCentre[$row['code_bureau']])
                && $this->lastOrdrePerCentre[$row['code_bureau']] < $numOrdre);

            $this->lastOrdrePerCentre[$row['code_bureau']] = $numOrdre;
            $centre->update(['dernier_num_ordre' => $numOrdre]);
        }

        return new Materiel([
            'num_serie'        => $row['num_serie'],
            'id_modele'        => $modele->id_modele,
            'code_bureau'      => $row['code_bureau'],
            'cab'              => $cab,
            'num_marche'       => $num_marche,
            'date_affectation' => $row['date_affectation'],
            'num_ordre'        => $num_ordre,
            'machine'          => $machine,
            'etat'             => $row['etat'],
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
