<html>
	<head>
		<script src="http://code.jquery.com/jquery-1.6.4.js"></script>
	</head>
	<body>
		<script type="text/javascript">
			$.ajaxSetup({
				url : "service.php/producers/",
				type : "get",
		
			    //data: {'Name': '', 'Address': '', 'Postalcode': 9999, 'City': '', 'Id': 500, 'Site': '', 'Image': 'image/png', 'Latitude': 0.235, 'Longitude': 0.421},
				//data: {'Name': 'Frida', 'Address': 'HEKEIO', 'Postalcode': '57232', 'City': 'Kalmar', 'Id': 100, 'Site': 'www.asdfg.se', 'Image': 'image/png', 'Latitude': 15.235, 'Longitude': 1.453 },
				//GET data: { 'ProducerID' : 4 },
				headers : {
					"Accept" : "application/json",
					"Content-type" : "application/x-www-form-urlencoded"
				}
			});

			$.ajax({
				success : function(data) {
					console.log(data);
				},
				error : function(object, error) {
					console.log(error);
				}
			});
		</script>
	</body>
</html>