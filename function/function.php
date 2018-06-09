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
					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item' id='$row[RES_ID]'>$row[RES_TITLE]</li></a>";
	 				} else if ($row['PROVEN_CODE'] == 1) {
	 					echo"<a href='detail.php?res_id=$row[RES_ID]'><li class='list-group-item' id='$row[RES_ID]'><strong>$row[RES_TITLE]</strong></li></a>";
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

	echo "<a href='./' class='badge badge-pill badge-success type_search'>전체</a>";
	if($result = $db->query($query_type_select)) {
		while($row = $result->fetch_assoc()) {
			echo "<a href='./?type_search=$row[TYPE_ID]' class='badge badge-pill badge-success type_search' id='$row[TYPE_ID]'>$row[TYPE_NAME]</a>";
		}
	}

}

function detail_res_title() {
	global $db;
	$res_id = $_GET['res_id'];

	$query_res_select = "SELECT RES_TITLE, RES_SUBTITLE FROM RESTAURANT WHERE RES_ID = '$res_id'";
	if($result = $db->query($query_res_select)) {
		if($row = $result->fetch_assoc()) {
			echo"<h1 class='page-title mb-0 mb-md-0 text-center' id='res_title'>$row[RES_TITLE]</h1>";
			if($row['RES_SUBTITLE']) {
				echo"<footer class='blockquote-footer text-center'>$row[RES_SUBTITLE]</footer>";
			}
		}
		//잘못된 주소
		else {
			echo"<script>window.history.back();</script>";
		}
	}
}

function detail_res_report() {
	$res_id = $_GET['res_id'];
	echo"<a class='float-right' href='report.php?res_id=$res_id&detail_id=detail_id=0');' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\"><span class='fs-13 text-gray-soft'>신고하기</span></a>";
}


function detail_img() {
	global $db;

	if(isset($_GET['res_id'])) {

		$res_id = $_GET['res_id'];
		$query_img_select = "SELECT RES_MENU, IMG_NAME FROM RES_IMG WHERE RES_ID = '$res_id' ORDER BY RES_IMG_ID DESC";

		if($result = $db->query($query_img_select)) {
			$result_cnt = $result->num_rows;
			if($result_cnt > 0) {
				?>
				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
				<?
				for($i=0; $i<$result_cnt; $i++) {?>
					<li data-target="#carouselExampleControls" data-slide-to="<?=$i?>" class="<? if($cnt == 0) echo 'active' ?>"></li>
				<?
				}?>
				</ol>
				<div class="carousel-inner">
				<?

				$cnt = 0;
				while($row = $result->fetch_assoc()) {
					?>

					<div class="carousel-item <? if($cnt == 0) echo 'active' ?> ">
				      <img class="d-block carousel_img" src="./img/restaurant/<?=$row['IMG_NAME']?>" alt="img">

				      <div class="carousel-caption">
					  	<inline class="caption-block"><?=$row['RES_MENU']?>
				      </inline>
					  </div>
				    </div>
				    <?
				    $cnt++;
				}

				?>
				</div>
				  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>

				<?

			}


		}

		//no img
		else {
			return;
		}
	}
	//error
	else {
		echo"<script>alert('error: 01'); location.href='/';</script>";
	}

}


function detail_view() {
	global $db;
	$res_id = $_GET['res_id'];
	$row_count = 0;
	$check_code = -1;


	//new
	$query_detail_select = "SELECT RES_MENU, RES_MENU_CODE, RES_PRICE, INPUT_TIME, PROVEN_CODE FROM RES_DETAIL WHERE RES_ID = '$res_id' ORDER BY RES_MENU_CODE ASC, PROVEN_CODE DESC, RES_PRICE DESC, RES_MENU ASC";
	//$query_detail_select = "SELECT DETAIL_ID, RES_MENU, RES_MENU_CODE, RES_PRICE, INPUT_TIME, REPORT_COUNT, PROVEN_CODE FROM RES_DETAIL WHERE RES_ID = '$res_id' ORDER BY RES_MENU_CODE ASC, PROVEN_CODE DESC, RES_PRICE DESC, RES_MENU ASC";


	//SUBTITLE
	//RESTAURANT에서 SUBTITLES 배열로 추출
	$query_res_select = "SELECT RES_MENU_SUBTITLES FROM RESTAURANT WHERE RES_ID = '$res_id'";

	if($result = $db->query($query_res_select)) {
		if($row = $result->fetch_array()) {
			$subtitle_string = $row[0];
			$subtitle_array = explode(',' , $subtitle_string);
		}
	}


	//DETAIL TABLE 출력문
	if($result = $db->query($query_detail_select)) {
		while($row = $result->fetch_assoc()) {
			$input_time = date("m.d",strtotime($row['INPUT_TIME']));
			$res_price = number_format((int)$row['RES_PRICE']);


			//1. MENU SUBTITLE
			if($check_code < $row['RES_MENU_CODE']) {
				$res_menu_code = $row['RES_MENU_CODE'];

				//BLANK (맨윗줄만 예외처리)
				if($check_code != -1) {
					echo"<tr><td colspan = '4' class='menu_subtitle'>　</td></tr>";

				}

				//공백 (BLANK 버그) 예외처리
				//출력
				if($res_menu_code != 9) {
					echo"<tr class='bg-success'><td colspan = '4' class='menu_subtitle'><p class='text-white font-weight-bold'>$subtitle_array[$res_menu_code]</p></td></tr>";
				}
				//모든 음식이 9일 때 예외처리
				else if ($res_menu_code== 9 && $check_code!= -1) {
					echo"<tr><td colspan = '4' class='menu_subtitle'>　</td></tr>";
				}


				$check_code = $row['RES_MENU_CODE'];
				$row_count = 0;
			}


			//2-1. 증명X
			if($row['PROVEN_CODE'] == 0) {
				echo"<tr>";
				echo"<td><p>$row[RES_MENU]</p></td>";
				echo"<td>$res_price</td>";
				echo"<td>$input_time</td>";
				//echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]');' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\"><span id='report_button' aria-hidden='true'>&times;</span><small id='report_button'>$row[REPORT_COUNT]</small></a></td>";

				echo"</tr>";
			}
			//2-2. 증명됨
			else if ($row['PROVEN_CODE'] == 1) {
				echo"<tr>";
				echo"<td><p class='font-weight-bold'>$row[RES_MENU]</p></td>";
				echo"<td><p class='font-weight-bold'>$res_price</p></td>";
				echo"<td>$input_time</td>";
				//echo"<td><a href='report.php?res_id=$res_id&detail_id=$row[DETAIL_ID]' onclick=\"return confirm('잘못된 정보를 신고하시겠습니까?')\");'><span aria-hidden='true'>&times;</span></a></td>";

				echo"</tr>";
			} else {
				echo"<script>alert('error: 01'); location.href='/';</script>";
			}



			//공백처리
			$row_count++;
			if($row_count%10 == 0) {
				echo"<tr><td colspan = '4' class='menu_subtitle'>　</tr>";
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
//굳이?
function index_detail() {
	global $db;
	$query_schema_select = "SELECT UPDATE_TIME, TABLE_ROWS FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'RES_DETAIL';";

	if($result = $db->query($query_schema_select)) {
		$row = $result->fetch_array();
		echo $row[0];

	}

}
*/
?>
