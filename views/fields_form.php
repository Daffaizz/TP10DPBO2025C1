<?php include 'views/template/header.php'; ?>

<div class="flex justify-center items-center mb-6">
    <h2 class="text-2xl font-bold">
        <?= isset($field) ? 'Edit Lapangan' : 'Tambah Lapangan' ?>
    </h2>
</div>

<!-- Debug info - remove this later -->
<?php if(isset($_GET['debug'])): ?>
<div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
    <p><strong>Debug Info:</strong></p>
    <p>GET Parameters: <?= json_encode($_GET) ?></p>
</div>
<?php endif; ?>

<form method="GET" action="index.php">
    <input type="hidden" name="tab" value="field">
    <input type="hidden" name="action" value="<?= isset($field) ? 'update' : 'create' ?>">
    <input type="hidden" name="submit" value="true">
    <?php if (isset($field)) : ?>
        <input type="hidden" name="id" value="<?= $field['id'] ?>">
    <?php endif; ?>

    <div class="mt-5 p-4 bg-white border border-gray-200 rounded-md shadow-sm">
        <label class="block text-gray-700 font-medium mb-1">Nama Lapangan:</label>
        <input type="text" name="name" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($field) ? htmlspecialchars($field['name']) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">Jenis Lapangan:</label>
        <input type="text" name="type"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($field) ? htmlspecialchars($field['type']) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">Harga per Jam:</label>
        <input type="number" name="price_per_hour" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($field) ? htmlspecialchars($field['price_per_hour']) : '' ?>" required>

        <div class="flex space-x-2 mt-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <?= isset($field) ? 'Update' : 'Tambah' ?>
            </button>
            <a href="index.php?tab=field" class="px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                Cancel
            </a>
        </div>
    </div>
</form>

<?php include 'views/template/footer.php'; ?>
