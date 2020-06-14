<?php
	session_start();

	include_once 'DBConnector.php';
	include_once 'user.php';


	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		header('HTTP/1.0 403 Forbidden');

		echo "You are forbidden";

	} else {
		$api_key = null;
		$api_key = generateApiKey(64);
		header('Content-type: application/json');

		echo generateResponse($api_key);
	}

	function generateApiKey($str_length)
	{
		$chars = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLMNBVCXZ';

		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

		$repl = unpack('C2', $bytes);

		$first = $chars[$repl[1]%62];
		$second = $chars[$repl[2]%62];

		return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
	}

	function saveApiKey($api_key)
	{
		$db = new DBConnector();

		$id = $_SESSION['id'];

		if (fetchUserApiKey($id) !== false) {
			$res = mysqli_query($db->conn, "UPDATE api_keys SET api_key='$api_key' WHERE user_id=$id") or die("Error " . mysqli_error($this->con->conn));
		} else {
			$res = mysqli_query($db->conn, "INSERT INTO api_keys(user_id, api_key) VALUES($id, '$api_key')") or die("Error " . mysqli_error($this->con->conn));
		}

		$db->closeDatabase();

		if ($res) {
			return true;
		}
		return false;
	}

	function generateResponse($api_key)
	{
		if (saveApiKey($api_key)) {
			$res = ['success' => 1, 'message' => $api_key];

		} else {
			$res = ['success' => 0, 'message' => 'Something went wrong, Please regenerate the API key'];
		}

		return json_encode($res);
	}

	function fetchUserApiKey($id) {
		$apis_read = User::create();
		$api = $apis_read->readUserApiKey($id);

		return $api;
	}

?>
