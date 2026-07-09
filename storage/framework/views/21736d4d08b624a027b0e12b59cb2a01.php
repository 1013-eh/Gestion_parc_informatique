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
            <?php echo e(__('Ajouter une archive')); ?>

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

                <div class="mb-6 p-4 bg-gray-50 rounded border border-gray-200 space-y-1">
                    <p><span class="font-medium">N° Série :</span> <?php echo e($materiel->num_serie); ?></p>
                    <p><span class="font-medium">Marque :</span> <?php echo e($materiel->modele?->marque?->nom_marque ?? 'N/A'); ?></p>
                    <p><span class="font-medium">Modèle :</span> <?php echo e($materiel->modele?->nom_modele ?? 'N/A'); ?></p>
                </div>

                <form action="<?php echo e(route('archive.store')); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="num_serie" value="<?php echo e($materiel->num_serie); ?>">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <input type="text" name="description" value="<?php echo e(old('description')); ?>"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                            <?php echo e(__('Ajouter')); ?>

                        </button>

                        <a href="<?php echo e(route('archive.create')); ?>" class="text-gray-600 hover:underline">
                            <?php echo e(__('Annuler')); ?>

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
<?php endif; ?><?php /**PATH C:\Users\Asus Laptop\Documents\Vs Code\Gestion_parc_informatique\resources\views/archive/createForm.blade.php ENDPATH**/ ?>