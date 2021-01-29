<?php	
    ob_start();
	session_start();
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	require_once 'ClassAuth.php';
	require_once 'ClassUtil.php';
	
	$user = new Auth();
	$method = new Util();
	
	//Handle Register Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'register'){
		$name = $method->test_input($_POST['name']);
		$email = $method->test_input($_POST['email']);
		$pass = $method->test_input($_POST['password']);

		$hpass = password_hash($pass, PASSWORD_DEFAULT);

		if($user-> user_exist($email)){
			echo $method->showMessage('warning', 'Αυτή η ηλεκτρονική διεύθυνση είναι ήδη καταχωρημένη!',true);
		}
		else{
			if($user-> register($name,$email,$hpass)) {
				$token = uniqid();
				$token = str_shuffle($token);
				$user-> forgot_password($token,$email);
				echo $method->showMessage('success', 'H εγγραφή σου καταχωρήθηκε. Θα ενημερωθείς στο email σου για την επιβεβαίωση της.',true);
			}
			else{
				echo $method-> showMessage('danger', 'Κάτι πήγε στραβά, Παρακαλώ δοκιμάστε ξανά αργότερα!',true);
			}
		}
	}

	//Διεργασίες για το login ajax request
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		//Έλεγχος των δεδομένων 
		$email = $method-> test_input($_POST['email']);
		$pass = $method-> test_input($_POST['password']);
		
		//Έλεγχος του email εαν υπάρχει στην βάση 
		$loggedInUser = $user->login($email);
		if ($loggedInUser != null) {
			//Έπαλήθευση του κωδικού χρήστη
			if (password_verify($pass, $loggedInUser['password'])) {
				//Εισαγωγή cookies εάν έχει επιλεγέι το "Να με θυμάσαι"
				if (!empty($_POST['rem'])) {
					setcookie("email", $email, time()+(30*24*60*60), '/');
					setcookie("password", $pass, time()+(30*24*60*60), '/');
				}
				else{
					setcookie("email","",1, '/');
					setcookie("password","",1, '/');
				}

				//Σύνδεση Χρήστη
				echo 'login';
				$_SESSION['user'] = $email;
			}
			else{
				echo $method-> showMessage('danger', 'Λάθος Κωδικός!',true);
			}

		}
		else{
			echo $method-> showMessage('danger','Ο χρήστης δεν βρέθηκε!',true);
		}
	}

	//Διεργασίες για το Forgot Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'forgot'){	
		$email = $method-> test_input ($_POST['email']);

		//Έλεγχος εάν υπάρχει το email του χρήστη
		$user_found = $user-> currentUser($email);
		if($user_found != null){
			//Δημιουργία token
			$token = uniqid();
			$token = str_shuffle($token);

			$user-> forgot_password($token,$email);
			//Αποστολή email χρήστη για επαναφορά του λογαριασμού
			try{
				$mail-> isSMTP();
				$mail-> Host = 'smtp.gmail.com';
				$mail-> SMTPAuth = true;		
				$mail-> Username = Database::USERNAME;
				$mail-> Password = Database::PASSWORD;
				$mail-> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail-> Port = 587;

				$mail-> setFrom(Database::USERNAME, 'SmartFarm');
				$mail-> addAddress($email);

				$mail-> isHTML(true);
				$mail-> Subject = 'Account reset';
				$mail-> Body = '<h3>Πατήστε από κάτω για την Επαναφορά του κωδικού.<br><a href="https://localhost/UserSystem2/reset_pass.php?email='.$email.'&token='.$token.'">https://localhost/UserSystem2/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Regards<br>SmartFarm!</h3>';
				$mail-> send();  
				echo $method-> showMessage('success', 'Σας έχουμε στείλει τον σύνδεσμο επαναφοράς κωδικού σας στην ηλεκτρονική σας διεύθυνση!',true);
			
			}
			catch (Exception $e){
				echo $method-> showMessage('danger','Κάτι πηγε στραβά! Παρακαλώ προσπαθήστε ξανά σε λίγο!',true);
			}
		}
		else{
			echo $method-> showMessage('info', 'Αυτή η ηλεκτρονική διεύθυνση δεν είναι καταχωρημένη!',true);
		}
	}
ob_end_flush();
?>