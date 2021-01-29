<?php 
  require_once 'assets/php/session.php';
?>
<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  
  <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | SmartFarm</title>
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
  
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
	
  <link rel="stylesheet" type="text/css" href="assets/css/HeaderStyle.css">
  <script type="text/javascript">
    $(document).ready(function() {
        $('.nav-trigger').click(function() {
            $('.admin-nav').toggleClass('visible');
        });
    });
  </script>
  <script type="text/javascript">        
    $(document).ready(function(){
        
    });
    
</script>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 header pt-2 justify-content-between d-flex">
      <div class="text-light text-center p-2 logo h5"><span><i class="fas fa-leaf"></i></span><span>&nbsp;SmartFarm</span>
        <a href="#" class="nav-trigger text-white"><span><i class="fas fa-bars"></i></span></a>             
      </div>
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop" data-toggle="dropdown">
          <i class="fas fa-user-cog"> </i> &nbsp;<?= $fname; ?>
        </a>
        <div class="dropdown-menu">
          <a href="profile.php" class="dropdown-item <?=(basename($_SERVER['PHP_SELF']) == "profile.php")?"active":""; ?>"><i class="fas fa-cog"></i>&nbsp; Προφίλ </a>
          <a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Αποσύνδεση</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="admin-nav p-0">
        <div class="list-group list-group-flush">
          <ul>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "home.php")?"active":""; ?>"><a href="home.php"><span><i class="fas fa-home"></i></span><span>&nbsp;Αρχική</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "charts.php")?"active":""; ?> "><a href="charts.php"><span><i class="fas fa-chart-line"></i></span><span>&nbsp;Γραφήματα</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "notes.php")?"active":""; ?> "><a href="notes.php"><span><i class="fas fa-sticky-note"></i></span><span>&nbsp;Σημειώσεις</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "weather.php")?"active":""; ?> "><a href="weather.php"><span><i class="fas fa-sun"></i></span><span>&nbsp;Καιρός</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "notification.php")?"active":""; ?> "><a href="notification.php"><span><i class="fas fa-bell"></i></span><span>&nbsp;Ειδοποιήσεις</span><span id="checkNotification"></span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "system.php")?"active":""; ?> "><a href="system.php"><a href="system.php"><span><i class="fas fa-microchip"></i></span><span>&nbsp;Συστήματα</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "profile.php")?"active":""; ?>"><a href="profile.php"><span><i class="fas fa-cog"></i></span><span>&nbsp;Προφίλ</span></a></li>
            <li class="<?=(basename($_SERVER['PHP_SELF']) == "information.php")?"active":""; ?> "><a href="information.php"><span><i class="fas fa-info"></i></span><span>&nbsp;Πληροφορίες</span></a></li>
          </ul>
        </div>
      </div>
      <div class="col">  
  
       

