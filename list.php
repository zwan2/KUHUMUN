<?php
include 'top.php';
?>


<div class="container">

	<p class="lead"><a href="list.php">음식점 리스트(ㄱ-ㅎ)</a></p>
	<form method="get" action="<?=$_SERVER['SCRIPT_NAME']?>" name="list_search" class="form-inline">
      <input class="form-control" type="search" name="search" placeholder="음식점명으로 검색" aria-label="Search" size="20">
      <button class="btn btn-outline" type="submit">검색</button>
    </form>

	<br/>

	<ul class="list-group list-group-flush">
		<?=list_view()?>
	</ul>

	
</div>

<?php
include 'footer.php';
?>