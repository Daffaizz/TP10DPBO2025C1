<?php include 'views/template/header.php'; ?>

<div class="flex justify-center items-center mb-6">
    <h2 class="text-2xl font-bold">
        <?= isset($customer) ? 'Edit Pelanggan' : 'Tambah Pelanggan' ?>
    </h2>
</div>

<form method="GET" action="index.php">
    <input type="hidden" name="tab" value="customer">
    <input type="hidden" name="action" value="<?= isset($customer) ? 'update' : 'create' ?>">
    <input type="hidden" name="submit" value="true">
    <?php if (isset($customer)) : ?>
        <input type="hidden" name="id" value="<?= $customer['id'] ?>">
    <?php endif; ?>

    <div class="mt-5 p-4 bg-white border border-gray-200 rounded-md shadow-sm">
        <label class="block text-gray-700 font-medium mb-1">Nama:</label>
        <input type="text" name="name" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($customer) ? htmlspecialchars($customer['name']) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">No. Telepon:</label>
        <input type="text" name="phone" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($customer) ? htmlspecialchars($customer['phone']) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">Email:</label>
        <input type="email" name="email" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($customer) ? htmlspecialchars($customer['email']) : '' ?>" required>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-2">
            <?= isset($customer) ? 'Update' : 'Tambah' ?>
        </button>
        <a href="index.php?tab=customer" class="px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</form>

<?php include 'views/template/footer.php'; ?>
