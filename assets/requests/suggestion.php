<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/functions.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/hotel/assets/required/connection.php');

	$q =  $_GET['q'];
	$row = array();
	$result = select_query("SELECT city_name as city from city where city_name LIKE '%$q%'");
	while($r = $result->fetch_assoc()){
		$row[] = $r;
	}
	echo json_encode($row);
?>