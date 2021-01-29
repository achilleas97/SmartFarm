<?php
	require_once 'assets/php/header.php';
?>
<div class="row justify-content-center">
	<div class="col-lg-12 ">
		<div class="card mt-3 border-warning">
			<div class="card-header bg-warning text-white text-center h5">Χρήστης</div>
			<div class="card-header border">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<a href="#profile" class="nav-link active font-weight-bold" data-toggle="tab">Προφίλ</a> 
					</li>
					<li class="nav-item">
						<a href="#editProfile" class="nav-link font-weight-bold" data-toggle="tab">Επεξεργασία Προφίλ</a> 
					</li>
					<li class="nav-item">
						<a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Αλλαγή Κωδικού</a> 
					</li>
				</ul>						
			</div>
			<div class="card-body">
				<div class="tab-content">

					<!--Profile Tab Content Start-->
					<div class="tab-pane container active" id="profile">
						<div id="verifyEmailAlert"></div>
						<div class="card-deck">
							<div class="card border-primary">
								<div class="card-body">
									<p class="card-text p-2 m-1 h6"><b> Όνομα :  </b><?= $cname;?></p>
									<p class="card-text p-2 m-1 h6"><b> Ηλεκτρονική Διεύθυνση : </b><?= $cemail;?></p>
									<p class="card-text p-2 m-1 h6"><b> Εγγράφηκε στις : </b><?= $reg_on;?></p>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="card border-primary align-self-center">
								<?php if(!$cphoto):?>
									<img src="assets/uploads/user.png" class="img-thumbnail img-fluid">
									<?php else:?>
										<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid">
									<?php endif;?>
							</div>
						</div>
					</div>
					<!-- Profile Tab Content End--> 

					<!--Edit Profile Tab Content Start-->
					<div class="tab-pane container fade" id="editProfile">
						<div class="card-deck">
							<div class="card border-danger align-self-center">
								<?php if(!$cphoto):?>
									<img src="assets/uploads/user.png" class="img-thumbnail img-fluid">
									<?php else:?>
										<img src="<?= 'assets/php/'.$cphoto; ?>" class="img-thumbnail img-fluid">
									<?php endif;?>
							</div>
							<div class="card border-danger">
								<form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data" id="profile-update-form">
									<input type="hidden" name="oldimage" value="<?= $cphoto;?>">
									<div class="form-group m-0">
										<label for="profilePhoto" class="m-1">Ανέβασμα εικόνας προφίλ</label>
										<input type="file" name="image" id="profilePhoto">
									</div>

									<div class="form-group m-0">
										<label for="name" class="m-1">Όνομα</label>
										<input type="text" name="name" id="name" class="form-control" value="<?= $cname; ?>">
									</div>
									
									<div class="form-group mt-2">
										<input type="submit" name="profile_update" value="Αποθήκευση Προφίλ" class="btn btn-danger btn-block" id="profileUpdateBtn">
									</div>
								</form>		
							</div>
						</div>
					</div> 
					<!--Edit Profile Tab Content End-->
					
					<!--Change Password Tab Content Start -->
					<div class="tab-pane container fade" id="changePass">
						<div id="changepassAlert"></div>
						<div class="card-deck">
							<div class="card border-success">
								<form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
									<div class="form-group">
										<label for="curpass">Πληκτρολόγησε τον τωρινό σου κωδικό</label>
										<input type="password" name="curpass" autocomplete="password" placeholder="Τωρινός Κωδικός" class="form-control form-control-lg" id="curpass" required minlength="5">
									</div>

									<div class="form-group">
										<label for="newpass">Πληκτρολόγησε έναν καινούριο κωδικό</label>
										<input type="password" name="newpass" autocomplete="password" placeholder="Καινούριος κωδικός" class="form-control form-control-lg" id="newpass" required minlength="5">
									</div>

									<div class="form-group">
										<label for="cnewpass">Πληκτρολόγησε ξανά τον καινούριο κωδικό</label>
										<input type="password" name="cnewpass" autocomplete="password" placeholder="Επιβεβαίωση καινούριου κωδικού" class="form-control form-control-lg" id="cnewpass" required minlength="5">
									</div>

									<div class="form-group">
										<p id="changepassError" class="text-danger"></p>
									</div>

									<div class="form-group">
										<input type="submit" name="changepass" value="Αποθήκευση Αλλαγών" class="btn btn-success btn-block btn-lg" id="changePassBtn">
									</div>
								</form>
							</div>
							<div class="card border-success align-self-center">
								<img src="assets/img/pass.png" class="img-thumbnail img-fluid">
							</div>
						</div>								
					</div>
					<!--Change Password Tab Content End -->
				</div>
			</div>					
		</div>
	</div>
</div>
<!--Footer...-->
</div>
</div>
</div>
<!--...Area-->
<script type="text/javascript" src="assets/js/JS_profile.js"></script>

