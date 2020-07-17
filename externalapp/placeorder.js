$(document).ready(function() {

	$('#btn-place-order').click((event) => {

		event.preventDefault();

		var name_of_food = $('#name_of_food').val();
		var number_of_units = $('#number_of_units').val();
		var unit_price = $('#unit_price').val();
		var order_status = $('#order_status').val();

		$.ajax({

			url: "../api/v1/orders/index.php",
			type: 'post',
			data: {name_of_food:name_of_food, number_of_units:number_of_units,unit_price:unit_price,order_status:order_status},
			headers: {'Authorization':'AcW54VxZON0k289Bc1WHGX1y46wz4j1kI6SDUI7C5NxZBZ1XkgECDqqarebEswKa'},
			success: (data) => {
				// console.log('Data incoming: ')
				// console.log(data);
				alert(data['message']);
			},
			error: (error) => {
				// console.log(error);
				alert("An error occured: " + error);
			}

		});

	});

	$('#btn-check-order').click((event) => {

		event.preventDefault();

		var order_id = $('#order_id').val();

		$.ajax({

			url: "../api/v1/orders/index.php?order_id="+order_id,
			type: 'get',
			data: {order_id:order_id},
			headers: {'Authorization':'AcW54VxZON0k289Bc1WHGX1y46wz4j1kI6SDUI7C5NxZBZ1XkgECDqqarebEswKa'},
			success: (data) => {
				// console.log('Data incoming: ')
				// console.log(data);
				alert(data['message']);
			},
			error: (error) => {
				// console.log(error);
				alert("An error occured: " + error);
			}

		});

	});

	$('#btn-retrieve-order').click((event) => {

		$.ajax({

			url: "../api/v1/orders/index.php?retrieve_orders",
			type: 'get',
			headers: {'Authorization':'AcW54VxZON0k289Bc1WHGX1y46wz4j1kI6SDUI7C5NxZBZ1XkgECDqqarebEswKa'},
			success: (data) => {
				// console.log('Data incoming: ')
				// console.log(data);

				var html = '';
				for (var i = 0; i <= data.length - 1; i++) {
					var id = data[i]['id'];
					var name = data[i]['name'];
					var units = data[i]['units'];
					var price = data[i]['price'];
					var status = data[i]['status'];

					html += "<tr><td>"+id+"</td><td>"+name+"</td><td>"+units+"</td><td>"+price+"</td><td>"+status+"</td></tr>"
				}

					$('#order_body').html(html)
			},
			error: (error) => {
				console.log(error);
				// alert("An error occured: " + error);
			}

		});

	});

});
