<?php 
  require_once 'assets/php/AdminSession.php';
?>

<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Dashboard</a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="">UserSystem</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="assets/php/AdminLogout.php">Έξοδος</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row-fluid my-3">
      <div class="card text-center">
        <div class="card-header">
          Χρήστες
        </div>
        <div class="card-body">
            <div class="card-deck">
              <div class="table-responsive" id="showData"></div>
            </div>
        </div>
        <div class="card-footer text-muted"> </div>
      </div>  
    </div>
    <div class="row-fluid my-3">
      <div class="card text-center">
          <div class="card-header">
            Δίκτυο
          </div>
          <div class="card-body">
              <div class="card-deck">
                <div class="table-responsive" id="info">
                </div>
              </div>
          </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
$(document).ready(function(){   
  displayUsers();    
  function displayUsers(){
    $.ajax({
        url: 'assets/php/AdminProcess.php',
        method: 'post',
        data: {action: 'displayUsers'},
        success:function(response){ 
          $("#showData").html(response);
          $("table").DataTable({
              order: [0,'desc']
          });
        } 
    });
  }
  
  //Delete User Ajax Request
  $("body").on("click", ".deleteBtn", function(e){
    e.preventDefault();
    del_id = $(this).attr('id');
    Swal.fire({
        title: 'Είστε σίγουρος;',
        text: "Ο Χρήστης θα διαγραφή οριστικά!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ναι, διαγραφή!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'assets/php/AdminProcess.php',
                method: 'post',
                data: { del_id: del_id 	},
                success:function(response){
                    Swal.fire(
                        'Deleted!',
                        'Ο χρήστης διαγράφηκε με επιτυχία!',
                        'success'
                    )
                    displayUsers();
                }
            });
        }	
    })
  });

  //Unlock user
  $("body").on("click", ".unlockBtn", function(e){
    e.preventDefault();
    unlock_id = $(this).attr('id');
    Swal.fire({
        title: 'Είστε σίγουρος;',
        text: "Θέλετε να κλειδώσετε αυτόν τον λογαριασμού χρήστη!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Κλείδωμα!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'assets/php/AdminProcess.php',
                method: 'post',
                data: { unlock_id: unlock_id 	},
                success:function(response){
                    Swal.fire(
                        'Κλειστός Λογαριασμός!',
                        'Ο λογαριασμός του χρήστη Κλειδώθηκε',
                        'success'
                    )
                    displayUsers();
                }
            });
        }	
    })
  });

  //lock user
  $("body").on("click", ".lockBtn", function(e){
    e.preventDefault();
    lock_id = $(this).attr('id');
    Swal.fire({
        title: 'Είστε σίγουρος;',
        text: "Θέλετε να ξεκλειδώσετε τον λογαριασμό του χρήστη!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ξεκλείδωμα!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'assets/php/AdminProcess.php',
                method: 'post',
                data: { lock_id: lock_id 	},
                success:function(response){
                    Swal.fire(
                        'Ξεκλείδωμα!',
                        'Ο λογαριασμός του χρήστη ξεκλειδώθηκε',
                        'success'
                    )
                    displayUsers();
                }
            });
        }	
    })
  });

  //Info
  $("body").on("click", ".infoBtn", function(e){
    e.preventDefault();
    info_id = $(this).attr('id');
    $.ajax({
        url: 'assets/php/AdminProcess.php',
        method: 'post',
        data: { info_id: info_id 	},
        success:function(response){  
          $("#info").html(response);
        }
    });
  });

  //Delete User Ajax Request
  $("body").on("click", ".deleteBtnNet", function(e){
    e.preventDefault();
    delNet_id = $(this).attr('id');
    Swal.fire({
        title: 'Είστε σίγουρος;',
        text: "Το δίκτυο θα διαγραφή οριστικά!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ναι, διαγραφή!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: 'assets/php/AdminProcess.php',
                method: 'post',
                data: { delNet_id: delNet_id 	},
                success:function(response){
                    Swal.fire(
                        'Deleted!',
                        'Το δίκτυο διαγράφηκε με επιτυχία!',
                        'success'
                    )
                    displayUsers();
                }
            });
        }	
    })
  });

});
</script>
</body>
</html>