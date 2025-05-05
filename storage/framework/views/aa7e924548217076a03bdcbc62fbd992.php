

<?php $__env->startSection('content'); ?>
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-6">Modifier le Produit</h1>

    <form action="<?php echo e(route('partner.products.update', $product)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <?php echo $__env->make('partner.products._form', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Mettre à jour</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\laravelWeb\resources\views/partner/products/edit.blade.php ENDPATH**/ ?>