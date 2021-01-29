<?php
	require_once 'assets/php/ClassUtil.php';
	require_once 'assets/php/ClassAuth.php';
	$method = new Util();
	$user = new Auth();
	$msg = '';
	if(isset($_GET['email']) && isset($_GET['token'])){
		$email = $method-> test_input($_GET['email']);
		$token = $method-> test_input($_GET['token']);

		$auth_user = $user-> reset_pass_auth($email, $token);

		if($auth_user != null){
			if(isset($_POST['submit'])){
				$newpass = $_POST['pass'];
				$cnewpass = $_POST['cpass']; 
				$hnewpass = password_hash($newpass, PASSWORD_DEFAULT);

				if($newpass == $cnewpass){
					$user-> update_new_pass($hnewpass, $email);
					$msg = 'Ο κωδικός άλλαξε με επιτυχία!<br><a href="login.php">Login Here!</a>'; 	
				}
				else{
					$msg = 'Ο κωδικός δεν ταιριάζει!';
				}
 			}
		}
		else {
			header('location:login.php');
			exit();
		}
	}
	else{
		header('location:login.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="el">

<head>
	<meta charset="UTF-8">
	<meta name="author" content="Achilles Drenos">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/LoginStyle.css">
</head>
<body>
	<div class="container">
		<!-- Login Form Start -->
		<div class="row justify-content-center wrapper">
			<div class="col-lg-10 my-auto">
				<div class="card-group myShadow">
					
					<div class="card justify-content-center rounded-left myColor p-4"> 
						<h1 class="text-center font-weight-bold text-white">Επαναφέρετε τον κωδικό πρόσβασής σας εδώ!</h1>
					</div>

					<div class="card rounded-right p-4" style="flex-grow:2;">
						<h1 class="text-center font-weight-bold text-primary">Πληκτρολογήστε τον νέο κωδικό!</h1>
						<hr class="my-3">
						<form action="#" method="post" class="px-3">
							<div class="text-center lead my-2"> <?= $msg;?> </div>				 
							
							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>							
								</div>
								<input type="password" name="pass" autocomplete="password" class="form-control rounded-0" placeholder="Καινούριος κωδικός" required minlength="5">		
							</div>
							

							<div class="input-group input-group-lg form-group">
								<div class="input-group-prepend">
									<span class="input-group-text rounded-0">
										<i class="fas fa-key fa-lg"></i>
									</span>							
								</div>
								<input type="password" name="cpass" autocomplete="password" class="form-control rounded-0" placeholder="Επιβεβαίωση καινούριου κωδικού" required minlength="5">		
							</div>


							<div class="form-group">
									<input type="submit" value="Επαναφόρά κωδικού" name="submit" class="btn btn-primary btn-lg btn-block myBtn">
							</div>					
						</form>
					</div> 
					
				</div>
			</div>
		</div>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>	
</body>
</html>
