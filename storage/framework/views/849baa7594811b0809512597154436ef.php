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
            <?php echo e(__("Modifier l'archive")); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <?php if($errors->any()): ?>
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('archive.update', $archive->id_archive)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Num série
                        </label>
                        <input type="text" name="num_serie" value="<?php echo e(old('num_serie', $archive->num_serie)); ?>"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <input type="text" name="description" value="<?php echo e(old('description', $archive->description)); ?>"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            État du matériel
                        </label>
                        <select name="etat"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <?php
                                $currentEtat = old('etat', $materiel->etat ?? 'ARCHIVE');
                            ?>
                            <option value="ARCHIVE" <?php echo e($currentEtat === 'ARCHIVE' ? 'selected' : ''); ?>>
                                ARCHIVE (rester archivé)
                            </option>
                            <option value="BON" <?php echo e($currentEtat === 'BON' ? 'selected' : ''); ?>>
                                BON (remettre en service)
                            </option>
                            <option value="EN_PANNE" <?php echo e($currentEtat === 'EN_PANNE' ? 'selected' : ''); ?>>
                                EN_PANNE (remettre en service)
                            </option>
                            <option value="HORS_USAGE" <?php echo e($currentEtat === 'HORS_USAGE' ? 'selected' : ''); ?>>
                                HORS_USAGE (remettre en service)
                            </option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">
                            Choisir un état autre que ARCHIVE renverra ce matériel dans la liste des matériels et supprimera cette archive.
                        </p>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                            <?php echo e(__('Enregistrer')); ?>

                        </button>

                        <a href="<?php echo e(route('archive.index')); ?>" class="text-gray-600 hover:underline">
                            <?php echo e(__('Retour à la liste')); ?>

                        </a>
                    </div>
                </form>

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
<?php endif; ?><?php /**PATH C:\Users\Asus Laptop\Documents\Vs Code\Gestion_parc_informatique\resources\views/archive/edit.blade.php ENDPATH**/ ?>