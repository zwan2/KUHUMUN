<?php
include './function/function.php';

$res_id = $_GET['res_id'];
$detail_id = $_GET['detail_id'];
$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d H:m:s");


$query_block_select = "SELECT count(*) FROM BLOCK_LIST WHERE USER_IP = '$user_ip'";

if($result = $db->query($query_block_select)) {
	if($row = $result->fetch_array()) {
		//차단된 유저
		if($row[0] == 1) {
			echo"<script>alert('기능을 사용할 수 없습니다.'); window.history.back(); </script>";	
		} 
		
		//정상 유저
		else {

			$query_report_insert = "INSERT INTO REPORT (RES_ID, DETAIL_ID, USER_IP, INPUT_TIME) VALUES ('$res_id', '$detail_id', '$user_ip', '$input_time')";

			if($result = $db->query($query_report_insert)) {
				//음식점 신고
				if($detail_id == 0) {
					$query_res_update = "UPDATE RESTAURANT SET REPORT_COUNT = REPORT_COUNT + 1 WHERE RES_ID = '$res_id'";
					
					if($result = $db->query($query_res_update)) {
						echo"<script>alert('신고가 접수되었습니다. 잘못된 정보는 관리자의 확인 후 수정됩니다.'); location.href='detail.php?res_id=$res_id'; </script>";		
					}
				} 
				//메뉴 신고
				else {
					$query_detail_update = "UPDATE RES_DETAIL SET REPORT_COUNT = REPORT_COUNT + 1 WHERE DETAIL_ID = '$detail_id'";
				
					if($result = $db->query($query_detail_update)) {
						echo"<script>alert('신고가 접수되었습니다. 잘못된 정보는 관리자의 확인 후 수정됩니다.'); location.href='detail.php?res_id=$res_id'; </script>";		
					}
				}
			} 
		}
	}
	
}


?>