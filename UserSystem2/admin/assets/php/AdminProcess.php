<?php
require_once 'AdminSession.php';

    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    require '/opt/lampp/htdocs/UserSystem2/assets/php/vendor/autoload.php';
    $mail = new PHPMailer(true);

//Handle Display All Notes Of An User
if(isset($_POST['action']) && $_POST['action'] == 'displayUsers'){
    $output = '';
    $users = $admin-> users();
    if($users){
        $output .= '<table class="table table-striped text-center">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created_at</th>
                            <th>Επιβεβαιώθηκε</th>
                            <th>Κατάσταση</th>
                            <th>Διαγραφή</th>
                        </tr>
                        </thead>
                        <tbody>';
        foreach ($users as $row) {
            
            if($row['verified'] == 0){$verified = 'Όχι';}
            else{$verified = 'Ναί';}

            if($row['deleted'] == 0){
                $deleted = '<a href="#" id="'.$row['id'].'"title="Ενεργός" class="text-success unlockBtn">
                <i class="fa fa-unlock-alt fa-lg" data-toggle="modal" data-target="#editUserModal"></i></a>&nbsp;';
            }
            else{
                $deleted = '  <a href="#" id="'.$row['id'].'"title="Κλείστός" class="text-warning lockBtn">
                <i class="fa fa-lock fa-lg" data-toggle="modal" data-target="#editUserModal"></i></a>&nbsp;';
            }

            $output .= '<tr>
                            <td>'.$row['id'].'</td>
                            <td>'.$row['name'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['created_at'].'</td>
                            <td>'.$verified.'</td>
                            <td>'.$deleted.'</td>
                            <td> 
                                <a href="#" id="'.$row['id'].'" title="Συστήματα" class="text-success infoBtn">
								<i class="fas fa-info-circle fa-lg"></i></a>&nbsp;
								                                  
                                <a href="#" id="'.$row['id'].'" title="Διαγραφή χρήστη" class="text-danger deleteBtn">
                                <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;
                            </td>
                        </tr>';
        }
        
        $output .= '</tbody></table>';
        echo $output;
    }
}

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];
    $admin-> delete_user($id);
}

if(isset($_POST['unlock_id'])){
    $id = $_POST['unlock_id'];
    $deleted = 1; 
    $admin-> updateUser($id, $deleted);
}

if(isset($_POST['lock_id'])){
    $id = $_POST['lock_id'];
    $deleted = 0; 
    $admin-> updateUser($id, $deleted);

    $verifiedCheck = $admin-> userCheck($id);
    $email = $verifiedCheck['email'];
    $token = $verifiedCheck['token'];
    if($verifiedCheck['verified'] == 0){
        try{
            $mail-> isSMTP();
            $mail-> Host = 'smtp.gmail.com';
            $mail-> SMTPAuth = true;		
            $mail-> Username = Database::USERNAME;
            $mail-> Password = Database::PASSWORD;
            $mail-> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail-> Port = 587;

            $mail-> setFrom(Database::USERNAME, 'SmartFarm');
            $mail-> addAddress($email);

            $mail-> isHTML(true);
            $mail-> Subject = 'Account reset';
            $mail-> Body = '<h3>Πατήστε το παρακάτω λινγκ για την Επιβεβαίωση του λογαριασμού σας.<br><a href="https://localhost/UserSystem2/verify-email.php?email='.$email.'&token='.$token.'">https://localhost/UserSystem2/verify-email.php?email='.$email.'&token='.$token.'</a><br>Regards<br>SmartFarm!</h3>';
            $mail-> send();          
        }
        catch (Exception $e){
            echo 'Κάτι πηγε στραβά! Παρακαλώ προσπαθήστε ξανά σε λίγο!';
        }
    }
}

if(isset($_POST['info_id'])){
    $uid = $_POST['info_id']; 
    $network = $admin-> network($uid);
       
    $nid = $network['id'];
    $name = $network['name'];
    $position = $network['position'];
    $created = $network['created_at'];

    $systems = $admin-> countSystem($nid);
    $output = '';

    if($network){
        $output .= ' <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Posision</th>
                                <th>Created_at</th>
                                <th>Systems</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody">
                            <tr>
                                <td>'.$nid.'</td>
                                <td>'.$name.'</td>
                                <td>'.$position.'</td>
                                <td>'.$created.'</td>
                                <td>'.$systems['systems'].'</td>
                                <td> <a href="#" id="'.$nid.'" title="Διαγραφή Δικτύου" class="text-danger deleteBtnNet">
                                <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>';
    }else{
        $output .= 'Ο χρήστης δεν διαθέθει κάποιο δίκτυο ακόμη';
    }  
    echo $output;
} 

if(isset($_POST['delNet_id'])){
    $id = $_POST['delNet_id'];
    $admin-> delete_net($id);
}

?>