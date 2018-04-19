<?php
include 'top.php';
?>


<div class="container">

  <a href="table.php"><h1 class="mb-1 text-center">맛집 정리표</h1></a>
  <p class="fs-14 text-gray text-center mb-4">음식점을 추천해드립니다.</p>

  <blockquote class="blockquote text-center mb-4">
 
  <button type='button' class='btn btn-outline-dark text-center' onclick="window.location.href='random.php'">아무거나</button>
  </blockquote>

  <form method="get" action="<?=$_SERVER['SCRIPT_NAME']?>" onsubmit="return search_check();" id="list_search" name="list_search">
  
    <div class="form-group">
        <div class="form-group--search form-group--search--left">
            <input class="form-control form-control-lg form-control--rounded" name="search" type="search" placeholder="음식점명으로 검색" id="" placeholder="Search" maxlength="20" value="<?if(isset($_GET['search']))echo $_GET['search']?>">
            <button class="btn-submit" type="submit"><i class="bootstrap-themes-icon-search"></i></button>
        </div>
    </div>
  
    <?=list_view_type()?> 
  
  </form>


  <ul class="list-group list-group-flush">  
    <?=list_view()?>
  </ul>

  <br/>
<!--<?=list_view_new()?>-->
	
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