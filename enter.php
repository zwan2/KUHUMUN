<?php
include 'top.php';
?>

<div class="container">
	
	<h1 class="mb-1 text-center">정보 입력</h1>
	<p class="fs-14 text-gray text-center mb-5">입력할 정보를 선택하세요.</p>
	

	<button type="button" class="btn btn-outline-dark btn-lg btn-block" onclick="window.location.href='img_enter2.php'"><span class="badge badge-primary">NEW</span> 음식 사진 입력</button>
	<button type="button" class="btn btn-dark btn-lg btn-block" onclick="window.location.href='img_enter.php'">메뉴 입력 (사진)</button>
	<button type="button" class="btn btn-dark btn-lg btn-block" onclick="window.location.href='manual_enter.php'">메뉴 입력 (직접)</button>



</div>


<?php
include 'footer.php';
?>