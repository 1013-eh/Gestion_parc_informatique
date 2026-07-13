<?php $__env->startSection('title', 'Gestion des Centres'); ?>
<?php $__env->startSection('page-title', '🏢 Gestion des Centres'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-building text-blue-600 mr-2"></i> Liste des centres
                        <span class="ml-2 px-2 py-1 text-sm bg-green-100 text-green-800 rounded-full">
                            <?php echo e($centres->count()); ?>

                        </span>
                    </h2>

                    <a href="<?php echo e(route('centres.create')); ?>" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-plus-circle mr-1"></i> Nouveau centre
                    </a>
                </div>

                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                        <i class="fas fa-check-circle mr-2"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <i class="fas fa-exclamation-circle mr-2"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                    <div>
                        <select name="region" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Toutes les régions</option>
                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($region->id_region); ?>" <?php echo e(request('region') == $region->id_region ? 'selected' : ''); ?>>
                                    <?php echo e($region->libelle_region); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <select name="type" class="w-full border-gray-300 rounded-md text-sm" onchange="this.form.submit()">
                            <option value="">Tous les types</option>
                            <option value="GLOBAL" <?php echo e(request('type') == 'GLOBAL' ? 'selected' : ''); ?>>🌍 Global</option>
                            <option value="PAR_CENTRE" <?php echo e(request('type') == 'PAR_CENTRE' ? 'selected' : ''); ?>>🏢 Par centre</option>
                            <option value="ADMIN" <?php echo e(request('type') == 'ADMIN' ? 'selected' : ''); ?>>🔒 Admin</option>
                        </select>
                    </div>

                    <div>
                        <input
                            type="text"
                            name="search"
                            class="w-full border-gray-300 rounded-md text-sm"
                            placeholder="Rechercher par code, nom ou IP..."
                            value="<?php echo e(request('search')); ?>"
                        />
                    </div>

                    <div>
                        <a href="<?php echo e(route('centres.index')); ?>" class="inline-flex items-center justify-center w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <i class="fas fa-undo mr-1"></i> Réinitialiser
                        </a>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="width:60px">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom du centre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Région</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse IP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider" style="width:160px">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $centres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $centre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-6 py-4 text-center text-sm text-gray-500"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        <strong class="text-blue-600"><?php echo e($centre->code_bureau); ?></strong>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($centre->nom_centre ?? '—'); ?></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <?php echo e($centre->region->libelle_region ?? 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($centre->matricule); ?></td>
                                    <td class="px-6 py-4 text-sm"><code><?php echo e($centre->adresse_ip); ?></code></td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            <?php echo e($centre->type_consultation_libelle ?? 'N/A'); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <div class="flex justify-center items-center space-x-3">
                                            <?php if(auth()->check() && ((auth()->user()->matricule ?? null) == 1)): ?>
                                                <a href="<?php echo e(route('centres.edit', $centre->code_bureau)); ?>"
                                                   class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs font-semibold transition"
                                                   title="Modifier">
                                                    <i class="fas fa-edit mr-2"></i> Modifier
                                                </a>

                                                <form action="<?php echo e(route('centres.destroy', $centre->code_bureau)); ?>" method="POST"
                                                      onsubmit="return confirm('Supprimer ce centre définitivement ?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit"
                                                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs font-semibold transition"
                                                            title="Supprimer">
                                                        <i class="fas fa-trash mr-2"></i> Supprimer
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-sm text-gray-500">
                                        <i class="fas fa-inbox fa-3x text-gray-300 d-block mb-2"></i>
                                        <div class="font-medium text-gray-700 mb-2">Aucun centre trouvé</div>
                                        <a href="<?php echo e(route('centres.create')); ?>" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            <i class="fas fa-plus mr-2"></i> Créer le premier centre
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <?php echo e($centres->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Gestion_parc_informatique\resources\views/centres/index.blade.php ENDPATH**/ ?>