<?php
require_once 'config/Database.php';

class Field {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }    // Create (Tambah lapangan)
    public function create($name, $type, $price_per_hour) {
        try {
            $sql = "INSERT INTO fields (name, type, price_per_hour) VALUES (:name, :type, :price_per_hour)";
            $stmt = $this->conn->prepare($sql);
            $result = $stmt->execute([
                ':name' => $name,
                ':type' => $type,
                ':price_per_hour' => $price_per_hour
            ]);
            
            if (!$result) {
                error_log("Field creation failed: " . json_encode($stmt->errorInfo()));
            }
            
            return $result;
        } catch (PDOException $e) {
            error_log("Database error in create field: " . $e->getMessage());
            return false;
        }
    }

    // Read All (Tampilkan semua lapangan)
    public function getAll() {
        $sql = "SELECT * FROM fields";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read by ID (ambil 1 lapangan berdasarkan id)
    public function getById($id) {
        $sql = "SELECT * FROM fields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update
    public function update($id, $name, $type, $price_per_hour) {
        $sql = "UPDATE fields SET name = :name, type = :type, price_per_hour = :price_per_hour WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':type' => $type,
            ':price_per_hour' => $price_per_hour
        ]);
    }

    // Delete
    public function delete($id) {
        $sql = "DELETE FROM fields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}

?>