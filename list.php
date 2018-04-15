<?php
include 'top.php';
?>


<div class="container">

  <a href="list.php"><h1 class="mb-1 text-center">음식점 리스트</h1></a>
  <p class="fs-14 text-gray text-center mb-4">확실한 정보는 <strong>굵게</strong> 표시됩니다.</p>

  <blockquote class="blockquote text-center mb-4">
  <?=list_random()?>
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