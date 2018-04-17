<script language="javascript">

	var rowItem = "<tr>"
rowItem += "<td> <input type='text' class='form-control' placeholder='메뉴' name='menu[]' size='15'> </td>"
rowItem += "<td> <input type='number' class='form-control' placeholder='가격' name='price[]' min='100' max='100000'>  </td>"

rowItem += "<td><button id='remove_button' type='button' class='close' aria-label='Close' onClick='removeRow()'><span aria-hidden='true'>&times;</span></button></td>"
rowItem += "</tr>"
function insRow() {
	$('#res_table').append(rowItem)
	}

function removeRow() {
	$('#res_table').on("click", "button", function() {
	$(this).closest("tr").remove()
})};
function frmCheck() {
  var frm = document.form;
  
  for(var i = 0; i <= frm.elements.length - 1; i++) {
	if(frm.elements[i].name == "addText") {
		if(!frm.elements[i].value) {
            alert("값을 모두 입력하세요!");
            frm.elements[i].focus();
	 		return;
        }     
	}
   }
 }	
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
	
		$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT WHERE RES_TITLE LIKE '$search' ORDER BY RES_TITLE ASC";

		if($result = $db->query($query_res_select)) {
			if($row = $result->fetch_assoc()) {
				
				if($row['PROVEN_CODE'] == 0) {
					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'>$row[RES_TITLE]</li></a>";
 				} else if ($row['PROVEN_CODE'] == 1) {
 					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item'><strong>$row[RES_TITLE]</strong></li></a>";
 				}

			} 
			//잘못된 주소
			else {
				echo"<li class='list-group-item'><p>결과가 없습니다.</p></li>";
			}
		}
	} 

	//TYPE으로 검색
	else if(isset($_GET['type_search'])) {
		$type_id = $_GET['type_search'];
		$query_type_select = "SELECT RES_STRING FROM RES_TYPE WHERE TYPE_ID = '$type_id'";
		if($result = $db->query($query_type_select)) {
			if($row = $result->fetch_array()) {
				$res_string = $row[0];
				$res_array = explode(',' , $res_string);
			}
		}

		$arr_cnt = count($res_array);

		for($i=0; $i<$arr_cnt; $i++) {
			$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT WHERE RES_ID = '$res_array[$i]' ORDER BY RES_TITLE ASC";

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

	//DEFAULT
	else {
		$query_res_select = "SELECT RES_ID, RES_TITLE, PROVEN_CODE FROM RESTAURANT ORDER BY RES_TITLE ASC";
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

function list_view_type() {
	global $db;

	$query_type_select = "SELECT TYPE_ID, TYPE_NAME FROM RES_TYPE";

	echo "<a href='list.php' class='badge badge-pill badge-dark type_search'>전체</a>";
	if($result = $db->query($query_type_select)) {
		while($row = $result->fetch_assoc()) {
			echo "<a href='list.php?type_search=$row[TYPE_ID]' class='badge badge-pill badge-dark type_search'>$row[TYPE_NAME]</a>";
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
	$row_count = 0;

	$query_detail_select = "SELECT DETAIL_ID, RES_MENU, RES_PRICE, INPUT_TIME, REPORT_COUNT, PROVEN_CODE FROM RES_DETAIL WHERE RES_ID = '$res_id' ORDER BY PROVEN_CODE DESC, RES_PRICE DESC, RES_MENU ASC, REPORT_COUNT ASC, DETAIL_ID DESC";


	if($result = $db->query($query_detail_select)) {
		while($row = $result->fetch_assoc()) {
			$input_time = date("m.d",strtotime($row['INPUT_TIME']));
			$res_price = number_format((int)$row['RES_PRICE']);
			
			//증명X
			if($row['PROVEN_CODE'] == 0) {
				echo"<tr>";
				echo"<td><p>$row[RES_MENU]</p></td>";
				echo"<td>$res_price</td>";
				echo"<td>$input_time</td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\"><span id='report_button' aria-hidden='true'>&times;</span><small id='report_button'>$row[REPORT_COUNT]</small></a></td>";			
				
				echo"</tr>";
			} 
			//증명됨
			else if ($row['PROVEN_CODE'] == 1) {
				echo"<tr>";
				echo"<td><p class='font-weight-bold'>$row[RES_MENU]</p></td>";
				echo"<td><p class='font-weight-bold'>$res_price</p></td>";
				echo"<td>$input_time</td>";
				echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\");'><span aria-hidden='true'>&times;</span></a></td>";			
				
				echo"</tr>";
			} else {
				echo"<script>alert('error: 01'); location.href='/';</script>";
			}

			//공백
			$row_count++;
			if($row_count%8 == 0) {
				echo"<tr><td>　</td><td>　</td><td>　</td><td>　</td></tr>";
			}
		}
	}
}

function detail_comment() {
	global $db;
	$res_id = $_GET['res_id'];
	$query_comment_select = "SELECT COMMENT, INPUT_TIME FROM COMMENT WHERE RES_ID ='$res_id' ORDER BY COMMENT_ID DESC";

	if($result = $db->query($query_comment_select)) {
		while($row = $result->fetch_assoc()) {
			$input_time = substr($row['INPUT_TIME'],5,11);
			echo " <small class='font-weight-light'>$row[COMMENT]</small>";
			echo "<small class='comment_time'> $input_time</small><br/>";

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