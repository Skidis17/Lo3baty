

<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Mes Produits</h1>
        <a href="<?php echo e(route('partner.products.create')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Ajouter</a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-600 font-medium">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Catégorie</th>
                    <th class="p-3">Prix</th>
                    <th class="p-3">Ville</th>
                    <th class="p-3">État</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?php echo e($product->nom); ?></td>
                    <td class="p-3"><?php echo e($product->categorie->nom ?? '-'); ?></td>
                    <td class="p-3"><?php echo e($product->prix_journalier); ?> MAD/j</td>
                    <td class="p-3"><?php echo e($product->ville); ?></td>
                    <td class="p-3"><?php echo e($product->etat); ?></td>
                    <td class="p-3 text-right space-x-2">
                        <a href="<?php echo e(route('partner.products.edit', $product)); ?>" class="text-blue-500 hover:underline">Modifier</a>
                        <form action="<?php echo e(route('partner.products.destroy', $product)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="text-red-500 hover:underline">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($products->isEmpty()): ?>
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-400">Aucun produit trouvé</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.partner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\laravelWeb\resources\views/partner/products/index.blade.php ENDPATH**/ ?>