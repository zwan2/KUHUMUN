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
	
		$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT WHERE RES_TITLE LIKE '$search' ORDER BY PROVEN_CODE DESC, REPORT_COUNT ASC, RES_TITLE ASC";

		if($result = $db->query($query_res_select)) {
			if($row = $result->fetch_assoc()) {
				
				if($row['PROVEN_CODE'] == 0) {
					echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'>$row[RES_TITLE]</a></li>";
 				} else if ($row['PROVEN_CODE'] == 1) {
 					echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'><p>$row[RES_TITLE]</p></a></li>";
 				}

			} 
			//잘못된 주소
			else {
				echo"<script>window.history.back();</script>";
			}
		}
	} 
	//DEFAULT
	else {
		$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT ORDER BY PROVEN_CODE DESC, REPORT_COUNT ASC, RES_TITLE ASC";
		if($result = $db->query($query_res_select)) {
			while($row = $result->fetch_assoc()) {
				if($row['PROVEN_CODE'] == 0) {
					echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'>$row[RES_TITLE]</a></li>";
 				} else if ($row['PROVEN_CODE'] == 1) {
 					echo"<li class='list-group-item'><a href='detail.php?res_id=$row[RES_ID]'><strong>$row[RES_TITLE]</strong></a></li>";
 				}
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
			echo"<h2 class='page-title mb-2 mb-md-0'>$row[RES_TITLE]</h2>";
			
			echo"<td><a href='report.php?res_id=$res_id&detail_id=detail_id=0');'><p onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\">신고하기</p></a>
			</td>";
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

	$query_detail_select = "SELECT DETAIL_ID, RES_MENU, RES_PRICE, INPUT_TIME, REPORT_COUNT, PROVEN_CODE FROM RES_DETAIL WHERE RES_ID = '$res_id' ORDER BY PROVEN_CODE DESC, REPORT_COUNT ASC, DETAIL_ID DESC";

	if($result = $db->query($query_detail_select)) {
		while($row = $result->fetch_assoc()) {
			$input_time = date("m.d",strtotime($row['INPUT_TIME']));

			//증명X
			if($row['PROVEN_CODE'] == 0) {
				echo"<tr>";
				echo"<td>$row[RES_MENU]</td>";
				echo"<td>$row[RES_PRICE]</td>";
				echo"<td>$input_time</td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');'><span aria-hidden='true' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\">&times;</span></a> <small>$row[REPORT_COUNT]</small></td>";			
				
				echo"</tr>";
			} 
			//증명됨
			else if ($row['PROVEN_CODE'] == 1) {
				echo"<tr>";
				echo"<td><strong>$row[RES_MENU]</strong></td>";
				echo"<td><strong>$row[RES_PRICE]</strong></td>";
				echo"<td><strong>$input_time</strog></td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');'><span aria-hidden='true' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\">&times;</span></a></td>";			
				
				echo"</tr>";
			} else {
				echo"<script>alert('error: 01'); location.href='index.php';</script>";
			}
		}
	}
}
/*
function index_detail() {
	global $db;
	$query_schema_select = "SELECT TABLE_ROWS FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'RESTAURANT';";

	if($result = $db->query($query_schema_select)) {	
		$row = $result->fetch_assoc();
		echo $row[1];
	}

}
*/
?>