<?php
require_once 'session.php';

/** Οι μεταβλητές $resultData, $systemsUser αρχικοποιούνται στο session.php. 
 * Περιέχουν τα δεδομένα και τα συστήματα των χρηστών αντίστοιχα.
*/
     
$dataCount = count($resultData); //Πλήθος δεδομένων χρήστη
$systemCount = count($systemsUser);//Πλήθος συστημάτων χρήστη

$response = array(); //Δημιουργία πίνακα για json

//Έλεγχος εαν ο χρήστης διαθέτει συστήματα 
if($systemCount > 0){    
    //Έλεγχος εάν τα συστήματα έχουν δεδομένα
    if($dataCount > 0 ){
        //Δημιουργείται η json μορφή για κάθε σύστηματα με τα δεδομένα των αισθητήρων.
        foreach($systemsUser as $row){
            $token = $row["token"];
            $name = $row["name"];
            $response[$name] = array();
            $sensorData = array();
            foreach($resultData as $row){
                if($row["token"] == $token){    
                    $sensorData["id"] = $row["id"];
                    $sensorData["humidity"] = $row["humidity"];
                    $sensorData["temperature"] = $row["temperature"];
                    $sensorData["hygrometer"] = $row["hygrometer"];
                    $sensorData["created_at"] = $row["created_at"];
                    array_push($response[$name], $sensorData);
                }
            }
        }
        
        // Εμφάνιση του json
        echo json_encode($response);
    }	
    else 
    {
        $response["message"] = "Δεν Υπάρχουν Δεδομένα Στο Σύστημα";
        echo json_encode($response);
    }
}else{
    $response["message"] = "Δεν Υπάρχουν Συστήματα";
    echo json_encode($response);
}
?>
