<?php
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






//register


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










include './inc/closedb.php';
?>

    
<?php include_once './parts/header.php'; ?>




    <div class="container mt-5">
        <h2>User Login</h2>
        <form action="login.php" method="post">
            <div class="form-group m-3">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group m-3">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-secondary">Register</a>
        </form>
    </div>


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
