<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Matériels')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <?php if(session('success')): ?>
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <a href="<?php echo e(route('materiels.create')); ?>"
                   class="inline-block mb-4 px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                    <?php echo e(__('Ajouter un matériel')); ?>

                </a>

                <div class="overflow-hidden rounded-lg border border-gray-200 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 divide-x divide-gray-200">
                        <thead class="bg-blue-800">
                            <tr class="divide-x divide-blue-700">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">N° Série</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Sous-Famille</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Bureau</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Centre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Marque</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Modèle</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">CAB</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Marché</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Date Affect.</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">N° Ordre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Machine</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">État</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider whitespace-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="<?php echo e($loop->even ? 'bg-gray-50' : 'bg-white'); ?> hover:bg-blue-50 transition-colors divide-x divide-gray-200">
                                    <td class="px-4 py-4 text-sm font-medium text-gray-900 whitespace-nowrap"><?php echo e($m->num_serie); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->modele?->marque?->sousFamille?->nom_sous_famille ?? 'N/A'); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->code_bureau); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->centre?->nom_centre ?? 'N/A'); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->modele?->marque?->nom_marque ?? 'N/A'); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->modele?->nom_modele ?? 'N/A'); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->cab); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->num_marche); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap"><?php echo e($m->date_affectation); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->num_ordre); ?></td>
                                    <td class="px-4 py-4 text-sm text-gray-700 whitespace-nowrap"><?php echo e($m->machine); ?></td>
                                    <td class="px-4 py-4 text-sm whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            <?php echo e($m->etat === 'BON' ? 'bg-green-100 text-green-800' : ''); ?>

                                            <?php echo e($m->etat === 'EN_PANNE' ? 'bg-yellow-100 text-yellow-800' : ''); ?>

                                            <?php echo e($m->etat === 'HORS_USAGE' ? 'bg-red-100 text-red-800' : ''); ?>

                                            <?php echo e($m->etat === 'ARCHIVE' ? 'bg-gray-100 text-gray-800' : ''); ?>">
                                            <?php echo e($m->etat); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center whitespace-nowrap">
                                        <a href="<?php echo e(route('materiels.edit', $m->num_serie)); ?>"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition-colors">
                                            Modifier
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="13" class="px-4 py-8 text-center text-gray-500">
                                        Aucun matériel trouvé.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Asus Laptop\Documents\Vs Code\Gestion_parc_informatique\resources\views/materiels/materiels.blade.php ENDPATH**/ ?>