<?php
include"crud.php";
//include_once "DBConnector.php";
//$con = new DBConnector;
class user implements Crud{
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;
	private $con;
	function _construct($first_name,$last_name,$city_name,$con){
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;	
		$this->conn = new DBConnector();	
		$this->con = $con;			
		}
		
		public function setUserId($user_id){
			$this->user_id = $user_id;

		}
		public function getUserId(){
		return $this->$user_id;

		}
		public function save(){
           $conn = new DBConnector();
			//$this->DBConnector();
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city =$this->city_name;
			//$con = $this->con;
			$con =mysqli_connect('localhost','root','','ics3104');
			
			$res=mysqli_query($con, "INSERT INTO users (first_name,last_name,user_city) VALUES('$fn','$ln','$city')")or die("Error:".mysqli_error($con));
			//return $res;
			//$res=mysqli_query($this->con->conn, "INSERT INTO users (first_name,last_name,user_city) VALUES('$fn','$ln','$city')")or die("Error:".mysqli_error($this->con->conn));

			return $res;

		}
		
		public function readAll(){

			return null;
		}
		public function readUnique(){
			return null;
		}
		public function search(){
			return null;
		}
		public function update(){
			return null;
		}
		public function removeOne(){
			return null;
		}
		public function removeAll(){
			return null;
		}
	}
?>
