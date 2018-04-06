<?php
include 'top.php';
?>


<div class="container">
	<br/><br/>
	<div class="row">
	  <div class="col-4 col-md-5"></div>
	  	<div class="col-4 col-md-2">
	  		<div class="text-center">
			<img src="./img/main.svg" id="main_img">
			</div>
		</div><div class="col-4 col-md-5"></div>
	 
	</div>

	<blockquote class="blockquote text-center">
	<h1 class="display-1 text-bold">건대후문</h1></blockquote>

	<blockquote class="blockquote text-center">
		<h5 class="text-gray-soft text-regular"> 검색해도 잘 나오지 않는 후문 음식점 메뉴들.</br>여러분들이 직접 메뉴판을 만들어주세요.</h5>
		<button type="button" class="btn btn-dark" onclick="window.location.href='enter.php'">음식점 정보 입력하기</button>

		<button type="button" class="btn btn-outline-dark" onclick="window.location.href='list.php'">음식점 리스트</button>
	</blockquote>
	

	<br/>
	
</div>


<?php
include 'footer.php';
?>