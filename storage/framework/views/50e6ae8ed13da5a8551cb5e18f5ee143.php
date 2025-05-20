<div>
    <label class="block text-sm font-medium mb-1">Nom</label>
    <input type="text" name="nom" value="<?php echo e(old('nom', $product->nom ?? '')); ?>" class="w-full border rounded px-3 py-2" required>
</div>

<div>
    <label class="block text-sm font-medium mb-1">Description</label>
    <textarea name="description" class="w-full border rounded px-3 py-2"><?php echo e(old('description', $product->description ?? '')); ?></textarea>
</div>

<div>
    <label class="block text-sm font-medium mb-1">Ville</label>
    <input type="text" name="ville" value="<?php echo e(old('ville', $product->ville ?? '')); ?>" class="w-full border rounded px-3 py-2" required>
</div>


<div>
    <label class="block text-sm font-medium mb-1">État</label>
    <select name="etat" class="w-full border rounded px-3 py-2" required>
        <option value="">-- Sélectionner l'état --</option>
        <option value="neuf" <?php echo e(old('etat', $product->etat ?? '') == 'neuf' ? 'selected' : ''); ?>>Neuf</option>
        <option value="bon_etat" <?php echo e(old('etat', $product->etat ?? '') == 'bon_etat' ? 'selected' : ''); ?>>Bon état</option>
        <option value="use" <?php echo e(old('etat', $product->etat ?? '') == 'use' ? 'selected' : ''); ?>>Usé</option>
    </select>
</div>

<div>
    <label class="block text-sm font-medium mb-1">Catégorie</label>
    <select name="categorie_id" class="w-full border rounded px-3 py-2" required>
        <option value="">-- Choisir une catégorie --</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($categorie->id); ?>" <?php echo e(old('categorie_id', $product->categorie_id ?? '') == $categorie->id ? 'selected' : ''); ?>>
                <?php echo e($categorie->nom); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div>
    <label class="block text-sm font-medium mb-1">Image du produit</label>

    <?php if($product && $product->images->isNotEmpty()): ?>
        <div class="mb-2">
            <img src="<?php echo e(asset('storage/' . $product->images->first()->url)); ?>" alt="Image actuelle"
                 class="w-40 rounded border">
            <p class="text-xs text-gray-500 mt-1">Image actuelle — sera remplacée si une nouvelle est choisie</p>
        </div>
    <?php endif; ?>

    <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
</div>

<?php /**PATH C:\wamp64\www\laravelWeb\resources\views/partner/products/_form.blade.php ENDPATH**/ ?>