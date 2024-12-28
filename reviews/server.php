<?php
session_start();

$errors = array();

include "../config/init.php";

try {
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

    if (isset($_POST['submit_review'])) {
        $reviewer_name = $_POST['reviewer_name'];
        $property_name = $_POST['property_name'];
        $rating = $_POST['rating'];
        $review_text = $_POST['review_text'];

        if (empty($reviewer_name)) array_push($errors, "Name is required");
        if (empty($property_name)) array_push($errors, "Property name is required");
        if (empty($review_text)) array_push($errors, "Review text is required");

        if (count($errors) == 0) {
            $sql = "INSERT INTO Reviews (reviewer_name, property_name, rating, review_text, review_date) 
                    VALUES (:reviewer_name, :property_name, :rating, :review_text, NOW())";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':reviewer_name' => $reviewer_name,
                ':property_name' => $property_name,
                ':rating' => $rating,
                ':review_text' => $review_text
            ]);

            $_SESSION['success'] = "Review submitted successfully";
            header('location: reviews.php');
        }
    }
} catch (PDOException $e) {
    array_push($errors, "Database error: " . $e->getMessage());
}
?>
