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
		<button type="button" class="btn btn-outline-dark" onclick="window.location.href='enter.php'">음식점 정보 입력하기</button>

		<button type="button" class="btn btn-dark" onclick="window.location.href='list.php'">음식점 리스트</button>
	</blockquote>
	
	<br/><hr/><br/>
	<div>
		<h1 class="bd-title" id="content">건대 후문은?</h1>
		<p class="bd-lead text-justify">건대후문은 건대생 집단지성 프로젝트입니다. 후문 음식점들은 300여개나 되지만, 인터넷 등록 미비, 가격 인상 등으로 정확한 정보를 알기 힘듭니다. 300여개의 음식점들을 혼자 조사하기란 어렵지만, 함께라면 가능합니다.</p>
		<br/>

		<h1 class="bd-title" id="content">중문은요?</h1>
		<p class="bd-lead text-justify">중문 음식점의 정보는 대부분의 지도 서비스에 등록되어 있기 때문에 입력하지 않으셔도 됩니다. 저희 프로젝트는 미등록된 후문 지역의 정보를 확실히 구축하고자 합니다.</p>
		<br/>

		<h1 class="bd-title" id="content">카페도 되나요?</h1>
		<p class="bd-lead text-justify">정보가 잘 나와있지 않는 카페라면 가능합니다.</p>
		<br/>

		<h1 class="bd-title" id="content">어디에 사용되나요?</h1>
		<p class="bd-lead text-justify">입력한 정보는 학생들과 정보를 나누기 위한 목적으로 사용됩니다. 많은 건대생들이 사용할 수 있도록 홍보 부탁들드립니다. :)</p>

	</div>

	<br/>
	
</div>


<?php
include 'footer.php';
?>