<?php
include './inc/db.php';
include './inc/closedb.php';
?>

    
<?php include_once './parts/header.php'; ?>
<!-- 
<div class="container mt-5">
        <h1>Welcome to the Home Page</h1>
        <div class="row">
            <div class="col">
                <a href="login.php" class="btn btn-primary">Login</a>
                <a href="register.php" class="btn btn-secondary">Register</a>
            </div>
        </div>
    </div> -->


    <!--update-->
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="#" class="sign-in-form">
					<h2 class="title">Sign in</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Email" />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" />
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
				<form action="#" class="sign-up-form">
					<h2 class="title">Sign up</h2>
					<div class="input-field">
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username" />
					</div>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input type="email" placeholder="Email" />
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input type="password" placeholder="Password" />
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
			</div>
		</div>

		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>New to our community ?</h3>
					<p>
						Discover a world of possibilities! Join us and explore a vibrant
          community where ideas flourish and connections thrive.
					</p>
					<button class="btn transparent" id="sign-up-btn">
						Sign up
					</button>
				</div>
				<img  src="./images/Privacy-policy-rafiki.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of Our Valued Members</h3>
					<p>
						Thank you for being part of our community. Your presence enriches our
          shared experiences. Let's continue this journey together!
					</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="./images/Mobile-login-rafiki.png"  class="image" alt="" />
			</div>
		</div>
	</div>

	<script src="app.js"></script>







    
<?php include_once './parts/footer.php'; ?>
