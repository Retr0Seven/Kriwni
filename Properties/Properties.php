<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties</title>
    <base href="http://localhost:8000/kriwni/">
    <link rel="stylesheet" href="css/mystyle.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        /* Header Styles */
        header {
            background-color: #007acc;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        header .logo {
            font-size: 2.5rem;
            font-weight: bold;
        }

        header nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            padding: 0;
        }

        header nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #ffcc00;
        }

        /* Search Bar */
        .search-bar {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-bar input {
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 70%;
        }

        .search-bar button {
            padding: 12px;
            font-size: 1rem;
            background-color: #007acc;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .search-bar button:hover {
            background-color: #005a9e;
        }

        /* Properties Grid */
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
            padding: 20px;
            margin: 0 auto;
        }

        .property-card {
            display: flex;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .property-image {
            flex: 1;
            max-width: 150px;
            height: auto;
            overflow: hidden;
            border-right: 1px solid #ddd;
        }

        .property-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .property-details {
            flex: 2;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .property-details h3 {
            font-size: 1.6rem;
            color: #007acc;
            margin-bottom: 15px;
        }

        .property-details p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        .property-details .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007acc;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
        }

        .property-details .btn:hover {
            background-color: #005a9e;
            transform: translateY(-2px);
        }

        /* Reservation Form */
        #reservation-form {
            margin-top: 50px;
            padding: 20px;
            background-color: #f4faff;
            border: 1px solid #ddd;
            border-radius: 10px;
            max-width: 500px;
            margin: 50px auto;
        }

        #reservation-form input,
        #reservation-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        #reservation-form button {
            background-color: #007acc;
            color: white;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s ease;
        }

        #reservation-form button:hover {
            background-color: #005a9e;
        }

        /* Success Message */
        .success-message {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border-radius: 5px;
            display: none;
            font-size: 1.2rem;
            position: relative;
        }

        .success-message:before {
            content: "🎉";
            font-size: 2rem;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Error Message */
        .error-message {
            background-color: #dc3545;
            color: white;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
            border-radius: 5px;
            display: none;
            font-size: 1.2rem;
            position: relative;
        }

        .error-message:before {
            content: "🔥";
            font-size: 2rem;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <?php include '../inc/header.php'; ?>

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search properties by location" onkeyup="filterProperties()">
        <button onclick="filterProperties()">Search</button>
    </div>

    <div class="content">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message' style='display: block;'>" . htmlspecialchars($_SESSION['success_message']) . "</div>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message' style='display: block;'>" . htmlspecialchars($_SESSION['error_message']) . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <h2>Properties</h2>

        <?php
        include "../config/init.php";
        try {
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);

            // Get properties
            $qry = "SELECT PropertyID, p_name, p_location, p_price FROM Properties ORDER BY PropertyID;";
            $stmt = $conn->prepare($qry);
            $stmt->execute();

            // Start the card container
            echo "<div class='properties-grid'>";

            // Loop through each property and create a card
            while ($result = $stmt->fetch()) {
                $imageName = strtolower(str_replace(' ', '_', $result['p_name'])) . ".jpg"; // Generate image name
                echo "<div class='property-card'>";
                echo "<div class='property-image'><img src='images/$imageName' alt='" . htmlspecialchars($result['p_name']) . "'></div>";
                echo "<div class='property-details'>";
                echo "<h3>" . htmlspecialchars($result['p_name']) . "</h3>";
                echo "<p><strong>Location:</strong> " . htmlspecialchars($result['p_location']) . "</p>";
                echo "<p><strong>Price:</strong> " . htmlspecialchars($result['p_price']) . " MAD</p>";
                echo "<a href='javascript:void(0);' class='btn' onclick=\"populateForm('" . htmlspecialchars($result['p_name']) . "')\">Reserve Now</a>";
                echo "</div>";
                echo "</div>";
            }

            // Close the card container
            echo "</div>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        $conn = null;
        ?>

        <!-- Success Message -->
        <div id="successMessage" class="success-message">
            Your reservation has been successfully submitted!
        </div>

        <!-- Error Message -->
        <div id="errorMessage" class="error-message">
            Please enter a valid duration (positive number).
        </div>

    </div>

    <!-- Reservation Form -->
    <div id="reservation-form">
        <h2>Reserve Your Property</h2>
        <form id="reservationForm" method="POST" action="Properties/submit_booking.php">
            <label for="customer-name">Your Name</label>
            <input type="text" id="customer-name" name="customer_name" required>
            
            <label for="customer-email">Your Email</label>
            <input type="email" id="customer-email" name="customer_email" required>
            
            <label for="property-name">Property Name</label>
            <input type="text" id="property-name" name="property_name" readonly>
            
            <label for="start-date">Start Date</label>
            <input type="date" id="start-date" name="start_date" required>
            
            <label for="end-date">End Date</label>
            <input type="date" id="end-date" name="end_date" required>

            <button type="submit" name="submit_booking">Submit Reservation</button>
        </form>
    </div>

    <?php include '../inc/footer.php'; ?>

    <script>
        function populateForm(propertyName) {
    document.getElementById('property-name').value = propertyName;
    
    // Set minimum date as today for start date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('start-date').min = today;
    document.getElementById('end-date').min = today;
    
    const formElement = document.getElementById('reservation-form');
    formElement.scrollIntoView({ behavior: 'smooth' });
}

// Add date validation
document.getElementById('end-date').addEventListener('change', function() {
    const startDate = document.getElementById('start-date').value;
    const endDate = this.value;
    
    if (startDate && endDate < startDate) {
        alert('End date must be after start date');
        this.value = '';
    }
});
        // Function to populate the form with the selected property name
        function populateForm(propertyName) {
            document.getElementById('property-name').value = propertyName;
            const formElement = document.getElementById('reservation-form');
            formElement.scrollIntoView({ behavior: 'smooth' });
        }

        // Function to filter properties based on location
        function filterProperties() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let cards = document.querySelectorAll(".property-card");
            
            cards.forEach(card => {
                let location = card.querySelector(".property-details p").textContent.toLowerCase();
                if (location.includes(input)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        // Function to validate reservation form
        function validateReservationForm(event) {
            const duration = document.getElementById("duration").value;

            // Check if duration is negative or zero
            if (duration <= 0) {
                document.getElementById("errorMessage").style.display = "block"; // Show error message
                document.getElementById("reservation-form").style.display = "none"; // Hide reservation form
                return false; // Prevent form submission
            }

            document.getElementById("errorMessage").style.display = "none"; // Hide error message
            showSuccessMessage(); // Show success message if valid
            document.getElementById("reservation-form").style.display = "none"; // Hide reservation form after success
            return false; // Prevent form submission to avoid page reload
        }

        // Function to show success message after reservation submission
        function showSuccessMessage() {
            document.getElementById("successMessage").style.display = "block"; // Show success message
            setTimeout(function() {
                document.getElementById("successMessage").style.display = "none"; // Hide success message after 5 seconds
            }, 5000);
        }
    </script>
</body>

</html>
