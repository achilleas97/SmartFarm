<?php
require_once 'ClassData.php';
require_once 'ClassAuth.php';
require_once 'ClassSystem.php';
$sensor = new Data();
$user = new Auth();
$system = new System();

//Ελεγχος για το εαν υπαρχουν οι τιμές temperature,humidity,hygrometer,mac 
if (isset($_GET['temperature']) && isset($_GET['humidity']) && isset($_GET['hygrometer']) && isset($_GET['action']) && isset($_GET['token'])){
    
    //Eισαγωγή των τιμών που λήφθησαν σε αντίστοιχες μεταβλητές
    $temperature = $_GET['temperature']; 
    $humidity = $_GET['humidity'];
    $hygrometer = $_GET['hygrometer'];
    $token = $_GET['token'];
    $action = $_GET['action'];

    $checkToken = $system->checkToken($token);
    $systemName = $checkToken['name'];
    $uid = $checkToken['uid'];

    if($checkToken){
        //Εισαγωγή των δεδομένων στην βάση 
        $sensor-> insertSensorData($temperature, $humidity, $hygrometer, $token, $action);   

        //Εισαγωγή ενημέρωσης
        if($action == 1){ 
            $type = 'Μέγιστη Θερμοκρασία';
        }else if($action == 2){
            $type = 'Ελάχιστη Θερμοκρασία';
        }else if($action == 3){
            $type = 'Μέγιστη Υγρασία Περιβάλλοντος'; 
        }else if($action == 4){
            $type = 'Ελάχιστη Υγρασία Περιβάλλοντος';
        }else if($action == 5){
            $type = 'Μέγιστη Υγρασία Εδάφους';
        }else if($action == 6){
            $type = 'Ελάχιστη Υγρασία Εδάφους';
        }
        
        $message = 'Εντοπίστηκε για το σύστημα '.$systemName;
        $user-> insertNotification($uid,$message,$type);
    }
}
?>