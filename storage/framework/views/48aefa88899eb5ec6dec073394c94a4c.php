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
            <?php echo e(__('Importer des matériels (Excel)')); ?>

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

                <div class="mb-6">
                    <a href="<?php echo e(route('materiels.import.template')); ?>"
                       class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-500">
                        Télécharger le template
                    </a>
                </div>

                <form action="<?php echo e(route('materiels.import.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700">
                            Fichier Excel (.xlsx, .xls, .csv)
                        </label>
                        <input type="file" name="file" id="file" accept=".xlsx,.xls,.csv" required
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">
                            Importer
                        </button>
                        <a href="<?php echo e(route('materiels.index')); ?>"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Annuler
                        </a>
                    </div>
                </form> 
                
                <div class="mt-8 p-4 bg-blue-50 rounded">
                    <h4 class="font-semibold text-blue-800 mb-2">Format attendu du fichier :</h4>
                    <p class="text-sm text-gray-700">
                        Le fichier doit contenir les colonnes suivantes (avec en-têtes) :
                    </p>
                    <ul class="list-disc pl-5 mt-2 text-sm text-gray-700">
                        <li><strong>num_serie</strong> : SN suivi de 8 caractères alphanumériques (ex: SN A1B2C3D4)</li>
                        <li><strong>famille</strong> : Nom de la famille (ex: Poste de Travail)</li>
                        <li><strong>sous_famille</strong> : Nom de la sous-famille (ex: PC Fixe)</li>
                        <li><strong>marque</strong> : Nom de la marque (ex: HP)</li>
                        <li><strong>modele</strong> : Nom du modèle (ex: ProBook 450)</li>
                        <li><strong>code_bureau</strong> : Code du centre (ex: 96518)</li>
                        <li><strong>date_affectation</strong> : Date au format YYYY-MM-DD</li>
                        <li><strong>etat</strong> : BON, EN_PANNE ou HORS_USAGE</li>
                    </ul>
                    <p class="text-sm text-gray-600 mt-2 italic">
                        Les champs CAB, N° Marché, Machine et N° Ordre sont générés automatiquement.
                    </p>
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
<?php endif; ?><?php /**PATH C:\Users\Asus Laptop\Documents\Vs Code\Gestion_parc_informatique\resources\views/materiels/import.blade.php ENDPATH**/ ?>