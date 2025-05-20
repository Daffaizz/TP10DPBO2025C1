<?php
require_once 'model/Field.php';

class FieldViewModel {
    private $fieldModel;

    public function __construct($db) {
        $this->fieldModel = new Field($db);
    }

    // Get semua data lapangan
    public function getAllFields() {
        return $this->fieldModel->getAll();
    }

    // Get 1 lapangan by id
    public function getFieldById($id) {
        return $this->fieldModel->getById($id);
    }    // Simpan data baru, validasi sederhana
    public function createField($data) {
        error_log("Create field data: " . json_encode($data));
        
        if(empty($data['name']) || empty($data['type']) || empty($data['price_per_hour'])) {
            error_log("Field validation failed: " . json_encode($data));
            return false; // validasi gagal
        }
        
        $result = $this->fieldModel->create($data['name'], $data['type'], $data['price_per_hour']);
        error_log("Create field result: " . ($result ? "success" : "failed"));
        return $result;
    }

    // Update data lapangan
    public function updateField($id, $data) {
        if(empty($data['name']) || empty($data['type']) || empty($data['price_per_hour'])) {
            return false;
        }
        return $this->fieldModel->update($id, $data['name'], $data['type'], $data['price_per_hour']);
    }

    // Delete lapangan
    public function deleteField($id) {
        return $this->fieldModel->delete($id);
    }
}

?>