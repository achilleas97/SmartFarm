<?php
    require_once 'AdminDB.php';
    session_start();
    $admin = new Admin();

    if(isset($_POST['action']) && $_POST['action'] == 'admin_login'){
        $username = $admin->test_input($_POST['username']);
        $password = $admin->test_input($_POST['password']);

        $hpassword = sha1($password);
        $loggedInAdmin = $admin->admin_login($username,$hpassword);
        if($loggedInAdmin != null){
            echo 'admin_login';
            $_SESSION['username'] = $username;
        }
        else{
            echo 'Username or Password is Incorrect!';
        }
    }
?>