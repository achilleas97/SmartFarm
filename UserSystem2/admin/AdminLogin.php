<?php
session_start();
if(isset($_SESSION['username'])){
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Login | Admin</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <style type="text/css">
        html,body{
            height: 100%;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Admin Panel Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="px-3" id="admin-login-form">
                            <div id="adminLoginAlert"></div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg rounded-0" placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg rounded-0" placeholder="Password" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-0" value="Login" id="adminLoginBtn">
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
    </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>	
<script type="text/javascript">
    $(document).ready(function(){
         $("#adminLoginBtn").click(function(e){
             if($("#admin-login-form")[0].checkValidity()){
                e.preventDefault();
                $(this).val('Please Wait...');
                $.ajax({
                    url: 'assets/php/AdminAction.php',
                    method: 'post',
                    data: $("#admin-login-form").serialize()+'&action=admin_login',
                    success:function(response){
                        if (response.trim() === 'admin_login'){
                            window.location = 'dashboard.php';
                        }
                        else{
                            $("#adminLoginAlert").html(response);
                        }
                        $("#adminLoginBtn").val('Login');
                    }
                });
             }
         });
    });
</script>
</body>
</html>