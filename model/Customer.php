<?php
require_once 'config/Database.php';

class Customer {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create (Tambah pelanggan)
    public function create($name, $phone, $email) {
        $sql = "INSERT INTO customers (name, phone, email) VALUES (:name, :phone, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email
        ]);
    }

    // Read All (Tampilkan semua pelanggan)
    public function getAll() {
        $sql = "SELECT * FROM customers";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID (ambil 1 pelanggan)
    public function getById($id) {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $name, $phone, $email) {
        $sql = "UPDATE customers SET name = :name, phone = :phone, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':phone' => $phone,
            ':email' => $email
        ]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

?>