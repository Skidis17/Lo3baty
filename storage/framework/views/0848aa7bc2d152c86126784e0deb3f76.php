

<?php $__env->startSection('content'); ?>
<div class="p-6 max-w-2xl mx-auto bg-white shadow-md rounded">
    <h1 class="text-2xl font-semibold mb-4"><?php echo e($product->nom); ?></h1>
    

    <?php if($product->images->isNotEmpty()): ?>
        <div class="mb-6">
            <h2 class="text-sm text-gray-500 mb-2">Image du produit</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(asset('storage/' . $image->url)); ?>" alt="Image de <?php echo e($product->nom); ?>" class="w-full h-48 object-cover rounded border" />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php else: ?>
        <p class="text-sm text-gray-400 italic mb-6">Aucune image pour ce produit.</p>
    <?php endif; ?>


    <dl class="space-y-3">
        <div>
            <dt class="text-sm text-gray-500">Description</dt>
            <dd class="text-gray-700"><?php echo e($product->description); ?></dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Catégorie</dt>
            <dd class="text-gray-700"><?php echo e($product->categorie->nom ?? '—'); ?></dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">Ville</dt>
            <dd class="text-gray-700"><?php echo e($product->ville); ?></dd>
        </div>
        <div>
            <dt class="text-sm text-gray-500">État</dt>
            <dd class="text-gray-700"><?php echo e($product->etat); ?></dd>
        </div>
    </dl>

    <div class="mt-6">
        <a href="<?php echo e(route('partner.products.index')); ?>" class="text-blue-500 hover:underline">← Retour</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\laravelWeb\resources\views/partner/products/show.blade.php ENDPATH**/ ?>