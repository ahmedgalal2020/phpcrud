<?php 
// Include database connection
include 'db.php';

// Registration logic goes here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Remember to hash passwords
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    // Attempt insert query execution
    $sql = "INSERT INTO users (name, email, password, mobile) VALUES ('$name', '$email', '$password', '$mobile')";
    if($conn->query($sql) === true){
        echo "<script>alert('Registration Successful'); window.location.href='login.php';</script>";
    } else{
        echo "<script>alert('ERROR: Could not execute query.');</script>";
    }
}

// Close database connection
include 'closedb.php';
?>
<?php include_once './parts/header.php'; ?>

<div class="container mt-5">
        <h2>User Registration</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label>Mobile:</label>
                <input type="text" class="form-control" name="mobile" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <?php include_once './parts/footer.php'; ?>
