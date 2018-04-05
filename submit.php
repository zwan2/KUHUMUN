<?php
include './function/function.php';

//공백 제거
$title = preg_replace("/\s+/", "", $_POST['title']);
$menu = preg_replace("/\s+/", "", $_POST['menu']);
$price = $_POST['price'];



$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d");


$query_detail_select = "SELECT RES_ID FROM RESTAURANT WHERE RES_TITLE = '$title'";
// 음식점명 이미 있음
if($result = $db->query($query_detail_select)) {
	$row = $result->fetch_assoc();
	if($row) {
		$res_id = $row['RES_ID'];

		for($i=0;$i<count($menu);$i++) {
			$res_menu = $menu[$i];
			$res_price = $price[$i];

			
			$query_detail_insert = "INSERT INTO RES_DETAIL(RES_ID, RES_MENU, RES_PRICE, USER_IP, INPUT_TIME) VALUES ('$res_id', '$res_menu', '$res_price', '$user_ip', '$input_time')";
			if($result = $db->query($query_detail_insert)) {
				
				echo "<script>location.href='complete.php';</script>";
			} else {
				echo"<script>alert('error: 01'); location.href='enter.php';</script>";
			}


		}
	}
	//음식점명 없음
	else {
		$query_res_insert = "INSERT INTO RESTAURANT(RES_TITLE) VALUES ('$title')";

		if($result = $db->query($query_res_insert)) {
			//LAST_INSERTED_ID
			$res_id = $db->insert_id;

			for($i=0;$i<count($menu);$i++) {
				$res_menu = $menu[$i];
				$res_price = $price[$i];
				$query_detail_insert = "INSERT INTO RES_DETAIL(RES_ID, RES_MENU, RES_PRICE, USER_IP, INPUT_TIME) VALUES ('$res_id', '$res_menu', '$res_price', '$user_ip', '$input_time')";
				
				if($result = $db->query($query_detail_insert)) {
				echo "<script>location.href='complete.php';</script>";
				} else {
					echo"<script>alert('error: 02'); location.href='enter.php';</script>";
				}

			}


		} else {
			echo"<script>alert('error: 03'); location.href='enter.php';</script>";
		}
	}


} 



?>