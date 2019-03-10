<?php
	session_start();
	#establish connection
	require_once($_SERVER['DOCUMENT_ROOT']."/hotel/assets/required/connection.php");
	/*$data = $_POST;
	foreach ($data as $key => $value) {
		echo "$".$key.' = $_POST[\''.$key."'];</br>";
	}*/
	$userId = $_SESSION['user_id'];
	$userName = $_POST['username'];
	$sql = "SELECT username from customer where username = '$userName' and user_id != '$userId'";
	echo $userId;
	echo $sql;
	$result = mysqli_query($con, $sql);
	if(!$result){
		echo mysqli_error($con);
		exit;
	}
	if(mysqli_num_rows($result) == 1){
		header("Location:/hotel/account/manage.php?code=1");
		exit;
	}
	$data = $_POST;
	$i = 0;
	$conditions = "";
	foreach ($data as $key => $value) {
		if($key == 'user_id'){
			continue;
		}
		if($i == 0){
			$conditions.="$key = '$value'";
		}else{
			$conditions.=", $key = '$value' ";
		}
		$i++;
	}
	$sql = "UPDATE `customer` SET $conditions WHERE user_id = '$userId' ";
	echo $sql;
	$result = mysqli_query($con, $sql);
	if(!$result){
		header("Location:/hotel/account/manage.php?code=2");
	}
	$_SESSION['username'] = $userName;
	header("Location:/hotel/account/manage.php?code=3");
	echo mysqli_error($con);
?>