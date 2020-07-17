<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>External App</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="placeorder.js"></script>

</head>
<body style="padding: 3em;">
	<h3>It is time to communicate with the exposed API, all we need is the API key to be passed in the header</h3>
	<hr>
	<div class="row">
		<div class="col-sm-6" align="center">
			<h4>1. Feature 1 - Placing an order</h4>
			<hr>

			<form name="order_form" id="order_form">
				<fieldset>
					<legend>Place order</legend>
					<input type="text" name="name_of_food" id="name_of_food" required placeholder="name of food"><br>
					<input type="number" name="number_of_units" id="number_of_units" required placeholder="number of units"><br>
					<input type="number" name="unit_price" id="unit_price" required placeholder="unit price"><br>
					<input type="hidden" name="order_status" id="order_status" required placeholder="status of order" value="order placed"><br><br>

					<button class="btn btn-primary" type="submit" id="btn-place-order">Place Order >></button>
				</fieldset>
			</form>
		</div>

		<div class="col-sm-6" align="center">
			<h4>2. Feature 2 - Checking order status</h4>
			<hr>

			<form name="order_status_form" id="order_status_form" method="post" action="<?=$_SERVER['PHP_SELF']?>">
				<fieldset>
					<legend>Check order status</legend>

					<input type="number" name="order_id" id="order_id" required placeholder="order ID"><br><br>

					<button class="btn btn-warning" type="submit" id="btn-check-order">Check Order Status</button>
				</fieldset>
			</form>
		</div>
		<hr>
	</div>



	<div class="row container" align="center">
		<button class="btn btn-info" id="btn-retrieve-order">Retrieve Orders</button>
		<table align="center">
		<thead>
			<tr>
				<th>Order ID</th>
				<th>Name</th>
				<th>Units</th>
				<th>Unit Price</th>
				<th>Order Status</th>
			</tr>
		</thead>
		<tbody id="order_body">

		</tbody>
	</table>
	</div>
</body>
</html>
