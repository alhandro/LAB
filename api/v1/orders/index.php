<?php
	
	include_once 'apiHandler.php';
	include_once '../../../DBConnector.php';

	$api = new ApiHandler();

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		$api_key_correct = false;
		$headers = apache_request_headers();

		$header_api_key = $headers['Authorization'];

		$api->setUserApiKey($header_api_key);
		
		$api_key_correct = $api->checkApiKey();

		if ($api_key_correct) {
			
			$name_of_food = $_POST['name_of_food'];
			$number_of_units = $_POST['number_of_units'];
			$unit_price = $_POST['unit_price'];
			$order_status = $_POST['order_status'];

			$con = new DBConnector();

			$api->setMealName($name_of_food);
			$api->setMealUnits($number_of_units);
			$api->setunitPrice($unit_price);
			$api->setStatus($order_status);

			$res = $api->createOrder();

			if ($res) {
				
				$response_array = ['success' => 1, 'message' => 'Order has been placed'];
				header('Content-type: application/json');
				echo json_encode($response_array);

			}

		} else {
			$response_array = ['success' => 0, 'message' => 'Wrong API key'];
			header('Content-type: application/json');
			echo json_encode($response_array);	
		}

	} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {

		$api_key_correct = false;
		$headers = apache_request_headers();

		$header_api_key = $headers['Authorization'];

		$api->setUserApiKey($header_api_key);
		$api_key_correct = $api->checkApiKey();

		if ($api_key_correct) {

			$con = new DBConnector();

			if (isset($_GET['retrieve_orders'])) {
				
				$res = $api->fetchAllOrders();

				$count_orders = mysqli_num_rows($res);

				if ($res !== false) {

					$response_array = array();
					$row = array();

					for ($i=0; $i < $count_orders; $i++) 
					{
						$ress = mysqli_fetch_array($res);

						$row = ['id' => $ress['order_id'], 'name' => $ress['order_name'], 
						'units' => $ress['units'], 'price' => $ress['unit_price'], 'status' => $ress['order_status']];
						
						$response_array[] = $row;
					}

					header('Content-type: application/json');
					echo json_encode($response_array);

				} else {

					$response_array = ['success' => 0, 'message' => 'No order like that'];
					header('Content-type: application/json');
					echo json_encode($response_array);
				}

				return;

			}
			
			
			$order_id = $_GET['order_id'];

			$res = $api->checkOrderStatus($order_id);

			if ($res !== false) {

				$status = mysqli_fetch_assoc($res)['order_status'];

				$response_array = ['success' => 1, 'message' => $status];
				header('Content-type: application/json');
				echo json_encode($response_array);

			} else {

				$response_array = ['success' => 0, 'message' => 'No order like that'];
				header('Content-type: application/json');
				echo json_encode($response_array);
			}
		} else {
			$response_array = ['success' => 0, 'message' => 'Wrong API key'];
			header('Content-type: application/json');
			echo json_encode($response_array);	
		}

	} else {

		echo 'Unsupported';

	}

?>