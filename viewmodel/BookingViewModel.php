<?php
require_once 'model/Booking.php';

class BookingViewModel {
    private $bookingModel;

    public function __construct($db) {
        $this->bookingModel = new Booking($db);
    }

    public function getAllBookings() {
        return $this->bookingModel->getAll();
    }

    public function getBookingById($id) {
        return $this->bookingModel->getById($id);
    }

    public function createBooking($data) {
        if(
            empty($data['customer_id']) || empty($data['field_id']) || empty($data['start_time']) || empty($data['end_time']) || empty($data['total_price'])
        ) 
        {
            return false;
        }
        return $this->bookingModel->create(
            $data['customer_id'],
            $data['field_id'],
            $data['start_time'],
            $data['end_time'],
            $data['total_price']
        );
    }

    public function updateBooking($id, $data) {
        if(
            empty($data['customer_id']) || empty($data['field_id']) || empty($data['start_time']) || empty($data['end_time']) || empty($data['total_price'])
        ) {
            return false;
        }
        return $this->bookingModel->update(
            $id,
            $data['customer_id'],
            $data['field_id'],
            $data['start_time'],
            $data['end_time'],
            $data['total_price']
        );
    }

    public function deleteBooking($id) {
        return $this->bookingModel->delete($id);
    }
}

?>