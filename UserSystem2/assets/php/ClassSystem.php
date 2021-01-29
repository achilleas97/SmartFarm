<?php  
	require_once 'config.php';
    
    class System extends Database{

        //Επιλογή των Συστημάτων του ενεργού χρήστη
		public function currentSystem($nid){
			$sql = "SELECT id, nid, INET_NTOA(mac) as mac, token, name, position, created_at FROM system WHERE nid = :nid";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['nid'=>$nid]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $result; 
		}
		
		//Δημιουργία Συστημάτων
		public function createdSystem($nid, $mac, $token, $name, $position){
			$sql = "INSERT INTO system (nid, mac, token, name, position) VALUES (:nid, INET_ATON(:mac), :token, :name, :position)";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['nid'=>$nid, 'mac'=>$mac, 'token'=>$token, 'name'=>$name, 'position'=>$position]);
			return true;
		}

		//Έλεγχος συστήματος με βάση τo token 
		public function checkToken($token){
			$sql = "SELECT system.name, network.uid FROM system, network WHERE system.token = :token and system.nid = network.id";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['token'=>$token]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC); 

			return $result;
		}

		//Έλεγχος συστήματος με βάση το name 
		public function checkName($name){
			$sql = "SELECT name FROM system WHERE name= :name";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['name'=>$name]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC); 

			return $result;
		}
 
		//Επεξεργασία Συστηματων
		public function editSystem($id){
			$sql = "SELECT * FROM system WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['id'=>$id]);
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		
		//Ενημέρωση Συστημάτων
		public function updateSystem($id, $name, $position){
			$sql = "UPDATE system SET name = :name, position = :position WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['name'=>$name, 'position'=>$position, 'id'=>$id]);
			return true;
		}
		
		//Διαγραφή Συστημάτων 
		public function removeSystem($id){
			$sql = "DELETE FROM system WHERE id = :id";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['id'=>$id]);
			return true;
		}
    }
?>