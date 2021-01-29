<?php
	require_once 'assets/php/header.php';	

	$output = '';
	if ($systemsUser){
		foreach($systemsUser as $row){
			$output .= '
			<div class = "row justify-content-center my-3">	
				<div class="col-lg-12 my-2">
					<div class="card border-warning text-center font-weight-bold">
						<div class="card-header bg-warning text-center">
							<p class="h5">'.$row['name'].'</p>
						</div>
						<div class="card-body row">
							<div class="col-sm">
								<i class="fas fa-tint " style="font-size:40px;"></i>
								<p class="h2" class="display-4" id= "hum'.$row['name'].'"></p>
								<p class="h5">Υγρασία Περιβάλλοντος</p>
							</div>
							<div class="col-sm">
								<i class="fas fa-temperature-low " style="font-size:40px;"></i>
								<p class="h2" class="display-4" id= "temp'.$row['name'].'"></p>
								<p class="h5">Θερμοκρασία Περιβάλλοντος</p>
							</div>
							<div class="col-sm">
								<i class="fas fa-tint"  style="font-size:40px;"></i>
								<p class="h2" class="display-4" id= "hygro'.$row['name'].'"></p>
								<p class="h5">Υγρασία Εδάφους</p>
							</div>
						</div>
					</div>
				</div>	
			</div>';
		}
		$output .= '
			<div class="row justify-content-center">		
				<div class="col-md-8 my-2">
					<div class="card  border-warning text-center font-weight-bold">
						<div class="card-header bg-warning text-center ">
							<p class="h5">Πίνακας Δεδομένων</p>
						</div>
						<div class="card-header bg-light border">
							<ul class="nav nav-tabs card-header-tabs bg-light">
								<li class="nav-item">
									<a href="#exportTab" class="nav-link active font-weight-bold" data-toggle="tab">Εξαγωγή Δεδομένων</a> 
								</li>';
				foreach($systemsUser as $row){
					$output.='	<li class="nav-item">
									<a href="#data'.$row["name"].'" class="nav-link font-weight-bold" data-toggle="tab">'.$row["name"].'</a> 
								</li>';
				}				
				$output.='
							</ul>						
						</div>
						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane container active" id="exportTab">
									<div class="d-grid gap-2 col-6 mx-auto">
										<div class="row justify-content-center ">
											<h5>Επιλέξτε Αρχείο</h5>
										</div>
										<div class="row justify-content-center">
											<a href="assets/php/process.php?export=excel" role="button" class="btn btn-danger btn-lg">Excel</a>
										</div>
										<div class="row justify-content-center my-2">
											<a href="assets/php/process.php?export=csv" role="button" class="btn btn-danger btn-lg">cvs</a>
										</div>										
									</div>	
								</div>';
					foreach($systemsUser as $row){
						$output.='					
								<div class="tab-pane container fade" id="data'.$row["name"].'">
									<div class="card-deck">
										<div class="table-responsive">
											<table class="table table-striped text-center">
												<thead>
													<tr>
														<th>Θερμοκρασία Περιβάλλοντος</th>
														<th>Υγρασία Περιβάλλοντος</th>
														<th>Υγρασία Εδάφους</th>
														<th>Ημερομηνία</th>
													</tr>
												</thead>
												<tbody id="showData'.$row["name"].'"></tbody>
											</table>
										</div>
									</div>
								</div>';
					}
					$output.='
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 my-2">
					<div class="card  border-warning text-center font-weight-bold">
						<div class="card-header bg-warning text-center">
							<h5>Καιρός για <b id="city">'.$nposition.'</b></h5>
						</div>	
						<div class="card-body">
							<img id="img">
							<div class="row justify-content-center h5 my-3" id="city-weather"></div>
							<div class="row justify-content-center h5 my-3" id="city-temp"></div>					
						</div>
					</div>
				</div>
			</div>';
	}else{
		echo $method-> showMessage('warning','Δεν υπάρχουν Συστήματα Προς το Παρόν',false);
	}	
	echo $output;
?>

<!--Footer...-->	
</div>
</div>
</div>
<!--...Area-->	
<script src="assets/js/JS_weather.js" type="text/javascript"></script>
<script src="assets/js/JS_home.js" type="text/javascript"></script>
