

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

    <form method="GET" class="mb-4 flex flex-wrap items-center gap-4">
        <div>
            <label for="categorie_id" class="text-sm text-gray-700">Catégorie</label>
            <select name="categorie_id" id="categorie_id" class="block w-full border rounded px-3 py-1.5">
                <option value="">Toutes</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($categorie->id); ?>" <?php echo e(request('categorie_id') == $categorie->id ? 'selected' : ''); ?>>
                        <?php echo e($categorie->nom); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label for="etat" class="text-sm text-gray-700">État</label>
            <select name="etat" id="etat" class="block w-full border rounded px-3 py-1.5">
                <option value="">Tous</option>
                <option value="neuf" <?php echo e(request('etat') == 'neuf' ? 'selected' : ''); ?>>Neuf</option>
                <option value="bon état" <?php echo e(request('etat') == 'bon état' ? 'selected' : ''); ?>>Bon état</option>
                <option value="usé" <?php echo e(request('etat') == 'usé' ? 'selected' : ''); ?>>Usé</option>
            </select>
        </div>

        <div class="self-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Filtrer
            </button>
        </div>
    </form>

    <a href="<?php echo e(route('partner.products.index')); ?>" class="text-sm text-gray-500 hover:text-gray-700 underline">
        Réinitialiser les filtres
    </a>

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <?php
                        $isNomAsc = request('sort_nom') === 'asc';
                        $isNomDesc = request('sort_nom') === 'desc';
                        $nextSortNom = $isNomAsc ? 'desc' : 'asc';
                    ?>

                    <th class="p-3 text-left">
                        <a href="<?php echo e(route('partner.products.index', array_merge(request()->except('sort_nom'), ['sort_nom' => $nextSortNom]))); ?>"
                        class="flex items-center gap-1 text-gray-700 hover:text-blue-600">
                            Nom
                            <?php if($isNomAsc): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                </svg>
                            <?php elseif($isNomDesc): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            <?php else: ?>
                                <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th class="p-3">Catégorie</th>
                    <?php
                        $isAsc = request('sort_price') === 'asc';
                        $isDesc = request('sort_price') === 'desc';
                        $nextSort = $isAsc ? 'desc' : 'asc';
                    ?>

                    <th class="p-3">
                        <a href="<?php echo e(route('partner.products.index', array_merge(request()->query(), ['sort_price' => $nextSort]))); ?>"
                        class="flex items-center gap-1 text-gray-700 hover:text-blue-600">
                            Prix
                            <?php if($isAsc): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                </svg>
                            <?php elseif($isDesc): ?>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            <?php else: ?>
                                <svg class="w-4 h-4 opacity-30" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            <?php endif; ?>
                        </a>
                    </th>
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
                        <a href="<?php echo e(route('partner.products.show', $product)); ?>" class="text-gray-600 hover:underline">Voir</a>
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