<!DOCTYPE html>
<html>
<head>
	<title>hotel | Buses</title>
	<link rel="stylesheet" type="text/css" href="/hotel/assets/css/hotels.css">
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/common.php'); ?>
</head>
<body>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/nav.php'); ?>
	<div class="all-wrapper">
	<?php
		require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/connection.php');
		require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/functions.php');
		$city = $_GET['city'];
		$check_in = $_GET['from_date'];
		$check_out = $_GET['to_date'];
		$rooms = $_GET['rooms'];

		if($check_in>$check_out){
			echo "<p style='color:red;text-align:center;padding:64px 0px;text-transform:uppercase'>Check in and check out date and not proper check and try again</p>";
			exit;
		}
		if($check_in < date('Y-m-d')){
			echo "<p style='color:red;text-align:center;padding:64px 0px;text-transform:uppercase'>check in date is less than todays</p>";
			exit;
		}
		$sql = "SELECT h.*, hd.* FROM hotel h, hotel_details hd where h.location_id = (SELECT city_id from city where city_name='$city') AND h.hotel_id = hd.hotel_id AND vacant > '$rooms'";
		$result = select_query($sql);
	?>
		<div class="content">
			<?php while($data = $result->fetch_assoc()): ?>
			<div class="row">
				<div class="img-holder">
					<div class="img-card" style="background:url('/hotel/assets/img/background.jpg') center center no-repeat; background-size: cover;"></div>
				</div>
				<div class="details-holder">
					<div class="details-card">
						<h1><?php echo $data['name'] ?></h1>
						<p><span class="heading">Ammenties</span></br>
							<?php
								$things = ['wifi', 'gym', 'parking'];
								foreach ($data as $key => $value) {
									for($i = 0; $i<sizeof($things); $i++){
										if($things[$i] != $key)
											continue;
										$text = '';
										if($value == 0)
											$text = 'No';
										else if($value == 1)
											$text = 'Yes';
										echo $key." : ".$text."</br>";
									}
								}
							?>
						</p>
						<p style="text-align:center;padding-top:40px;"><span class="price">Rs.<?php echo $data['price']; ?> Per Night</span> <a href="/hotel/account/checkout.php?hotel_id=<?php echo $data['hotel_id']  ?>&check_in=<?php echo $check_in; ?>&check_out=<?php echo $check_out; ?>&rooms=<?php echo $rooms; ?>&amount=<?php echo $data['price']; ?>">Book now</a></p>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		</div>
	</div>
</body>
</html>