<?php
// Database connection
$conn = mysqli_connect('localhost', 'u294421851_phpcrud', 'Am13111991', 'u294421851_phpcrud');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Echo a script tag to log a message to the console
    echo '<script>console.log("Database connection established.");</script>';
}

