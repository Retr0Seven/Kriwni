<?php
session_start();
require_once '../config/init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_booking'])) {
    try {
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $property_name = $_POST['property_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $customer_name = $_POST['customer_name'];
        $customer_email = $_POST['customer_email'];

        $sql = "INSERT INTO Bookings (customer_name, customer_email, property_name, StartDate, EndDate, Status) 
                VALUES (:name, :email, :property, :start, :end, 'confirmed')";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $customer_name,
            ':email' => $customer_email,
            ':property' => $property_name,
            ':start' => $start_date,
            ':end' => $end_date
        ]);

        $_SESSION['success_message'] = "Booking successful!";
    } catch (PDOException $e) {
        if (strpos($e->getMessage(), "End date must be after start date") !== false) {
            $_SESSION['error_message'] = "Invalid dates: End date must be after start date";
        } elseif (strpos($e->getMessage(), "Property is already booked") !== false) {
            $_SESSION['error_message'] = "Property is not available for these dates";
        } else {
            $_SESSION['error_message'] = "Booking failed: " . $e->getMessage();
        }
    }
    
    header("Location: ../Properties/Properties.php");
    exit();
}
?>