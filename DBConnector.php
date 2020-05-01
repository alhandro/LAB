<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','ics3104');

class DBConnector{
	public $conn;
	public function _construct()
	{
		$this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,) or die("Error:".mysqli_error());
		mysqli_select_db($this->conn,DB_NAME);
		if ($conn) {
			echo "connected successfully to my database!";
			# code...
		}
	}
	 public function closeDatabase(){
		mysqli_close($this->conn);
	}
	
}
?>
