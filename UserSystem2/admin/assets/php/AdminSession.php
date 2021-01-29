<?php 
   session_start();
   if(!isset($_SESSION['username'])){
     header('location:AdminLogin.php');
     die;
   }
   require_once 'AdminDB.php';
   $admin = new Admin();
?>