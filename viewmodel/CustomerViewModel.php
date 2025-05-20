<?php
require_once 'model/Customer.php';

class CustomerViewModel {
    private $customerModel;

    public function __construct($db) {
        $this->customerModel = new Customer($db);
    }

    public function getAllCustomers() {
        return $this->customerModel->getAll();
    }

    public function getCustomerById($id) {
        return $this->customerModel->getById($id);
    }

    public function createCustomer($data) {
        if(empty($data['name']) || empty($data['phone']) || empty($data['email'])) {
            return false;
        }
        return $this->customerModel->create($data['name'], $data['phone'], $data['email']);
    }

    public function updateCustomer($id, $data) {
        if(empty($data['name']) || empty($data['phone']) || empty($data['email'])) {
            return false;
        }
        return $this->customerModel->update($id, $data['name'], $data['phone'], $data['email']);
    }

    public function deleteCustomer($id) {
        return $this->customerModel->delete($id);
    }
}

?>