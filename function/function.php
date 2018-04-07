<script language="javascript">

	var rowItem = "<tr>"
rowItem += "<td> <input type='text' class='form-control' placeholder='메뉴' name='menu[]' size='15'> </td>"
rowItem += "<td> <input type='number' class='form-control' placeholder='가격' name='price[]' min='1000' max='100000'>  </td>"

rowItem += "<td><button id='remove_button' type='button' class='close' aria-label='Close' onClick='removeRow()'><span aria-hidden='true'>&times;</span></button></td>"
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

$db = mysqli_connect("13.124.94.126", "root", "06911004", "KUHUMUN", "3306");

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
					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'>$row[RES_TITLE]</li></a>";
 				} else if ($row['PROVEN_CODE'] == 1) {
 					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'><p>$row[RES_TITLE]</p></li></a>";
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
		$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT ORDER BY  RES_TITLE ASC";
		if($result = $db->query($query_res_select)) {
			while($row = $result->fetch_assoc()) {
				if($row['PROVEN_CODE'] == 0) {
					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'>$row[RES_TITLE]</li></a>";
 				} else if ($row['PROVEN_CODE'] == 1) {
 					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'><strong>$row[RES_TITLE]</strong></li></a>";
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
			echo"<h2 class='page-title mb-0 mb-md-0'>$row[RES_TITLE]</h2>";

			echo"<a href='report.php?res_id=$res_id&detail_id=detail_id=0');' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\">신고하기</a>
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
				echo"<td><p>$row[RES_MENU]</p></td>";
				echo"<td>$row[RES_PRICE]</td>";
				echo"<td>$input_time</td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\"><span id='report_button' aria-hidden='true'>&times;</span><small id='report_button'>$row[REPORT_COUNT]</small></a></td>";			
				
				echo"</tr>";
			} 
			//증명됨
			else if ($row['PROVEN_CODE'] == 1) {
				echo"<tr>";
				echo"<td><p class='font-weight-bold'>$row[RES_MENU]</p></td>";
				echo"<td><p class='font-weight-bold'>$row[RES_PRICE]</p></td>";
				echo"<td>$input_time</td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\");'><span aria-hidden='true'>&times;</span></a></td>";			
				
				echo"</tr>";
			} else {
				echo"<script>alert('error: 01'); location.href='/';</script>";
			}
		}
	}
}

function detail_comment() {
	global $db;
	$res_id = $_GET['res_id'];
	$query_comment_select = "SELECT COMMENT FROM COMMENT WHERE RES_ID ='$res_id' ORDER BY COMMENT_ID DESC";

	if($result = $db->query($query_comment_select)) {
		while($row = $result->fetch_assoc()) {
			echo " <small class='font-weight-light'>$row[COMMENT]</small><br/>";

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