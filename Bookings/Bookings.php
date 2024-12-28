<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Invoices</title>
    <base href="http://localhost:8000/kriwni/">
    <link rel="stylesheet" href="css/mystyle.css">
    <style>
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

        /* Content Styles */
        .content {
            padding: 3rem 2rem;
            background-color: #ffffff;
            max-width: 1200px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007acc;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        /* Search Bar */
        .search-bar {
            margin-bottom: 2rem;
            text-align: center;
        }

        .search-bar input,
        .search-bar button {
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-bar button {
            background-color: #007acc;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #005a9e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table caption {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1rem;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #007acc;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Footer Styles */
        footer {
            background-color: #007acc;
            color: white;
            text-align: center;
            padding: 1.5rem;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }

        footer p {
            margin: 0.5rem 0;
        }

        footer a {
            color: #ffcc00;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<?php include '../inc/header.php'; ?>

<div class="content">
    <h2> Bookings</h2>

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search bookings by ID or Property" onkeyup="filterBookings()">
        <button onclick="filterBookings()">Search</button>
    </div>

    <?php
    include "../config/init.php";
    try {
        $conn = new PDO("mysql:host=$server; dbname=$db", $user, $password);

        // Handle status update
        if(isset($_POST['update_status'])) {
            $bookingId = $_POST['booking_id'];
            $newStatus = $_POST['new_status'];
            
            $updateQuery = "UPDATE Bookings SET Status = :status WHERE BookingID = :id";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->execute([
                ':status' => $newStatus,
                ':id' => $bookingId
            ]);
        }

        // Get invoices
        $qry = "SELECT BookingID, property_name, StartDate, EndDate, Status 
        FROM Bookings 
        ORDER BY BookingID";

        $stmt = $conn->prepare($qry);
        $stmt->execute();

        echo "<table id='bookingTable'>\n";
        echo "<caption>Bookings Overview</caption>\n";
        echo "<tr><th>Booking ID</th><th>Property ID</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Action</th></tr>\n";

        // Loop through each row
        while ($result = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $result['BookingID'] . "</td>";
            echo "<td>" . $result['property_name'] . "</td>";
            echo "<td>" . $result['StartDate'] . "</td>";
            echo "<td>" . $result['EndDate'] . "</td>";
            echo "<td>" . $result['Status'] . "</td>";
            
            // Add action column with update form for pending bookings
            if($result['Status'] === 'pending') {
                echo "<td>
                    <form method='POST' style='display: inline;'>
                        <input type='hidden' name='booking_id' value='" . $result['BookingID'] . "'>
                        <select name='new_status'>
                            <option value='confirmed'>Confirm</option>
                            <option value='canceled'>Cancel</option>
                        </select>
                        <button type='submit' name='update_status'>Update</button>
                    </form>
                </td>";
            } else {
                echo "<td>No action needed</td>";
            }
            echo "</tr>\n";
        }

        echo "</table>\n";
    } catch (PDOException $e) {
        echo "<div class='error-message'>Error: " . $e->getMessage() . "</div>";
    }

    $conn = null;
    ?>

    <!-- Export Button -->
</div>

<style>
    select, button[name='update_status'] {
        padding: 5px;
        margin: 2px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    button[name='update_status'] {
        background-color: #007acc;
        color: white;
        cursor: pointer;
    }
</style>
<?php include '../inc/footer.php'; ?>

<!-- JavaScript for search, filter, and export -->
<script>
    // Filter Bookings
    function filterBookings() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let table = document.getElementById("bookingTable");
        let tr = table.getElementsByTagName("tr");
        
        for (let i = 1; i < tr.length; i++) {
            let tdBookingID = tr[i].getElementsByTagName("td")[0];
            let tdPropertyID = tr[i].getElementsByTagName("td")[1];
            if (tdBookingID || tdPropertyID) {
                let textBookingID = tdBookingID.textContent || tdBookingID.innerText;
                let textPropertyID = tdPropertyID.textContent || tdPropertyID.innerText;
                if (textBookingID.toLowerCase().includes(input) || textPropertyID.toLowerCase().includes(input)) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Export to CSV
    function exportToCSV() {
        let table = document.getElementById("bookingTable");
        let rows = table.rows;
        let csv = [];
        for (let i = 0; i < rows.length; i++) {
            let row = rows[i];
            let cols = row.querySelectorAll("td, th");
            let rowData = [];
            cols.forEach(function(col) {
                rowData.push(col.innerText);
            });
            csv.push(rowData.join(","));
        }
        
        let csvFile = new Blob([csv.join("\n")], { type: "text/csv" });
        let downloadLink = document.createElement("a");
        downloadLink.href = URL.createObjectURL(csvFile);
        downloadLink.download = "bookings.csv";
        downloadLink.click();
    }
</script>

</body>
</html>
