<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	
	<link rel="stylesheet" type="text/css" href="/hotel/assets/css/index.css">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/common.php'); ?>
	<script type="text/javascript" src="/hotel/assets/js/suggestion.js"></script>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/nav.php'); ?>
	<div class="all-wrapper">
		<section class="search-holder">
			<form action="/hotel/pages/hotels.php" method="GET">				
				<ul class="_holder">
					<li><label>City</label><input type="text" name="city" placeholder="City" id="from" required><div id="from-parent" class="suggestion"></div></li>
					<li><label>Check in</label><input type="date" name="from_date" required></li>
					<li><label>Check out</label><input type="date" name="to_date" required></li>
					<li><label>Rooms</label><input type="number" name="rooms" placeholder="Rooms" required></li>
					<li><label>&nbsp;</label><input type="submit" value="Search"></li>
				</ul>
			</form>
		</section>
	</div>
</body>
</html>