<?php
	require_once 'config.php';

	class Auth extends Database{
		//Register New User 
		public function register($name, $email, $password){
			$sql = "INSERT INTO users(name, email, password) VALUES (:name, :email, :pass)";
			$stmt = $this-> conn->prepare($sql); 
			$stmt-> execute(['name'=>$name, 'email'=>$email, 'pass'=> $password]);			
			return true;
		}

		//Check if user already registered 
		public function user_exist($email){
			$sql = "SELECT email FROM users WHERE email= :email";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['email'=>$email]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC); 

			return $result;
		}
	
		//Login Existing User
		public function login($email){
			$sql = "SELECT email, password FROM users WHERE email = :email AND deleted != 1 AND verified != 0";
			$stmt = $this-> conn->prepare($sql); 
			$stmt-> execute(['email'=>$email]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC); 

			return $row;
		}

		//Current User In session
		public function currentUser($email){
			$sql = "SELECT * FROM users WHERE email = :email AND deleted != 1 AND verified != 0";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['email'=>$email]);
			$row = $stmt-> fetch(PDO::FETCH_ASSOC);

			return $row; 
		}	

		public function tokenUser($email){
			$sql = "SELECT * FROM users WHERE email = :email";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['email'=>$email]);
			$row = $stmt-> fetch(PDO::FETCH_ASSOC);

			return $row; 
		}	
		//Forgot Password
		public function forgot_password($token, $email){
			$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['token'=>$token,  'email'=>$email]);

			return true;
		}

		public function verify_email($email){
			$sql = "UPDATE users SET verified = 1 WHERE email = :email";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['email'=>$email]);

			return true;
		}
		//Reset Password User Auth
		public function reset_pass_auth($email, $token){
			$sql = "SELECT id FROM users WHERE email = :email AND token = :token AND token != '' AND token_expire > NOW() AND deleted != 1 AND verified != 0";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['email'=>$email, 'token'=>$token]);
			$row = $stmt-> fetch(PDO::FETCH_ASSOC);

			return $row; 
		}

		//Update New password
		public function update_new_pass($pass, $email){
			$sql = "UPDATE users SET token = '', password = :pass WHERE email = :email AND deleted != 1 AND verified != 0";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['pass'=>$pass, 'email'=>$email]);

			return true;
		}
 

		//Add New Note
		public function add_new_note($uid, $title, $note){
			$sql = "INSERT INTO notes (uid, title, note) VALUES (:uid, :title, :note)";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['uid'=>$uid, 'title'=>$title, 'note'=>$note]);
			
			return true;
		}

		//fetch All Note Of An User
		public function get_notes($uid){
			$sql = "SELECT * FROM notes WHERE uid = :uid";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['uid'=>$uid]);
			
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
			return $result;
		}

		//Edit Note of An User
		public function edit_note($id){
			$sql = "SELECT * FROM notes WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['id'=>$id]);
			
			$result = $stmt-> fetch(PDO::FETCH_ASSOC);
			return $result;
		}

		//update_Note of An User
		public function update_note($id, $title, $note){
			$sql = "UPDATE notes SET title = :title, note = :note, update_at = NOW() WHERE id = :id";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['id'=>$id, 'title'=>$title, 'note'=>$note ]);
			return true; 
		}

		//Deleted a Note of an user
		public function delete_note($id){
			$sql = "DELETE FROM notes WHERE id = :id";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['id'=>$id]);
			return true;
		}

		//Update Profile of an user
		public function update_profile($name,$photo,$id){
			$sql = "UPDATE users SET name = :name, photo = :photo WHERE id = :id AND deleted != 1";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['name'=>$name, 'photo'=>$photo, 'id'=>$id]);
			return true;
		}

		//Change Password of An User
		public function change_password($pass,$id){
			$sql = "UPDATE users SET password = :pass WHERE id = :id AND deleted != 1";
			$stmt = $this-> conn->prepare($sql);
			$stmt-> execute(['pass'=>$pass, 'id'=>$id]);
			return true;
		}
		
		//Insert Notification
		public function insertNotification($uid,$message,$type){
			$sql = "INSERT INTO notification (uid, message, type) VALUES (:uid, :message, :type)";
			$stmt = $this-> conn-> prepare($sql);
			$stmt-> execute(['uid'=>$uid, 'message'=>$message, 'type'=>$type]);
			return true;
		}

		//Fetch Notification
		public function fetchNotification($uid){
			$sql = "SELECT * FROM notification WHERE uid = :uid ORDER BY type";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['uid'=>$uid]);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			return $result;
		}

		//Remove Notification
		public function removeNotification($id){
			$sql = "DELETE FROM notification WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id'=>$id]);
			return true;
		}					
	}
?>		
