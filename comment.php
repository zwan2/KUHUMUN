<?php
include './function/function.php';

$res_id = $_POST['res_id'];
$comment = $_POST['comment'];
$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d H:i:s");

$query_comment_insert = "INSERT INTO COMMENT (RES_ID, COMMENT, USER_IP, INPUT_TIME) VALUES ('$res_id', '$comment', '$user_ip', '$input_time')";


if($result = $db->query($query_comment_insert)) {
	echo "<script>alert('코멘트가 등록되었습니다.'); location.href='detail.php?res_id=$res_id/#c';</script>";	
} else {
	echo"<script>alert('error: 01'); window.history.back();</script>";
}

?>