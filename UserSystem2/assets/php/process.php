<?php
	ob_start();
	require_once 'session.php';
	
	//Handle Add New Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'add_note') {
		$title = $method->test_input($_POST['title']);
		$note = $method->test_input($_POST['note']);

		$cuser-> add_new_note($cid, $title, $note);
	}

	//Handle Display All Notes Of An User
	if(isset($_POST['action']) && $_POST['action'] == 'display_notes'){
		$output = '';

		$notes = $cuser-> get_notes($cid);
		if($notes){
			$output .= '<table class="table table-striped text-center">
						<thead>
							<tr>
								<th>#</th>
								<th>Τίτλος</th>
								<th>Σημείωση</th>
		  						<th>Ενέργεια</th>
							</tr>
						</thead>
						<tbody>';
			foreach ($notes as $row) {
				$output .= '<tr>
								<td>'.$row['id'].'</td>
								<td>'.$row['title'].'</td>
								<td>'.substr($row['note'],0, 75 ).'...</td>
								<td>
									<a href="#" id="'.$row['id'].'" title="Δες τις λεπτομέρειες" class="text-success infoBtn">
									<i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
								
									<a href="#" id="'.$row['id'].'"title="Επεξεργασία σημείωσης" class="text-primary editBtn">
									<i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNoteModal"></i></a>&nbsp;

									<a href="#" id="'.$row['id'].'" title="Διαγραφή σημείωσης" class="text-danger deleteBtn">
									<i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;
								</td>
							</tr>';
			}
			
			$output .= '</tbody> </table>';
			echo $output;
		}
		else{
		echo $method-> showMessage('warning','Δεν έχεις γράψει ακόμα κάποια σημείωση, γράψε την πρώτη σου σημείωση τώρα!',false); 
		}
	}

	//Handle Edit Note of An User Ajax Request
	if (isset($_POST['edit_id'])) {
		$id = $_POST['edit_id'];
		$row = $cuser-> edit_note($id);
		echo json_encode($row);	
	}

	//Hndle Update Note  of An User Ajax Request
	if(isset($_POST['action']) && $_POST['action'] == 'update_note'){
		$id = $method-> test_input($_POST['id']);
		$title = $method-> test_input($_POST['title']);
		$note = $method-> test_input($_POST['note']);
		$cuser-> update_note($id, $title, $note);
	}

	//Handle Delete a Note of An User Ajax Request
	if(isset($_POST['del_id'])){
		$id = $_POST['del_id'];
		$cuser-> delete_note($id);
	}

	//Handle Display a Note of An User Ajax Request
	if(isset($_POST['info_id'])){
		$id = $_POST['info_id'];
		$row = $cuser-> edit_note($id);
		echo json_encode($row); 
	}

	///////////////////////////////////////////////////////////////////
	//////////////////////////// PROFILE //////////////////////////////
	///////////////////////////////////////////////////////////////////

	//Handle Profile Update Ajax Request
	if(isset($_FILES['image'])){
		$name = $method-> test_input($_POST['name']);
		$oldImage = $_POST['oldimage'];
		$folder = 'uploads/';
		if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")){
		    $newImage = $folder.$_FILES['image']['name'];
		    move_uploaded_file($_FILES['image']['tmp_name'], $newImage);
		    if($oldImage != null){
		        unlink($oldImage);
		    }
		}
	    else{
	        $newImage = $oldImage;
	    }
	    $cuser->update_profile($name, $newImage, $cid);
	}

	//Handle Change Password Ajax Request
	if (isset($_POST['action']) && $_POST['action'] == 'change_pass'){
		$currentPass = $_POST['curpass'];
		$newPass = $_POST['newpass'];
		$cnewPass = $_POST['cnewpass'];
		$hnewPass = password_hash($newPass, PASSWORD_DEFAULT);

		if ($newPass != $cnewPass) {
			echo $method-> showMessage('danger','Ο κωδικός δεν ταιριάζει!',true);
		}
		else{
			if($newPass != $currentPass){
				if(password_verify($currentPass, $cpass)){
					$cuser-> change_password($hnewPass,$cid);
					echo $method-> showMessage('success','Ο κωδικός άλλαξε με επιτυχία!',true);
				}
				else{
					echo $method-> showMessage('danger','Ο τωρινός κωδικός είναι λάθος!',true);
				}
			}
			else{
				echo $method-> showMessage('danger','Χρησιμοποιήστε διαφορετικό κωδικό από τον τωρινό!',true);
			}
		}	
	}
 
	//////////////////////////////////////////////////////////////
	////////////////////// NOTIFICATION //////////////////////////
	/////////////////////////////////////////////////////////////

	//Fetch Notification
	if(isset($_POST['action']) && $_POST['action'] == 'fetchNotification'){
		$notification = $cuser-> fetchNotification($cid);
		$output = '';
		if($notification){
			foreach ($notification as $row){
				$output .= '<div class="alert alert-dark" role="alert"> 
								<button type="button" id="'.$row['id'].'"class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h4 class="alert-heading">'.$row['type'].'</h4>
								<p class="mb-0 lead">'.$row['message'].'</p>
								<hr class="my-2">
								<div class="bg-light">
									<p class="mb-0 float-right">'.$method->timeInAgo($row['created_at']).'</p>
								</div>
								<div class="clearfix"></div>
							</div>';
			}
			echo $output;
		}
		else {
			echo $method-> showMessage('warning','Δεν Υπάρχουν Ενημερώσεις!',false); 
		}
	}

	//Check Notification 
	if(isset($_POST['action']) && $_POST['action'] == 'checkNotification'){
		$notification = $cuser-> fetchNotification($cid); 
		if($notification){
			echo '<b class="text-danger text-bold">('.count($notification).')</b>';
		}
		else{
			echo '';
		}
	}

	//Remove Notification
	if(isset($_POST['notification_id'])){
		$id = $_POST['notification_id'];
		$cuser->removeNotification($id);
	}
	
	////////////////////////////////////////////////////////////////////
	//////////////////////////// EXPORT ////////////////////////////////
	////////////////////////////////////////////////////////////////////

	//Εξαγωγή Δεδομένων σε ecxel
	if(isset($_GET['export']) && $_GET['export'] == 'excel'){
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=data.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		$comma=",";
		$field_termineted="\n";

		$output="";
		$output.="Όνομα Δικτύου: ".$comma.$nname.$field_termineted;
		$output.="Τοποθεσία Δικτύου: ".$comma.$nposition.$field_termineted;
		$output.=$field_termineted."Ονόμα Συστήματος".$comma."Mac Address Συστήματος".$comma."Token".$field_termineted;
		foreach($systemsUser as $row){
			$output.=$row["name"].$comma.$row["mac"].$comma.$row["token"].$field_termineted;
		}
		$output.=$field_termineted."Δεδομένα".$field_termineted;
		$output.="Θερμοκρασία Περιβάλλοντος,Υγρασία Περιβάλλοντος,Υγρασία Εδάφους,Ημερομηνία,Token".$field_termineted;
		

		foreach ($resultData as $row){
			$output.= $row['temperature'].$comma.$row['humidity'].$comma.$row['hygrometer'].$comma.$row['created_at'].$comma.$row['token'].$field_termineted;
		}

		echo $output;
	}

	//Εξαγωγή Δεδομένων σε csv
	if(isset($_GET['export']) && $_GET['export'] == 'csv'){
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment; filename=data.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$comma=",";
		$field_termineted="\n";

		$output="";
		$output.="Όνομα Δικτύου: ".$comma.$nname.$field_termineted;
		$output.="Τοποθεσία Δικτύου: ".$comma.$nposition.$field_termineted;
		$output.=$field_termineted."Ονόμα Συστήματος".$comma."Mac Address Συστήματος".$comma."Token".$field_termineted;
		foreach($systemsUser as $row){
			$output.=$row["name"].$comma.$row["mac"].$comma.$row["token"].$field_termineted;
		}
		$output.=$field_termineted."Δεδομένα".$field_termineted;
		$output.="Θερμοκρασία Περιβάλλοντος,Υγρασία Περιβάλλοντος,Υγρασία Εδάφους,Ημερομηνία,Token".$field_termineted;
		

		foreach ($resultData as $row){
			$output.= $row['temperature'].$comma.$row['humidity'].$comma.$row['hygrometer'].$comma.$row['created_at'].$comma.$row['token'].$field_termineted;
		}

		echo $output;
	}
	
	///////////////////////////////////////////////////////////////////////
	//////////////////////////// NETWORK //////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	//Fetch Network of user
	if(isset($_POST['action']) && $_POST['action'] == ('displayNetwork')){
		$output = '';
		if($networkData){
			$output .= '<table class="table table-striped text-center">
							<thead>
								<tr>
									<th>Όνομα Δικτύου</th>
									<th>Θέση Δικτύου</th>
									<th>Εργασία</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>'.$networkData['name'].'</td>
									<td>'.$networkData['position'].'</td>
									<td>
										<a id="'.$networkData['id'].'" title="Επεξεργασία" class="text-primary editNetworkBtn">
										<i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editNetworkModal"></i></a>&nbsp;
									</td>
									</tr>
							</tbody>
						</table>';
			echo $output;
		}else {
		echo $method-> showMessage('warning','Δεν Έχετε Δημιουργήσει Το Δίκτυο Σας Ακόμη!',false); 
		}
	}

	//Handle add new network
	if (isset($_POST['action']) && $_POST['action'] == 'addNetwork') {
		$nameNet = $method-> test_input($_POST['newNameNet']);
		$positionNet = $method-> test_input($_POST['newPositionNet']);

		if ($networkData == NULL){
			$network-> insertNet($cid,$nameNet,$positionNet);
			echo 'ok';
		}else if ($networkData != NULL) {
			echo 'problemNet';
		}else{
			echo 'problem';
		}
	}	

	//Handle Edit Network
	if (isset($_POST['editNet'])) {
		$id = $_POST['editNet'];
		$row = $network-> editNet($id);
		echo json_encode($row);	
	}

	//Update Network
	if(isset($_POST['action']) && $_POST['action'] == 'updateNet'){
		$id = $method-> test_input($_POST['idNet']);
		$name = $method-> test_input($_POST['nameNet']);
		$position = $method-> test_input($_POST['positionNet']);
		$network-> updateNet($id, $name, $position);
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////// SYSTEM ////////////////////////////////
	////////////////////////////////////////////////////////////////////
	
	//Fetch All Systems of user
	if(isset($_POST['action']) && $_POST['action'] == 'displaySystems'){
		$output = '';
		if($systemsUser){
			$output .= '<table class="table table-striped text-center">
					<thead>
						<tr>
							<th>Όνομα</th>
							<th>Mac Address</th>
							<th>Token</th>
							<th>Τοποθεσία</th>
							<th>Εργασία</th>
						</tr>
					</thead>
					<tbody>';
			foreach ($systemsUser as $row) {
				$output .= '<tr>
								<td>'.$row['name'].'</td>
								<td>'.$row['mac'].'</td>
								<td>'.$row['token'].'</td>
								<td>'.$row['position'].'</td>
								<td>
									<a id="'.$row['id'].'" title="Επεξεργασία" class="text-primary editBtn">
									<i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editSystemModal"></i></a>&nbsp;
									<a id="'.$row['id'].'" title="Διαγραφή" class="text-danger deleteBtn">
									<i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;
								</td>
							</tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		}else {
			echo $method-> showMessage('warning','Δεν Υπάρχουν Συστήματα!',false); 
		}
	}

	//Handle add new system
	if (isset($_POST['action']) && $_POST['action'] == 'add_system') {
		$name = $method->test_input($_POST['newNameSystem']);
		$mac = $method->test_input($_POST['newMacSystem']);
		$position = $method->test_input($_POST['newPositionSystem']);
		
		$checkMac = $system->checkMac($mac);	
		$checkName = $system->checkName($name);
		
		if($checkMac == NULL && $checkName == NULL && $networkData != NULL){
			$token = uniqid();
			$token = str_shuffle($token);
			$system-> createdSystem($nid, $mac, $token, $name, $position);	
			echo 'ok';
		}else if($networkData == NULL) {
			echo 'problemNet';
		}else {
			echo 'problem';
		}
	}

	//Remove System
	if(isset($_POST['delSystem'])){
		$id = $_POST['delSystem'];
		$system->removeSystem($id); 
	}

	//Handle Edit System
	if (isset($_POST['editSystem'])) {
		$id = $_POST['editSystem'];
		$row = $system-> editSystem($id);
		echo json_encode($row);	
	}

	//Update system
	if(isset($_POST['action']) && $_POST['action'] == 'updateSystem'){
		$id = $method-> test_input($_POST['idSystem']);
		$name = $method-> test_input($_POST['nameSystem']);
		$position = $method-> test_input($_POST['positionSystem']);
		$system-> updateSystem($id, $name, $position);
	}

ob_end_flush();
?>		
