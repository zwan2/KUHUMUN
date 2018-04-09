<?php
include 'top.php';
?>

<div class="container">

	<span class="fs-13 text-gray-soft"><a href="img_enter.php">이미지로 입력</a></span>
	
	<h1 class="mb-1 text-center">정보 입력</h1>
	<p class="fs-14 text-gray text-center mb-5">음식점명, 메뉴, 가격을 아는대로 입력해주세요.<br/>이미 등록된 음식점에도 정보를 더 입력할 수 있습니다.</p>
	
	<form method="post" action="submit.php" onsubmit="return enter_check();" name="info">
		<table id="res_table" class="table">
			<tbody>
				<tr>
					<div class="input-group">
					  <input type="text" class="form-control" id="res_title" placeholder="음식점명" aria-label="음식점명" aria-describedby="basic-addon1" name="title" id="title" size="20">
					</div>
				</tr>
				<br/>
				
				<tr>
					<td> <input type="text" class="form-control" placeholder="메뉴" name="menu[]" size="15">  </td>
					<td> <input type="number" class="form-control" placeholder="가격" name="price[]" min=100 max="100000">  </td>
					<td>　</td>
				</tr>
			</tbody>
		</table>
		<blockquote class="blockquote text-center">
		  <button type="button" class="btn btn-outline-dark" onClick="insRow()">추가</button>
		</blockquote>
		
	</br>
				
		<button class="btn btn-dark btn-block" type="submit" onClick="return frmCheck();">입력</button>

	</form>







</div>


<script type="text/javascript">
function enter_check(){
	var form = document.info;
	form.title.value.replace(/ /gi, "");

	//음식점명 입력했는지 검사
	if(form.title.value=="") {
		alert("음식점명을 입력하세요");
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
function frmCheck(){
	//나머지 입력했는지 검사
	var form = document.info;
	for(var i = 0; i <= form.elements.length - 1; i++) {
		if(form.elements[i].name == "menu[]" || form.elements[i].name == "price[]") {
			if(!form.elements[i].value) {
		        alert("값을 모두 입력하세요!");
		        form.elements[i].focus();
		 		return false;
		    }     
		}
	}
}
</script>

<?php
include 'footer.php';
?>