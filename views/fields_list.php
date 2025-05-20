<?php include 'views/template/header.php'; ?>

<div class="flex justify-center items-center mb-6">
    <h2 class="text-2xl font-bold">Daftar Lapangan</h2>
</div>
<div class="flex justify-end mb-4 mr-4">
    <a href="index.php?tab=field&action=form" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        + Tambah Lapangan
    </a>
</div>

<!-- Error Messages -->
<?php if(isset($_GET['error']) && $_GET['error'] == 'create_failed'): ?>
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <p><strong>Error:</strong> Gagal menambahkan lapangan. Mohon cek data yang dimasukkan dan coba lagi.</p>
</div>
<?php endif; ?>

<?php if (!empty($fields)) : ?>
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lapangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Lapangan</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Jam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php foreach ($fields as $i => $field) : ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $i + 1 ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($field['name']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700"><?= htmlspecialchars($field['type']) ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp<?= number_format($field['price_per_hour'], 0, ',', '.') ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" href="index.php?tab=field&action=form&id=<?= $field['id'] ?>">Edit</a>
                        <a class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" href="index.php?tab=field&action=delete&id=<?= $field['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                    </td>
                </tr>            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php else : ?>
    <p class="text-gray-500 italic mt-4">Tidak ada data lapangan.</p>
<?php endif; ?>

<?php include 'views/template/footer.php'; ?>
