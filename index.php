<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost:8000/kriwni/">
    <title>Kriwni</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4faff;
            color: #333;
            line-height: 1.6;
        }

        /* Header Section */
        header {
            background-color: #007acc;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            font-family: 'Brush Script MT', cursive;
            font-size: 2.5rem;
            font-weight: bold;
        }

        header nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
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

        /* Hero Section */
        .hero {
            background-image: url('images/4.png'); /* Replace with your image */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 20px;
            text-align: center;
            box-shadow: inset 0 0 100px rgba(0, 0, 0, 0.4);
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6); /* Adding text shadow for visibility */
        }

        .hero p {
            font-size: 1.6rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6); /* Adding text shadow for visibility */
        }

        .hero .cta-button {
            background-color: #ffcc00;
            color: #007acc;
            padding: 15px 30px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 1.2rem;
        }

        .hero .cta-button:hover {
            background-color: #ff9900;
        }

        /* Testimonials Section */
        .testimonials {
            background-color: #007acc;
            color: white;
            padding: 50px 20px;
            text-align: center;
        }

        .testimonials h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .testimonials .testimonial-card {
            display: inline-block;
            width: 250px;
            margin: 0 20px;
            background-color: #005a9e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .testimonials .testimonial-card p {
            font-style: italic;
            margin-bottom: 15px;
        }

        .testimonials .testimonial-card h3 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: space-around;
            padding: 50px 20px;
            text-align: center;
        }

        .features .feature {
            width: 200px;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .features .feature:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .features .feature i {
            font-size: 3rem;
            color: #005a9e;
            margin-bottom: 20px;
        }

        .features .feature h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .features .feature p {
            font-size: 1rem;
            color: #555;
        }

        /* Footer Section */
        footer {
            background-color: #007acc;
            color: white;
            text-align: center;
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include 'inc/header.php'; ?>

    <!-- Hero Section -->
    <div class="hero">
        <h2>Your Trusted Rental Platform</h2>
        <p>Find the best properties that suit your needs, all in one place.</p>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials">
        <h2>What Our Users Say</h2>
        <div class="testimonial-card">
            <p>"The best rental platform I've ever used. Easy, secure, and reliable!"</p>
            <h3>John Doe</h3>
        </div>
        <div class="testimonial-card">
            <p>"Found my dream apartment in no time. Highly recommend Kriwni!"</p>
            <h3>Jane Smith</h3>
        </div>
        <div class="testimonial-card">
            <p>"An amazing platform for property management. Very user-friendly."</p>
            <h3>Michael Johnson</h3>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features">
        <div class="feature">
            <i class="fas fa-lock"></i>
            <h3>Secure Payments</h3>
            <p>Our platform ensures safe and secure transactions for all bookings.</p>
        </div>
        <div class="feature">
            <i class="fas fa-calendar-check"></i>
            <h3>Easy Reservations</h3>
            <p>Book your desired property with a few clicks. It's that simple!</p>
        </div>
        <div class="feature">
            <i class="fas fa-users"></i>
            <h3>Customer Support</h3>
            <p>Our team is available 24/7 to assist you with your queries and bookings.</p>
        </div>
    </div>

    <!-- Footer Section -->
    <?php include 'inc/footer.php'; ?>
</body>
</html>
