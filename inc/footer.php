<?php
echo "
<style>
    footer {
        background-color: #007acc;
        color: white;
        text-align: center;
        padding: 1.5rem 1rem;
        font-family: Arial, sans-serif;
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
    .footer-links {
        margin: 1rem 0;
    }
    .footer-links a {
        margin: 0 1rem;
        font-size: 1rem;
    }

    /* Style for the modal */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Fixed to the screen */
        z-index: 1; /* Ensure it sits on top of other content */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6); /* Black background with opacity */
        padding-top: 100px; /* Adjust to position the modal in the center */
        text-align: center;
    }

    /* Modal content */
    .modal-content {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        width: 70%;
        margin: 0 auto;
        font-size: 1.2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.3s ease-out;
    }

    /* Close button */
    .close {
        color: #007acc;
        font-size: 1.8rem;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .close:hover,
    .close:focus {
        color: #ffcc00;
    }

    /* Header styling inside modal */
    .modal h2 {
        font-size: 2rem;
        color: #007acc;
        margin-bottom: 20px;
        font-weight: 600;
    }

    /* Modal body */
    .modal-body {
        color: #333;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .modal ul {
        list-style-type: none;
        padding-left: 0;
    }

    .modal li {
        margin: 10px 0;
    }

    .modal li strong {
        color: #005a9e;
    }

    /* Footer button inside modal */
    .modal-footer button {
        padding: 10px 20px;
        background-color: #007acc;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-footer button:hover {
        background-color: #005a9e;
    }

    /* Fade in animation */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

</style>

<footer>
    <p>&copy; 2024 Kriwni - Your Trusted Rental Platform</p>
    <div class='footer-links'>
        <a href='javascript:void(0);' onclick='showMessage(\"about\")'>About Us</a>
        <a href='javascript:void(0);' onclick='showMessage(\"terms\")'>Terms of Service</a>
        <a href='javascript:void(0);' onclick='showMessage(\"privacy\")'>Privacy Policy</a>
        <a href='javascript:void(0);' onclick='showMessage(\"contact\")'>Contact</a>
    </div>
    <p>Email us at: <a href='mailto:Kriwni@aui.ma'>Kriwni@aui.ma</a></p>
</footer>

<!-- Modal for About Us -->
<div id='myModal' class='modal'>
    <div class='modal-content'>
        <button class='close' onclick='closeModal()'>×</button>
        <h2>About Us</h2>
        <div class='modal-body'>
            <p><strong>Our Story:</strong></p>
            <p>We’ve been around since 2016, and since then, we’ve been shaking up the rental game! What started as a small idea in a coffee shop has grown into a platform trusted by thousands. How did we get here?</p>
            <ul>
                <li><strong>2016:</strong> We began with a dream of making rentals as easy as ordering pizza! (Okay, maybe a bit more complicated, but still pretty easy!)</li>
                <li><strong>2017:</strong> First property listed! A small cozy apartment in downtown. People loved it. We were onto something big!</li>
                <li><strong>2020:</strong> Introduced our Rent with Confidence feature. We started offering more services and more options than ever before.</li>
                <li><strong>2022:</strong> A partnership with local businesses helped us offer discounts to our users. More reasons to rent with Kriwni!</li>
            </ul>
            <p>Thank you for being part of this incredible journey!</p>
        </div>
        <div class='modal-footer'>
            <button onclick='closeModal()'>Got it!</button>
        </div>
    </div>
</div>

<!-- Modal for Terms of Service -->
<div id='termsModal' class='modal'>
    <div class='modal-content'>
        <button class='close' onclick='closeModal()'>×</button>
        <h2>Terms of Service</h2>
        <div class='modal-body'>
            <p><strong>Welcome to Kriwni!</strong></p>
            <p>By using our services, you agree to our terms outlined below:</p>
            <ul>
                <li><strong>Account Creation:</strong> You must be at least 18 years old to create an account and use our platform.</li>
                <li><strong>Usage Policy:</strong> You may not use the platform for illegal activities. Any such activities will result in account suspension.</li>
                <li><strong>Payment:</strong> Payment for services must be made in full at the time of booking.</li>
                <li><strong>Cancellation Policy:</strong> Cancellations are allowed up to 24 hours before the booking start date. Cancellations after that are non-refundable.</li>
            </ul>
            <p>For more details, please read our full Terms of Service.</p>
        </div>
        <div class='modal-footer'>
            <button onclick='closeModal()'>Got it!</button>
        </div>
    </div>
</div>

<!-- Modal for Privacy Policy -->
<div id='privacyModal' class='modal'>
    <div class='modal-content'>
        <button class='close' onclick='closeModal()'>×</button>
        <h2>Privacy Policy</h2>
        <div class='modal-body'>
            <p><strong>Your Privacy Matters:</strong></p>
            <p>At Kriwni, we respect your privacy. We collect minimal data to provide you with the best service, including:</p>
            <ul>
                <li><strong>Personal Information:</strong> We collect your name, email, and payment details to process your bookings.</li>
                <li><strong>Data Usage:</strong> We use your information to improve our services and send important updates regarding your account.</li>
                <li><strong>Data Security:</strong> We use encryption technology to protect your data and ensure a safe experience.</li>
            </ul>
            <p>We do not share your information with third parties without your consent.</p>
        </div>
        <div class='modal-footer'>
            <button onclick='closeModal()'>Got it!</button>
        </div>
    </div>
</div>

<!-- Modal for Contact Us -->
<div id='contactModal' class='modal'>
    <div class='modal-content'>
        <button class='close' onclick='closeModal()'>×</button>
        <h2>Contact Us</h2>
        <div class='modal-body'>
            <p><strong>We’d love to hear from you!</strong></p>
            <p>If you have any questions or concerns, feel free to contact us:</p>
            <ul>
                <li><strong>Email:</strong> <a href='mailto:Kriwni@aui.ma'>Kriwni@aui.ma</a></li>
                <li><strong>Phone:</strong> +1 (800) 123-4567</li>
                <li><strong>Address:</strong> 123 Main Street, Suite 456, New York, NY 10001</li>
            </ul>
            <p>Our team is available 24/7 to assist you!</p>
        </div>
        <div class='modal-footer'>
            <button onclick='closeModal()'>Got it!</button>
        </div>
    </div>
</div>

<script>
    function showMessage(page) {
        var modal;
        
        if (page === 'about') {
            modal = document.getElementById('myModal');
        } else if (page === 'terms') {
            modal = document.getElementById('termsModal');
        } else if (page === 'privacy') {
            modal = document.getElementById('privacyModal');
        } else if (page === 'contact') {
            modal = document.getElementById('contactModal');
        }
        
        modal.style.display = 'block'; // Display the appropriate modal
    }

    // Function to close the modal
    function closeModal() {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            modal.style.display = 'none'; // Hide the modal
        });
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function(event) {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    }
</script>
";
?>
