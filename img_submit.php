<?php
include './function/function.php';

$res_title = $_POST['title'];
$res_menu = NULL;
if(isset($_POST['menu'])) {
	$res_menu = $_POST['menu'];
}

$img_name = $_FILES["image3"]["name"];

$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d H:i:s");



//업로드한 파일을 저장할 디렉토리

$save_dir = $_SERVER['DOCUMENT_ROOT']."/img/report/";
//echo $save_dir;

//파일이 HTTP POST 방식을 통해 정상적으로 업로드되었는지 확인한다.
if(is_uploaded_file($_FILES["image3"]["tmp_name"])) {
   
   //파일을 저장할 디렉토리 및 파일명
   $dest = $save_dir . $_FILES["image3"]["name"];
   
   //파일을 지정한 디렉토리에 저장
   if(!move_uploaded_file($_FILES["image3"]["tmp_name"], $dest)) {
  
   } //저장 성공
  	else {
  		//echo $res_title;
  		//echo $img_name;
  		//echo $user_ip;
  		//echo $input_time;
  		$query_img_insert = "INSERT INTO IMG_REPORT(RES_TITLE, RES_MENU, IMG_NAME, USER_IP, INPUT_TIME) VALUES('$res_title', '$res_menu', '$img_name', '$user_ip', '$input_time')";

		if($result = $db->query($query_img_insert)) {   
   			echo"<script>location.href='complete.php';</script>";	
   		} else {
   			echo"<script>alert('error');</script>";
   		}
   	}

}





?>