<!DOCTYPE html>
<html>
<head>
	<title>Bus Booking</title>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/common.php'); ?>
</head>
<body>
	<?php
		if(!isset($_SESSION['username']))header('Location: /hotel/account/login.php?error=2'); 
	?>
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/nav.php'); ?>
	<?php
		#establish connection
		require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/connection.php");
        require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/functions.php");
		#check if all variables are recieved
	?>
	<link rel="stylesheet" type="text/css" href="/hotel/assets/css/tickets.css">
	<div class="all-wrapper">
		<section>
  <!--for demo wrap-->
			<h1>Booked ticket List</h1>
			<div class="tbl-header">
    			<table cellpadding="0" cellspacing="0" border="0">
    				<thead>
        				<tr>
                            <th>Sl No.</th>
							<th>Hotel Name</th>
							<th>Check In</th>
							<th>Check out</th>
                            <th>City</th>
							<th>Pice</th>
        				</tr>
					</thead>
				</table>
  			</div>
			<div class="tbl-content">
 		   		<table cellpadding="0" cellspacing="0" border="0">
    				<tbody>
    					<?php
    						$userId = $_SESSION['user_id'];
    						$sql = "SELECT * from reservation where customer_id = '$userId' order by reservation_id desc";
    						#echo $sql;
    						$result = select_query($sql);
    						$i = 1;
    						while($r = $result->fetch_assoc()):
    					?>
    					<tr>
    						<?php
    							#get screen location and no
    							$hotel_id= $r['hotel_id'];
    							$sql = "SELECT h.*, hd.* FROM hotel h, hotel_details hd where
    									h.hotel_id = hd.hotel_id AND
    									h.hotel_id =  '$hotel_id'
    									";
    							#echo $sql;
    							$bus_result = mysqli_query($con, $sql);
    							if(!$bus_result)
    								echo mysqli_error($con)."Error ocuured </br>";
    							$t = $bus_result->fetch_assoc();
                                $location = $t['location_id'];
                                $_l = select_query("SELECT city_name from city where city_id = '$location'");
                                $_d = $_l->fetch_assoc();
                                $location = $_d['city_name'];
    						?>
		       				<td><?php echo $i++;; ?></td>
	    	    			<td><?php echo $t['name']; ?></td>
	    	    			<td><?php echo $r['check_in']; ?></td>
	        				<td><?php echo $r['check_out']; ?></td>
                            <td><?php echo $location; ?></td>
	        				<td><?php echo $r['amount']; ?></td>
	        				<!--  -->
        				</tr>
        				<?php
        					endwhile;
        				?>
   	 				</tbody>
    			</table>
			</div>
		</section>
	</div>
</body>
</html>