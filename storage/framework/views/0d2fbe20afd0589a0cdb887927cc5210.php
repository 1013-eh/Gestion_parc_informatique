<?php $__env->startSection('title', 'Gestion des Régions'); ?>
<?php $__env->startSection('page-title', '📍 Gestion des Régions'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- En-tête -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i> Liste des régions
                        <span class="ml-2 px-2 py-1 text-sm bg-blue-100 text-blue-800 rounded-full"><?php echo e($regions->count()); ?></span>
                    </h2>
                    <a href="<?php echo e(route('regions.create')); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <i class="fas fa-plus-circle mr-1"></i> Nouvelle région
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

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Libellé</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Abréviation</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Centres</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 text-center text-sm text-gray-500"><?php echo e($loop->iteration); ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <i class="fas fa-flag text-blue-600 mr-2"></i> <?php echo e($region->libelle_region); ?>

                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800"><?php echo e($region->abreviation); ?></span>
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800"><?php echo e($region->centres_count ?? 0); ?></span>
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <div class="flex justify-center items-center space-x-3">
                                        <?php if(auth()->check() && (auth()->user()->matricule ?? null) == 1): ?>

                                            <a href="<?php echo e(route('regions.edit', $region->id_region)); ?>"
                                               class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs font-semibold transition"
                                               title="Modifier">
                                                <i class="fas fa-edit mr-2"></i> Modifier
                                            </a>

                                            <form action="<?php echo e(route('regions.destroy', $region->id_region)); ?>" method="POST" onsubmit="return confirm('Supprimer cette région définitivement ?');">
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
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    <i class="fas fa-inbox fa-2x d-block mb-2 text-gray-300"></i>
                                    Aucune région trouvée
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Gestion_parc_informatique\resources\views/regions/index.blade.php ENDPATH**/ ?>