<?php
include 'top.php';
?>


<div class="container">
	<strong><a href="list.php">음식점 리스트(ㄱ-ㅎ)</a></strong>
	<p><small><strong>확인된 음식점은 굵게 표시됩니다.</strong></small></p>

	<form method="get" action="<?=$_SERVER['SCRIPT_NAME']?>" onsubmit="return search_check();" name="list_search" class="form-inline">
      <input class="form-control col-6" type="search" name="search" placeholder="음식점명으로 검색" aria-label="Search" size="20">
      <button class="btn btn-outline" type="submit">검색</button>
    </form>

	<br/>

	<ul class="list-group list-group-flush">
		<?=list_view()?>
	</ul>

	
</div>

<script>
function search_check() {
  var form = document.list_search;

  //검색어
  if(form.search.value == "") {
      form.search.focus();
      return false;
    }

}
</script>



<?php
include 'footer.php';
?>