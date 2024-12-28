<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Property Reviews - Kriwni</title>
    <base href="http://localhost:8000/kriwni/">
    <link rel="stylesheet" href="css/mystyle.css">
    <style>
        .review-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .review-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .review-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            resize: vertical;
            min-height: 100px;
        }

        .rating-select {
            margin-bottom: 20px;
        }

        .rating-select select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 200px;
        }

        .reviews-list {
            display: grid;
            gap: 20px;
        }

        .review-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .review-card:hover {
            transform: translateY(-5px);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-author {
            font-weight: bold;
            color: #007acc;
        }

        .review-rating {
            color: #ffd700;
            font-size: 1.2em;
        }

        .review-date {
            color: #666;
            font-size: 0.9em;
        }

        .review-text {
            line-height: 1.6;
            color: #333;
        }

        .section-title {
            color: #007acc;
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php include '../inc/header.php'; ?>

    <div class="content">
        <div class="review-container">
            <h2 class="section-title">Share Your Experience</h2>

            <div class="review-form">
                <form method="post" action="reviews/reviews.php">
                    <?php include('errors.php'); ?>
                    <div class="input-group">
                        <label>Your Name</label>
                        <input type="text" name="reviewer_name" required>
                    </div>
                    <div class="input-group">
                        <label>Property Name</label>
                        <input type="text" name="property_name" required>
                    </div>
                    <div class="rating-select">
                        <label>Rating</label>
                        <select name="rating" required>
                            <option value="5">★★★★★ (5)</option>
                            <option value="4">★★★★☆ (4)</option>
                            <option value="3">★★★☆☆ (3)</option>
                            <option value="2">★★☆☆☆ (2)</option>
                            <option value="1">★☆☆☆☆ (1)</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label>Your Review</label>
                        <textarea name="review_text" required></textarea>
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn" name="submit_review">Submit Review</button>
                    </div>
                </form>
            </div>

            <h2 class="section-title">Recent Reviews</h2>
            <div class="reviews-list">
                <?php
                include "../config/init.php";
                try {
                    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $password);
                    
                    // Get reviews (lowercase table name to match database)
                    $qry = "SELECT * FROM reviews ORDER BY review_date DESC LIMIT 10";
                    $stmt = $conn->prepare($qry);
                    $stmt->execute();

                    while ($review = $stmt->fetch()) {
                        echo "<div class='review-card'>";
                        echo "<div class='review-header'>";
                        echo "<span class='review-author'>" . htmlspecialchars($review['reviewer_name']) . "</span>";
                        echo "<span class='review-rating'>" . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . "</span>";
                        echo "</div>";
                        echo "<p class='review-date'>" . htmlspecialchars($review['review_date']) . "</p>";
                        echo "<p class='review-text'>" . htmlspecialchars($review['review_text']) . "</p>";
                        echo "</div>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error'>Error loading reviews: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <?php include '../inc/footer.php'; ?>
</body>
</html>
