<?php 
// Include database connection
include 'db.php';

// Login logic goes here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Remember to hash and verify in real application

    // Attempt to select query execution
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'"; // Use prepared statements in real application
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('Login Successful'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('Login Failed: Invalid email or password');</script>";
    }
}

// Close database connection
include 'closedb.php';
?>


<?php include_once './parts/header.php'; ?>

<div class="container mt-5">
        <h2>User Login</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <?php include_once './parts/footer.php'; ?>
