<?php include 'views/template/header.php'; ?>

<div class="flex justify-center items-center mb-6">
    <h2 class="text-2xl font-bold">
        <?= isset($booking) ? 'Edit Booking' : 'Tambah Booking' ?>
    </h2>
</div>

<form method="GET" action="index.php" id="bookingForm">
    <input type="hidden" name="tab" value="booking">
    <input type="hidden" name="action" value="<?= isset($booking) ? 'update' : 'create' ?>">
    <input type="hidden" name="submit" value="true">
    <?php if (isset($booking)) : ?>
        <input type="hidden" name="id" value="<?= $booking['id'] ?>">
    <?php endif; ?>

    <div class="mt-5 p-4 bg-white border border-gray-200 rounded-md shadow-sm">
        <label class="block text-gray-700 font-medium mb-1">Pelanggan:</label>
        <select name="customer_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" required>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?= $customer['id'] ?>" <?= (isset($booking) && $booking['customer_id'] == $customer['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($customer['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="block text-gray-700 font-medium mb-1">Lapangan:</label>
        <select name="field_id" id="field_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4" required>
            <?php foreach ($fields as $field) : ?>
                <option value="<?= $field['id'] ?>" data-price="<?= $field['price_per_hour'] ?>" <?= (isset($booking) && $booking['field_id'] == $field['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($field['name']) ?> (<?= $field['type'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label class="block text-gray-700 font-medium mb-1">Waktu Mulai:</label>
        <input type="datetime-local" name="start_time" id="start_time" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($booking) ? date('Y-m-d\TH:i', strtotime($booking['start_time'])) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">Waktu Selesai:</label>
        <input type="datetime-local" name="end_time" id="end_time" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($booking) ? date('Y-m-d\TH:i', strtotime($booking['end_time'])) : '' ?>" required>

        <label class="block text-gray-700 font-medium mb-1">Total Harga:</label>
        <input type="number" name="total_price" id="total_price" 
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
               value="<?= isset($booking) ? htmlspecialchars($booking['total_price']) : '' ?>" required readonly>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-2">
            <?= isset($booking) ? 'Update' : 'Tambah' ?>
        </button>
        <a href="index.php?tab=booking" class="px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
            Cancel
        </a>
    </div>
</form>
<script>
    const fieldSelect = document.getElementById('field_id');
    const startTime = document.getElementById('start_time');
    const endTime = document.getElementById('end_time');
    const totalPrice = document.getElementById('total_price');

    function calculateTotalPrice() {
        const start = new Date(startTime.value);
        const end = new Date(endTime.value);
        const selectedField = fieldSelect.options[fieldSelect.selectedIndex];
        const pricePerHour = parseFloat(selectedField.getAttribute('data-price'));

        if (start && end && !isNaN(pricePerHour) && end > start) {
            const diffMs = end - start;
            const diffHours = diffMs / (1000 * 60 * 60); // convert ms to hours
            const total = Math.round(diffHours * pricePerHour);
            totalPrice.value = total;
        } else {
            totalPrice.value = '';
        }
    }

    fieldSelect.addEventListener('change', calculateTotalPrice);
    startTime.addEventListener('change', calculateTotalPrice);
    endTime.addEventListener('change', calculateTotalPrice);
</script>

<?php include 'views/template/footer.php'; ?>