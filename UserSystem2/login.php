<?php
	session_start();
	if (isset($_SESSION['user'])){
		header('location:home.php'); 
	}
?>
<!DOCTYPE html>
<html lang="el">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>SmartFarm</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/LoginStyle.css">
</head>
<body>
	<div class="container">
		<!-- Login Form Start -->
		<div class="row justify-content-center wrapper" id="login-box">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					<div class="card rounded-left p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Σύνδεση Χρήστη</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3" id="login-form">
							<div id="loginAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
									</span>							
								</div>
								<input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if(isset($_COOKIE['email'])) {echo $_COOKIE['email']; } ?>">	
							</div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>							
								</div>
								<input type="password" name="password" autocomplete="password" id="password" class="form-control rounded-0" placeholder="Password" required value="<?php if(isset($_COOKIE['password'])) {echo $_COOKIE['password']; } ?>">		
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox float-left">
									<input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?>>
									<label for="customCheck" class="custom-control-label">Να με θυμάσαι</label> 
								</div>
								<div class="forgot float-right">
									<a href="#" id="forgot-link">Ξεχάσατε τον κωδικό?</a>
								</div>
								<div class="clearfix"></div>
							</div>	
							<div class="form-group">
								<input type="submit" value="Σύνδεση" id="login-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>					
						</form>
					</div> 
					<div class="card justify-content-center rounded-right myColor p-4"> 
						<h1 class="text-center font-weight-bold text-white">Καλως Ορίσατε!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bolder text-light lead">Δημιουργήστε έναν καινούργιο λογαριασμό, εισάγοντας τα προσωπικά σας στοιχεία και ξεκινήστε να χρησιμοποιείται το Smart Farm!</p>
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Εγγραφή</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Login Form End -->

		<!-- Register Form Start -->
		<div class="row justify-content-center wrapper" id="register-box" style="display: none;">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					<div class="card justify-content-center rounded-left myColor p-4"> 
						<h1 class="text-center font-weight-bold text-white">Επιστρέψτε πίσω!</h1>
						<hr class="my-3 bg-light myHr">
						<p class="text-center font-weight-bolder text-light lead">Συνδεθείτε με τα προσωπικά σας στοιχεία</p>
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link">Σύνδεση</button>
					</div>
					<div class="card rounded-right p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Δημιουργία Λογαριασμού</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3" id="register-form">
							<div id="regAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-user fa-lg"></i>
									</span>							
								</div>
								<input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>		
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
	 								</span>							
								</div>
								<input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required>		
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>							
								</div>
								<input type="password" name="password" autocomplete="password" id="rpassword" class="form-control rounded-0" placeholder="Password" required minlength="5">		
							</div>

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>							
								</div>
								<input type="password" name="cpassword" autocomplete="password" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required minlength="5">			
							</div>	

							<div class="form-group">
								<div id="passError" class="text-danger font-weight-bold">	
								</div>								
							</div>

							<div class="form-group">
								<input type="submit" value="Εγγραφή" id="register-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>					
						</form>
					</div> 
				</div>
			</div>
		</div>
		<!-- Register Form End-->
		
		<!--Forgot Password Form Start-->
		<div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					<div class="card justify-content-center rounded-left myColor p-4"> 
						<h1 class="text-center font-weight-bold text-white">Επαναφορά Κωδικού</h1>
						<hr class="my-3 bg-light myHr">
						<button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Πίσω</button>
					</div>
					<div class="card rounded-right p-4" style="flex-grow:1.4;">
						<h1 class="text-center font-weight-bold text-primary">Ξεχάσατε τον κωδικό σας ; </h1>
						<hr class="my-3">
						<p class="lead text-center text-secondary">Εισάγετε την διεύθυνση e-mail σας ώστε να σας σταλθούν οι οδηγίες επαναφοράς του κωδικού πρόσβασης!</p>
						<form action="#" method="post" class="px-3" id="forgot-form">
							<div id="forgotAlert"></div>
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="far fa-envelope fa-lg"></i>
									</span>							
								</div>
								<input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail" required>		
							</div>	
							<div class="form-group">
									<input type="submit" value="Επαναφορά Κωδικού" id="forgot-btn" class="btn btn-primary btn-lg btn-block myBtn">
							</div>					
						</form>
					</div> 
					
				</div>
			</div>
		</div>
		<!--Forgot Password Form End-->
	</div>
</body>
</html>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>	
<script type="text/javascript" src="assets/js/JS_login.js"></script>

