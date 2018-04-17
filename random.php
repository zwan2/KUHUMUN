<?php
include './function/function.php';

$query_res_select = "SELECT RES_ID FROM RESTAURANT ORDER BY rand() LIMIT 1";

if($result = $db->query($query_res_select)) {
	if($row = $result->fetch_assoc()) {
		echo"<script>location.href='detail.php?res_id=$row[RES_ID]';</script>";

	}
}


?>