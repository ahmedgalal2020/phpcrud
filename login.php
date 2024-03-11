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



<form action="login.php" class="sign-in-form" method="post">
					<h2 class="title">Sign in</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="email"  name="email" placeholder="Email"  required/>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" name="password" required/>
					</div>
					<input type="submit" value="Login" class="btn solid" />
					<p class="social-text">Or Sign in with social platforms</p>
					<div class="social-media">
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-google"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</form>


