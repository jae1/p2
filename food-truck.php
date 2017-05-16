<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta Tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="A PHP application that allows users to select items from a menu as if they are ordering from a food truck." />

	<!-- Title -->
	<title>P2: Food Truck | ITC250</title>

	<!-- CSS -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
	<style>
		body {
			font-family: 'Roboto', sans-serif;
		}
		
		h2,h3,h4,h5,h6 {
			font-weight: 400;
		}

		#content {
			border: 1px solid #e7e7e7;
			max-width: 960px;
			margin: 0 auto;
			padding: 10px;
		}
	</style>
</head>
<body>
	<div id="content">
		<?php include 'order.php'; ?>
	</div>
</body>
</html>
