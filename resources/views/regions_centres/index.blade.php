@extends('layouts.app')

@section('title', 'Régions et Centres')
@section('page-title', '📍 Régions et Centres')

@section('content')

<!-- ============================================= -->
<!-- STATISTIQUES EN HAUT                          -->
<!-- ============================================= -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-0">Régions</h6>
                    <h2 class="mb-0 fw-bold">{{ $regions->count() }}</h2>
                </div>
                <i class="fas fa-map-marker-alt fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-0">Centres</h6>
                    <h2 class="mb-0 fw-bold">{{ $centres->count() }}</h2>
                </div>
                <i class="fas fa-building fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-0">Utilisateurs</h6>
                    <h2 class="mb-0 fw-bold">{{ \App\Models\User::count() }}</h2>
                </div>
                <i class="fas fa-users fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-0">Matériel</h6>
                    <h2 class="mb-0 fw-bold">{{ \App\Models\Materiel::count() ?? 0 }}</h2>
                </div>
                <i class="fas fa-desktop fa-2x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- ============================================= -->
<!-- TABLEAUX CÔTE À CÔTE                         -->
<!-- ============================================= -->
<div class="row g-4">

    <!-- ========================================== -->
    <!-- TABLEAU RÉGIONS (GAUCHE)                   -->
    <!-- ========================================== -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-map-marker-alt me-2"></i> Régions
                    <span class="badge bg-primary ms-2">{{ $regions->count() }}</span>
                </h5>
                <a href="{{ route('regions.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Nouvelle région
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" width="40">#</th>
                                <th>Libellé</th>
                                <th class="text-center" width="80">Abrév.</th>
                                <th class="text-center" width="70">Centres</th>
                                <th class="text-center" width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($regions as $region)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <i class="fas fa-flag text-primary me-1"></i>
                                    {{ $region->libelle_region }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info">{{ $region->abreviation }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">{{ $region->centres_count ?? 0 }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('regions.show', $region->id_region) }}" 
                                       class="btn btn-sm btn-outline-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('regions.edit', $region->id_region) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Supprimer"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteRegionModal{{ $region->id_region }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                    Aucune région
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TABLEAU CENTRES (DROITE)                   -->
    <!-- ========================================== -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-success">
                    <i class="fas fa-building me-2"></i> Centres
                    <span class="badge bg-success ms-2">{{ $centres->count() }}</span>
                </h5>
                <a href="{{ route('centres.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Nouveau centre
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center" width="40">#</th>
                                <th>Code</th>
                                <th>Nom</th>
                                <th>Région</th>
                                <th class="text-center" width="80">Matricule</th>
                                <th class="text-center" width="120">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($centres as $centre)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><span class="fw-bold text-primary">{{ $centre->code_bureau }}</span></td>
                                <td>{{ Str::limit($centre->entete ?? '—', 20) }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $centre->region->libelle_region ?? 'N/A' }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark">{{ $centre->matricule }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('centres.show', $centre->code_bureau) }}" 
                                       class="btn btn-sm btn-outline-info" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('centres.edit', ['centre' => $centre->code_bureau]) }}"                                       class="btn btn-sm btn-outline-warning" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Supprimer"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteCentreModal{{ $centre->code_bureau }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                                    Aucun centre
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><!-- /row -->

<!-- ============================================= -->
<!-- MODALS                                       -->
<!-- ============================================= -->

@foreach($regions as $region)
<div class="modal fade" id="deleteRegionModal{{ $region->id_region }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Confirmer</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Supprimer <strong>{{ $region->libelle_region }}</strong> ?</p>
                <small class="text-muted">Action irréversible</small>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('regions.destroy', $region->id_region) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach($centres as $centre)
<div class="modal fade" id="deleteCentreModal{{ $centre->code_bureau }}" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i>Confirmer</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Supprimer le centre <strong>{{ $centre->code_bureau }}</strong> ?</p>
                <small class="text-muted">Action irréversible</small>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('centres.destroy', $centre->code_bureau) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash me-1"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection