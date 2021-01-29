<?php
	require_once 'assets/php/ClassAuth.php';
	require_once 'assets/php/ClassUtil.php';

	$user = new Auth();
	$util = new Util();

	if(isset($_GET['email']) && isset($_GET['token'])){
		$email = $util-> test_input($_GET['email']);
		$token = $util-> test_input($_GET['token']);

		$data = $user-> tokenUser($email);
		$ctoken = $data['token'];
		
		if($ctoken == $token){
			$user-> verify_email($email);
		}
		header('location:login.php');
		exit();
	} 
	else{
		header('location:index.html');
		exit();
	}
?>