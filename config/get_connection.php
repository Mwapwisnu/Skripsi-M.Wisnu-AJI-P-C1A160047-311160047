
		<?php
		error_reporting(E_ALL & ~E_NOTICE);
		date_default_timezone_set('Asia/Jakarta');
		define ("hostname","localhost");
		define ("user","root");
		define ("password","");
		define ("database","db_appdesa");
		define ("BASE_URL","");

		function connect(){
		    $connect = mysqli_connect(hostname, user, password, database);
		    if($connect){
		        return $connect;
		    } else {
		      return FALSE;
		    }
		}
		?>
		