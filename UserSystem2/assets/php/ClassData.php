<?php
    require_once 'config.php';
    
    class Data extends Database{
		//Εισαγωγή Ληφθέντων Δεδομένων Στον Πίνακα sensors 
		public function insertSensorData($temperature, $humidity, $hygrometer, $token, $action){
			$result = "INSERT INTO sensors (temperature, humidity, hygrometer, token, action) VALUES (:temperature, :humidity, :hygrometer, :token, :action)";
    		$stmt = $this-> conn-> prepare($result);
			$stmt-> execute(['temperature'=>$temperature, 'humidity'=>$humidity, 'hygrometer'=>$hygrometer, 'token'=>$token, 'action'=>$action]);
			return true;
		}
		
		//Επιλογή των δεδομένων από όλα συστήματα τα οποία ανήκουν στο δίκτυο του ενεργού χρήστη.   
		public function readSensorData($nid){
			$sql = "SELECT sensors.id, sensors.humidity, sensors.hygrometer, sensors.temperature, sensors.token, sensors.created_at, sensors.action FROM sensors, system WHERE system.nid = :nid AND system.token = sensors.token";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['nid'=> $nid]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		//Επιλογή δεδομένων για το σύστημα που έχει επιλέξει ο χρήστης στον κανόνα του.
		public function checkData($id){
			$sql = "SELECT sensors.humidity, sensors.id, sensors.hygrometer, sensors.temperature, sensors.created_at FROM sensors, system WHERE system.id = :id AND system.token = sensors.token ORDER BY sensors.id DESC LIMIT 1";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['id'=> $id]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}	
	}
?>