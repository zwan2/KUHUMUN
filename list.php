<?php
include 'top.php';
?>


<div class="container">
  <blockquote class="blockquote text-center">
  
    <p class="lead"><a href="list.php">음식점 리스트(ㄱ-ㅎ)</a></p>
    <p class="font-weight-bold">확실한 정보는 굵게 표시됩니다.</p>
  </blockquote>
	<form method="get" action="<?=$_SERVER['SCRIPT_NAME']?>" onsubmit="return search_check();" name="list_search">
      

    <div class="form-group">
        <div class="form-group--search form-group--search--left">
            <input class="form-control form-control-lg form-control--rounded" name="search" type="search" placeholder="음식점명으로 검색" id="" placeholder="Search" size="20">
            <button class="btn-submit" type="submit"><i class="bootstrap-themes-icon-search"></i></button>
        </div>
    </div>

  </form>


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