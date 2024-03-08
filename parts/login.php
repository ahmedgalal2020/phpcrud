<?php
session_start(); // Start the session.

// Include database connection
include './inc/db.php';

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Hash and verify in a real app

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['UserID']; // Ensure you have a column named 'UserID'.
        header('Location: tasks.php'); // Redirect to tasks page.
        exit();
    } else {
        echo "<script>alert('Login Failed: Invalid email or password');</script>";
    }
}

include './inc/closedb.php';
?>


<?php include_once 'header.php'; ?>

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
