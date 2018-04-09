<?php
include './function/function.php';

$res_title = $_POST['title'];
$img_name = $_FILES["image3"]["name"];
//$imgaaa=$_FILES["image3"]["type"];
$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d H:i:s");



//업로드한 파일을 저장할 디렉토리

$save_dir = $_SERVER['DOCUMENT_ROOT']."/img/menu/";
echo $save_dir;

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
  		$query_img_insert = "INSERT INTO IMG_REPORT(RES_TITLE, IMG_NAME, USER_IP, INPUT_TIME) VALUES('$res_title', '$img_name', '$user_ip', '$input_time')";

		if($result = $db->query($query_img_insert)) {   
   			echo"<script>location.href='complete.php';</script>";	
   		} else {
   			echo"<script>alert('error');</script>";
   		}
   	}

}








//echo $_POST['title'];
//echo $_FILES['image3']['name'];

/*
//공백 제거
$title = preg_replace("/\s+/", "", $_POST['title']);



$user_ip = (string)$_SERVER['REMOTE_ADDR'];
$input_time = date("y-m-d");

$query_block_select = "SELECT count(*) FROM BLOCK_LIST WHERE USER_IP = '$user_ip'";

if($result = $db->query($query_block_select)) {
	if($row = $result->fetch_array()) {
		//차단된 유저
		if($row[0] == 1) {
			echo"<script>alert('기능을 사용할 수 없습니다.'); window.history.back(); </script>";
		}
		else {
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

		}
	}
}



*/
?>