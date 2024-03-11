<?php 
// Include database connection
include './inc/db.php';


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
        echo "<script>alert('Registration Successful'); window.location.href='index.php';</script>";
    } else{
        echo "<script>alert('ERROR: Could not execute query.');</script>";
    }
}

// Close database connection
include './inc/closedb.php';
?>



<form action="register.php" method="post" class="sign-up-form">
					<h2 class="title">Sign up</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" name="name" required placeholder="Name" />
					</div>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="email" " name="email" required placeholder="Email" />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" name="password" required placeholder="Password" />
					</div>
					<div class="input-field">
						<i class="fas fa-phone"></i>
						<input type="text"  name="mobile" required placeholder="Mobile" />
					</div>
					<input type="submit" class="btn" value="Sign up" />
					<p class="social-text">Or Sign up with social platforms</p>
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


