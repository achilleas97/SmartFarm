<?php 
	session_start();
	require_once 'ClassData.php';
	require_once 'ClassAuth.php';
	require_once 'ClassSystem.php';
	require_once 'ClassNetwork.php';
	require_once 'ClassUtil.php';
	
	if(!isset($_SESSION['user'])){
		header('location:login.php');
		die;
	}

	//Το αντικείμενο  cuser της κλάσης Auth που βρίσκεται στο αρχείο auth.php
	$cuser = new Auth();
	//Το αντικείμενο system της κλάσης System που βρίσκεται στο αρχείο systems.php
	$system = new System();
	//Το αντικείμενο data της κλάσης Data που βρίσκεται στο αρχείο data.php
	$data = new Data();
	//Το αντικείμενο network της κλάσης Network που βρίσκεται στο αρχείο network.php
	$network = new Network();	
	//Το αντικείμενο method της κλάσης Method που βρίσκεται στο αρχείο methods.php
	$method = new Util();	
	
	//////////////////// Data For User ////////////////////
	
	$cemail = $_SESSION['user'];
	$dataUser = $cuser-> currentUser($cemail);
	$cid = $dataUser['id'];
	$cname = $dataUser['name'];
	$cpass = $dataUser['password'];
	$cphoto = $dataUser['photo'];
	$created = $dataUser['created_at']; 
	$reg_on = date('d M Y', strtotime($created));
	$fname = strtok($cname, " ");
		
	//////////////////// Data For Network, System, Sensors ////////////////////

	//Επιλογή των δεδομένων δικτύου συστημάτων 
	$networkData = $network-> currentNet($cid);
	$nid = $networkData['id'];
	$nname = $networkData['name'];
	$nposition = $networkData['position'];
	
	//Επιλογή των δεδομένων συστημάτων 
	$systemsUser = $system-> currentSystem($nid);

	//Επιλογή δεδομένων από τους αισθητήρες
	$resultData = $data-> readSensorData($nid);
?>

