<?php

	class Database{
		//Στοιχεία σύνδεσης email για αποστολή μηνθμάτων στον χρήστη
		const USERNAME = '';
		const PASSWORD = '';
		
		//Στοιχεία σύνδεσης στην βάση δεδομένων
		private $dsn = "";
		private $dbuser = "";
		private $dbpass = ""; 

		//Σύνδεση στην βάση
		public $conn;
		public function __construct(){
			try{
				$this-> conn = new PDO($this-> dsn, $this-> dbuser, $this-> dbpass);
			}catch (PDOException $e){
				echo 'Error : '.$e->getMessage();
			}
			return $this->conn; 
        }
        
        public function test_input($data){
			$data = trim($data);  
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data; 	 
		}
	}
?>
