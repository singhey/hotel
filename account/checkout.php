<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/common.php'); ?>
	<link rel="stylesheet" type="text/css" href="/hotel/assets/css/checkout.css">
	<script type="text/javascript" src="/hotel/assets/js/checkout.js"></script>
</head>
<body>
	<?php
		if(!isset($_SESSION['username']))header('Location: /hotel/account/login.php?error=1'); 
	?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/nav.php'); ?>
	<?php
		#establish connection
		require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/connection.php");
		#check if all variables are recieved
		require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/functions.php");
	?>
	<div class="all-wrapper">
		<form class="checkout" id="complete-purchase" method="GET" action="/hotel/account/book_hotel.php">
		    <div class="checkout-header">
		      <h1 class="checkout-title">
		        Checkout
		        <span class="checkout-price"><?php
		    	$diff = date_diff(date_create($_GET['check_out']), date_create($_GET['check_in']));
				$total_amount = $diff->format("%a") * $_GET['amount'];
		        echo $total_amount; 
		        ?></span>
		      </h1>
		    </div>
		    <p>
		      <input type="text" class="checkout-input checkout-name" placeholder="Name" autofocus>
		      <input type="text" class="checkout-input checkout-exp" placeholder="MM">
		      <input type="text" class="checkout-input checkout-exp" placeholder="YY" >
		    	<input type="text" id="date"  style="display:none" name='check_in'
		    		<?php
		    			echo "value='".$_GET['check_in']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="check_out"
		    		<?php
		    			echo "value='".$_GET['check_out']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="hotel_id"
		    		<?php
		    			echo "value='".$_GET['hotel_id']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="rooms"
		    		<?php
		    			echo "value='".$_GET['rooms']."'";
		    		?>
		    	/>
		    	<input type="text" id="amount" style="display:none" name="amount"
		    		<?php

		    			echo "value='$total_amount'";
		    		?>
		    	/>
		    </p>
		    <p>
		      <input type="text" class="checkout-input checkout-card" placeholder="4111 1111 1111 1111">
		      <input type="text" class="checkout-input checkout-cvc" placeholder="CVC">
		    </p>
		    <p>
		      <input type="submit" value="Purchase" class="checkout-btn">
		    </p>
		  </form>
	</div>
</body>
</html>