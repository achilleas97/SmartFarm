<?php  
	require_once 'config.php';
    
    class Network extends Database{
        
		//Εισαγωγή Δικτύου Συστημάτων από τον ενεργό χρήστη
		public function insertNet ($uid,$name,$position){
			$sql = "INSERT INTO network (uid, name, position) VALUES (:uid, :name, :position)";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['uid'=>$uid, 'name'=>$name, 'position'=>$position]);
			return true;
		}
		
		//Επιλογή Του Δικτύου Συστημάτων Από Τον Τνεργό Χρήστη
		public function currentNet($uid){
			$sql = "SELECT * FROM network WHERE uid = :uid";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['uid'=>$uid]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result; 
		}

		//Ενημέρωση Του Δικτύου
		public function updateNet($id, $name, $position){
			$sql = "UPDATE network SET name = :name, position = :position WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['name'=>$name, 'position'=>$position, 'id'=>$id]);
			return true;
		}

		//Edit Network
		public function editNet($id){
			$sql = "SELECT * FROM network WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['id'=>$id]);
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
    }
?>