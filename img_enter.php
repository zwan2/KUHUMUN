<?php
include 'top.php';
?>

<div class="container">

	<span class="fs-13 text-gray-soft"><a href="enter.php">뒤로 가기</a></span>
	<h1 class="mb-1 text-center">메뉴 입력 (사진)</h1>
	<p class="fs-14 text-gray text-center mb-5">음식점명을 입력하고, 메뉴판 사진을 선택해주세요.<br/>관리자가 확인 후 최종으로 업로드합니다.</p>

 	<form method="post" action="img_submit.php" enctype="multipart/form-data" onsubmit="return enter_check();" name="info">
		<div class="input-group">
		  <input type="text" class="form-control" id="res_title" placeholder="음식점명" aria-label="음식점명" aria-describedby="basic-addon1" name="title" id="title" size="20">
		</div>
		<br/>

		<div class="col-sm-8 img-upload-section">
			<input name="image3" type="file" accept="image/*" id="menu_images" name="menu_images">
			<br/><br/>
			<img id="menu_image" class="preview_img">
		</div> 
			
		</br>
				
		<button class="btn btn-success btn-block" type="submit" onClick="return frmCheck();">입력</button>

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

document.getElementById("menu_images").onchange = function () {
    var reader = new FileReader();
    if(this.files[0].size>52838500){
        alert("Image Size should not be greater than 500Kb");
        $("#menu_image").attr("src","blank");
        $("#menu_image").hide();  
        $('#menu_images').wrap('<form>').closest('form').get(0).reset();
        $('#menu_images').unwrap();     
        return false;
    }
    if(this.files[0].type.indexOf("image")==-1){
        alert("Invalid Type");
        $("#menu_image").attr("src","blank");
        $("#menu_image").hide();  
        $('#menu_images').wrap('<form>').closest('form').get(0).reset();
        $('#menu_images').unwrap();         
        return false;
    }   
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("menu_image").src = e.target.result;
        $("#menu_image").show(); 
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};


</script>

<?php
include 'footer.php';
?>