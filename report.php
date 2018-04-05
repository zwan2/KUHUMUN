<?php
include './function/function.php';

$res_id = $_GET['res_id'];
$detail_id = $_GET['detail_id'];
$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d H:m:s");

$query_report_insert = "INSERT INTO REPORT (RES_ID, DETAIL_ID, USER_IP, INPUT_TIME) VALUES ('$res_id', '$detail_id', '$user_ip', '$input_time')";


if($result = $db->query($query_report_insert)) {
	
	echo"<script>alert('신고가 접수되었습니다. 잘못된 정보는 관리자의 확인 후 수정됩니다.'); window.history.back();</script>";

} else {
	echo"<script>alert('error: 01'); window.history.back();</script>";
}
?>