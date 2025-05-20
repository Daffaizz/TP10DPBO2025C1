<?php
require_once 'config/Database.php';

class Booking {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create (Tambah booking)
    public function create($customer_id, $field_id, $start_time, $end_time, $total_price) {
        $sql = "INSERT INTO bookings (customer_id, field_id, start_time, end_time, total_price) 
                VALUES (:customer_id, :field_id, :start_time, :end_time, :total_price)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':customer_id' => $customer_id,
            ':field_id' => $field_id,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':total_price' => $total_price
        ]);
    }

    // Read All (Tampilkan semua booking)
    public function getAll() {
        $sql = "SELECT b.*, f.name AS field_name, c.name AS customer_name 
                FROM bookings b
                JOIN fields f ON b.field_id = f.id
                JOIN customers c ON b.customer_id = c.id";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID (ambil 1 booking)
    public function getById($id) {
        $sql = "SELECT * FROM bookings WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $customer_id, $field_id, $start_time, $end_time, $total_price) {
        $sql = "UPDATE bookings SET customer_id = :customer_id, field_id = :field_id,
                start_time = :start_time, end_time = :end_time, total_price = :total_price 
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':customer_id' => $customer_id,
            ':field_id' => $field_id,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':total_price' => $total_price
        ]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM bookings WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>