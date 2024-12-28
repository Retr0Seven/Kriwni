<?php
require_once 'config/init.php';

function createBooking($userId, $propertyName, $startDate, $endDate) {
    global $conn;
    
    try {
        $sql = "INSERT INTO Bookings (UserID, property_name, StartDate, EndDate, Status) 
                VALUES (?, ?, ?, ?, 'pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $userId, $propertyName, $startDate, $endDate);
        
        if ($stmt->execute()) {
            return ["success" => true, "message" => "Booking created successfully"];
        }
    } catch (mysqli_sql_exception $e) {
        // Handle trigger errors
        if (strpos($e->getMessage(), "End date must be after start date") !== false) {
            return ["success" => false, "message" => "Invalid date range"];
        }
        if (strpos($e->getMessage(), "Property is already booked") !== false) {
            return ["success" => false, "message" => "Property not available for these dates"];
        }
        return ["success" => false, "message" => "Booking failed: " . $e->getMessage()];
    }
}

// Usage example:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = createBooking(
        $_POST['user_id'],
        $_POST['property_name'],
        $_POST['start_date'],
        $_POST['end_date']
    );
    echo json_encode($result);
}
?>
