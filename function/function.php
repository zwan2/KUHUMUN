<script language="javascript">

	var rowItem = "<tr>"
rowItem += "<td> <input type='text' class='form-control' placeholder='메뉴' name='menu[]' size='15'> </td>"
rowItem += "<td> <input type='number' class='form-control' placeholder='가격' name='price[]' min='1000' max='100000'>  </td>"

rowItem += "<td><button type='button' class='close' aria-label='Close' onClick='removeRow()'><span aria-hidden='true'>&times;</span></button></td>"
rowItem += "</tr>"
function insRow() {
	$('#res_table').append(rowItem)
	}

function removeRow() {
	$('#res_table').on("click", "button", function() {
	$(this).closest("tr").remove()
})};
</script>


<?

$db = mysqli_connect("localhost", "root", "autoset", "KUHUMUN", "3306");

if(!$db) {
	echo"DB NOT CONNECTED";
	mysqli_connect_error();
}


function list_view() {
	global $db;

	//검색값이 있을 경우
	if(isset($_GET['search'])) {

		$search = preg_replace("/\s+/", "", $_GET['search']);
		$search = "%".$search."%";
	
		$query_res_select = "SELECT RES_ID, RES_TITLE FROM RESTAURANT WHERE RES_TITLE LIKE '$search'";

		if($result = $db->query($query_res_select)) {
			if($row = $result->fetch_assoc()) {
				echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'>$row[RES_TITLE]</a></li>";
			} 
			//잘못된 주소
			else {
				echo"<script>window.history.back();</script>";
			}
		}
	} 
	//DEFAULT
	else {
		$query_res_select = "SELECT RES_ID, RES_TITLE FROM RESTAURANT ORDER BY RES_TITLE ASC";
		if($result = $db->query($query_res_select)) {
			while($row = $result->fetch_assoc()) {
				echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'>$row[RES_TITLE]</a></li>";
			}
		}
	}

}
function detail_res_title() {
	global $db;
	$res_id = $_GET['res_id'];


	$query_res_select = "SELECT RES_TITLE FROM RESTAURANT WHERE RES_ID = '$res_id'";
	if($result = $db->query($query_res_select)) {
		if($row = $result->fetch_assoc()) {
			echo"<h1 class='display-4'>$row[RES_TITLE]</h1>";
		} 
		//잘못된 주소
		else {
			echo"<script>window.history.back();</script>";
		}
	}
}



	

function detail_view() {
	global $db;
	$res_id = $_GET['res_id'];

	$query_detail_select = "SELECT DETAIL_ID, RES_MENU, RES_PRICE, INPUT_TIME FROM RES_DETAIL WHERE RES_ID = '$res_id' ORDER BY DETAIL_ID DESC";

	if($result = $db->query($query_detail_select)) {
		while($row = $result->fetch_assoc()) {
			
			$input_time = date("m.d",strtotime($row['INPUT_TIME']));
			echo"<tr>";
			echo"<td>$row[RES_MENU]</td>";
			echo"<td>$row[RES_PRICE]</td>";
			echo"<td>$input_time</td>";
			echo"
			<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');'><span aria-hidden='true' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\">&times;</span></a>
			</td>";			
			
			echo"</tr>";
		}
	}
}
?>