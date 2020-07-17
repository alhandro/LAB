<?php
	
	include_once '../../../DBConnector.php';

	/**
	* 
	*/
	class ApiHandler
	{

		private $meal_name;
		private $meal_units;
		private $unit_price;
		private $status;
		private $user_api_key;

		public function setMealName($meal_name)
		{
			$this->meal_name = $meal_name;
		}

		public function getMealName()
		{
			return $this->meal_name;
		}

		public function setMealUnits($meal_units)
		{
			$this->meal_units = $meal_units;
		}

		public function getMealUnits()
		{
			return $this->meal_units;
		}

		public function setunitPrice($unit_price)
		{
			$this->unit_price = $unit_price;
		}

		public function getUnitPrice()
		{
			return $this->unit_price;
		}

		public function setStatus($status)
		{
			$this->status = $status;
		}

		public function getStatus()
		{
			return $this->status;
		}

		public function setUserApiKey($key)
		{
			$this->user_api_key = $key;
		}

		public function getUserApiKey()
		{
			return $this->user_api_key;
		}


		public function createOrder()
		{
			$con = new DBConnector();

			$res = mysqli_query($con->conn, "INSERT INTO orders (order_name, units, unit_price, order_status) VALUES ('$this->meal_name', '$this->meal_units', '$this->unit_price', '$this->status')") or die("Error: " . mysqli_error($con->conn));

			return $res;
		}

		public function checkOrderStatus($order_id)
		{
			$con = new DBConnector();

			$res = mysqli_query($con->conn, "SELECT order_status FROM orders WHERE order_id = '$order_id'") or die("Error " . mysqli_error($con->conn));

			$con->closeDatabase();

			if (mysqli_num_rows($res)) {
				return $res;
			}
			
			return false;
		}

		public function fetchAllOrders()
		{
			$con = new DBConnector();

			$res = mysqli_query($con->conn, "SELECT * FROM orders ") or die("Error " . mysqli_error($con->conn));

			$con->closeDatabase();

			return $res;
			
		}

		public function checkApiKey()
		{
			$con = new DBConnector();

			$res = mysqli_query($con->conn, "SELECT api_key FROM api_keys WHERE api_key = '$this->user_api_key'") or die("Error " . mysqli_error($con->conn));

			$con->closeDatabase();

			if (mysqli_num_rows($res)>0) {
				return true;
			}
			else if(mysqli_num_rows($res)==0){
			
			return false;
		}
		}
		public function checkContentType()
		{
			# code...
		}
		
		// function __construct(argument)
		// {
		// 	# code...
		// }
	}

?>