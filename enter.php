<?php
include 'top.php';
?>

<div class="container">


	<p class="lead">음식점 정보 입력하기</p>
	<br/>
	
	<form method="post" action="submit.php" onsubmit="return enter_check();" name="info">
		<table id="res_table" class="table">
			<tbody>
				<tr>
					<div class="input-group">
					  <input type="text" class="form-control" placeholder="음식점명" aria-label="음식점명" aria-describedby="basic-addon1" name="title" id="title" size="20">
					</div>
				</tr>
				<br/>
				<tr>
					<button type="button" class="btn btn-outline-dark" onClick="insRow()">추가</button>
				</tr>
				<br/><br/>
				<tr>
					<td> <input type="text" class="form-control" placeholder="메뉴" name="menu[]" size="15">  </td>
					<td> <input type="number" class="form-control" placeholder="가격" name="price[]" min=1000 max="100000">  </td>
					<td>　</td>
				</tr>
			</tbody>
		</table>

		<button class="btn btn-default btn-lg btn-block" type="submit">입력</button>

	</form>







</div>


<script type="text/javascript">
function enter_check(){
	var form = document.info;
	form.title.value.replace(/ /gi, "");
	//전부 입력했는지 검사
	if(form.title.value=="") {
		alert("음식점명을 입력하세요");
		return false;
	} 



	if(form.menu.value=="" || form.price.value=="") {
		alert("음식점 정보를 모두 입력하세요");
		return false;
	}

	
	$("#title").bind("keyup",function(){
	 re = /[~!@\#$%^&*\()\-=+_']/gi; 
	 var temp=$("#title").val();
	 if(re.test(temp)){ //특수문자가 포함되면 삭제하여 값으로 다시셋팅
	 $("#title").val(temp.replace(re,"")); 
	} 

	});


	
}
</script>

<?php
include 'footer.php';
?>