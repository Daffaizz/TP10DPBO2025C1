<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/Database.php';
require_once 'viewmodel/FieldViewModel.php';
require_once 'viewmodel/CustomerViewModel.php';
require_once 'viewmodel/BookingViewModel.php';

// Inisialisasi koneksi dan viewmodel
$database = new Database();
$db = $database->getConnection();

// Check if connection established
if (!$db) {
    die("Database connection failed. Please check your database settings.");
}

// Check if the database exists and contains tables
try {
    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($tables)) {
        echo "<div style='margin: 20px; padding: 10px; background-color: #ffcccc; border: 1px solid #ff0000;'>";
        echo "<h3>Warning: No tables found in database SuperField</h3>";
        echo "<p>Please run the SQL file 'database/SuperFields.sql' to create the necessary tables.</p>";
        echo "<p>You can do this by copying the content of the file and running it in phpMyAdmin.</p>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<div style='margin: 20px; padding: 10px; background-color: #ffcccc; border: 1px solid #ff0000;'>";
    echo "<h3>Database Error</h3>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "</div>";
}

$fieldVM = new FieldViewModel($db);
$customerVM = new CustomerViewModel($db);
$bookingVM = new BookingViewModel($db);

// Ambil parameter
$tab = $_GET['tab'] ?? 'field';
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;
$submit = isset($_GET['submit']);

// Debug information
error_log("Request parameters: " . json_encode($_GET));
error_log("tab: $tab, action: $action, id: $id, submit: " . ($submit ? 'true' : 'false'));

// Routing berdasarkan tab
switch ($tab) {
    case 'field':
        if ($action === 'create' && $submit) {
            error_log("Creating field with data: " . json_encode($_GET));
            $result = $fieldVM->createField($_GET);
            if ($result) {
                error_log("Field created successfully");
                header("Location: index.php?tab=field");
                exit;
            } else {
                error_log("Field creation failed");
                header("Location: index.php?tab=field&error=create_failed");
                exit;
            }
        } elseif ($action === 'update' && $submit) {
            $fieldVM->updateField($id, $_GET);
            header("Location: index.php?tab=field");
            exit;
        } elseif ($action === 'delete' && $id) {
            $fieldVM->deleteField($id);
            header("Location: index.php?tab=field");
            exit;
        }

        if ($action === 'form') {
            $field = ($id) ? $fieldVM->getFieldById($id) : null;
            require 'views/fields_form.php';
        } else {
            $fields = $fieldVM->getAllFields();
            require 'views/fields_list.php';
        }
        break;

    case 'customer':
        if ($action === 'create' && $submit) {
            $customerVM->createCustomer($_GET);
            header("Location: index.php?tab=customer");
            exit;
        } elseif ($action === 'update' && $submit) {
            $customerVM->updateCustomer($id, $_GET);
            header("Location: index.php?tab=customer");
            exit;
        } elseif ($action === 'delete' && $id) {
            $customerVM->deleteCustomer($id);
            header("Location: index.php?tab=customer");
            exit;
        }

        if ($action === 'form') {
            $customer = ($id) ? $customerVM->getCustomerById($id) : null;
            require 'views/customers_form.php';
        } else {
            $customers = $customerVM->getAllCustomers();
            require 'views/customers_list.php';
        }
        break;

    case 'booking':
        if ($action === 'create' && $submit) {
            $bookingVM->createBooking($_GET);
            header("Location: index.php?tab=booking");
            exit;
        } elseif ($action === 'update' && $submit) {
            $bookingVM->updateBooking($id, $_GET);
            header("Location: index.php?tab=booking");
            exit;
        } elseif ($action === 'delete' && $id) {
            $bookingVM->deleteBooking($id);
            header("Location: index.php?tab=booking");
            exit;
        }

        $fields = $fieldVM->getAllFields();
        $customers = $customerVM->getAllCustomers();

        if ($action === 'form') {
            $booking = ($id) ? $bookingVM->getBookingById($id) : null;
            require 'views/bookings_form.php';
        } else {
            $bookings = $bookingVM->getAllBookings();
            require 'views/bookings_list.php';
        }
        break;

    default:
        header("Location: index.php?tab=field");
        exit;
}

?>