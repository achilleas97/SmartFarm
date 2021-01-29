<?php
    class Util { 
		//Check Input
		public function test_input($data){
			$data = trim($data);  
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data; 	 
		}  

		//Massage Alert for users
		public function showMessage($type, $message,$button){
			if($button){
				return '<div class="alert alert-'.$type.' alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong class="text-center">'.$message.'</strong> 
					</div>';
			}else{
				return '<div class="alert alert-'.$type.' alert-dismissible">
						<strong class="text-center">'.$message.'</strong> 
					</div>';
			}
		}
		
		//Display time in ago
		public function timeInAgo ($timestamp){
			date_default_timezone_set('Europe/Athens');
			$timestamp = strtotime($timestamp) ? strtotime($timestamp) : $timestamp;
			$time = time() - $timestamp;
			switch($time){
				//seconds
				case $time <= 60:
					return 'Just Now!';
				//Minutes
				case $time >= 60 && $time < 3600:
					return (round($time/60) == 1)? 'a minute ago' : round($time/60).' minutes ago';
				//Hours
				case $time >= 3600 && $time < 86400:
					return (round($time/3600) == 1)? 'a hour ago' : round($time/3600).' hours ago';
				//Days
				case $time >= 86400 && $time < 604800:
					return (round($time/86400) == 1)? 'a day ago' : round($time/86400).' days ago';
				//Weeks
				case $time >= 604800 && $time < 2600640:
					return (round($time/604800) == 1)? 'a week ago' : round($time/604800).' weeks ago';
				//Months
				case $time >= 2600640 && $time < 31207680:
					return (round($time/2600640) == 1)? 'a month ago' : round($time/2600640).' months ago';
				//Years
				case $time >= 31207680;
					return (round($time/31207680) == 1)? 'a year ago' : round($time/31207680).' years ago';
				
			}
		}
    }
?>