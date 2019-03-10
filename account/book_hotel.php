<?php
			
	if(!isset($_GET['amount']) || !isset($_GET['check_in'])|| !isset($_GET['check_out']) || !isset($_GET['hotel_id']) || !isset($_GET['rooms'])){
		print json_encode(array("type"=>"error", "text"=>"details are missing"));
		exit;
	}
	session_start();
	$amount = $_GET['amount'];
	$check_in = $_GET['check_in'];
	$check_out = $_GET['check_out'];
	$hotel_id = $_GET['hotel_id'];
	$rooms = $_GET['rooms'];
	$user_id = $_SESSION['user_id'];
	#split seats
	#check date

	#construction of sql command

	#establish connection
	require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/connection.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/functions.php");

	#verifying if seats are unoccupied
	#echo sizeof($seats);
	
	#get userId
	#verify if eniugh rooms are empty
	$result = select_query("SELECT * FROM hotel where hotel_id = '$hotel_id' AND vacant > '$rooms'");
	if(mysqli_num_rows($result)!= 1){
		print json_encode(array("type"=>"error", "text"=>"Not enough rooms vacant"));
		exit;
	}
	#echo $sql;

	//update bill with all new details
	$result = query("INSERT INTO reservation (customer_id, hotel_id, check_in, check_out, amount) values('$user_id', '$hotel_id', '$check_in', '$check_out', '$amount')");
	#echo mysqli_error($con);
	#get vacancies
	$result = select_query("SELECT vacant, occupied FROM hotel where hotel_id = '$hotel_id'");
	$data = $result->fetch_assoc();
	$vacancy = $data['vacant'];
	$occupied = $data['occupied'];
	$vacancy-=$rooms;
	$occupied+=$rooms;

	#update vacancies
	$result = query("UPDATE hotel set vacant = '$vacancy' , occupied = '$occupied' WHERE hotel_id = '$hotel_id' ");
	if($result){
		print json_encode(array("type"=>"success", "text"=>"Tickets booked", "link"=>"/hotel/account/booked.php"));
	}
	mysqli_close($con);

?>