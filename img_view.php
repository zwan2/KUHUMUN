<?
include './function/function.php';

$query_img_select = "SELECT RES_TITLE, IMG_NAME, USER_IP, INPUT_TIME FROM IMG_REPORT ORDER BY IMG_ID DESC";

if($result = $db->query($query_img_select)) {
	while($row = $result->fetch_assoc()) {

		echo $row['RES_TITLE'];
		echo "<br/>";
		echo $row['USER_IP'];
		echo "<br/>";
		echo $row['INPUT_TIME'];
		echo "<br/>";
		?><img class="img-responsive" src="./img/menu/<?=$row['IMG_NAME']?>">;
		<?
	}
}
?>