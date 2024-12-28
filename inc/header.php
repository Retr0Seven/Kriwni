<?php
echo "
<style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #007acc;
        padding: 1rem 2rem;
        color: white;
        font-family: Arial, sans-serif;
    }
    .logo {
        font-family: 'Brush Script MT', cursive;
        font-size: 2rem;
        font-weight: bold;
    }
    nav ul {
        list-style: none;
        display: flex;
        gap: 1.5rem;
        margin: 0;
        padding: 0;
    }
    nav ul li {
        display: inline;
    }
    nav ul li a {
        text-decoration: none;
        color: white;
        font-weight: bold;
        font-size: 1rem;
        transition: color 0.3s ease;
    }
    nav ul li a:hover {
        color: #ffcc00;
    }
</style>

<header>
    <div class='logo'>kriwni</div>
    <nav>
        <ul>
            <li><a href=''>Home</a></li>
            <li><a href='Properties/Properties.php'>Properties</a></li>
            <li><a href='Bookings/Bookings.php'>Booking</a></li>
            <li><a href='reviews/reviews.php'>Reviews</a></li>
        </ul>
    </nav>
</header>
";
?>
