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
            <?php echo e(__('Choisir un matériel à archiver')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="GET" action="<?php echo e(route('archive.create')); ?>" class="flex gap-2 mb-6">
                    <input type="text" name="search" value="<?php echo e($search); ?>"
                           placeholder="Rechercher par N° série"
                           class="w-64 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <button type="submit"
                            class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                        Rechercher
                    </button>
                    <?php if($search): ?>
                        <a href="<?php echo e(route('archive.create')); ?>"
                           class="px-4 py-2 text-gray-600 hover:underline">
                            Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full">
                        <thead class="bg-blue-900 text-white">
                            <tr>
                                <th class="p-3 text-left border-r border-blue-800">N° Série</th>
                                <th class="p-3 text-left border-r border-blue-800">Marque</th>
                                <th class="p-3 text-left border-r border-blue-800">Modèle</th>
                                <th class="p-3 text-left border-r border-blue-800">État</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $materiels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materiel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="p-3 border-r"><?php echo e($materiel->num_serie); ?></td>
                                    <td class="p-3 border-r"><?php echo e($materiel->modele?->marque?->nom_marque ?? 'N/A'); ?></td>
                                    <td class="p-3 border-r"><?php echo e($materiel->modele?->nom_modele ?? 'N/A'); ?></td>
                                    <td class="p-3 border-r"><?php echo e($materiel->etat); ?></td>
                                    <td class="p-3">
                                        <a href="<?php echo e(route('archive.createForm', $materiel->num_serie)); ?>"
                                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            Choisir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-gray-500">
                                        Aucun matériel hors usage trouvé.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pt-4">
                    <a href="<?php echo e(route('archive.index')); ?>" class="text-gray-600 hover:underline">
                        <?php echo e(__('Retour à la liste')); ?>

                    </a>
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
<?php endif; ?><?php /**PATH C:\Users\Asus Laptop\Documents\Vs Code\Gestion_parc_informatique\resources\views/archive/create.blade.php ENDPATH**/ ?>