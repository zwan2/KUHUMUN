<?php
include 'top.php';
?>


<div class="container">


  <button type='button' class='btn btn-success form-control-lg btn-block text-center' id="random_button" onclick="window.location.href='random.php'">무작위 선택</button>

  <form method="get" action="<?=$_SERVER['SCRIPT_NAME']?>" onsubmit="return search_check();" id="list_search" name="list_search">

    <div class="form-group">
        <div class="form-group--search form-group--search--left">
            <input class="form-control form-control-lg form-control--rounded" name="search" type="search" placeholder="음식점명으로 검색" id="" placeholder="Search" maxlength="20" value="<?if(isset($_GET['search']))echo $_GET['search']?>">
            <button class="btn-submit" type="submit"><i class="bootstrap-themes-icon-search"></i></button>
        </div>
    </div>
    
    <p class="mb-2"><strong>카테고리</strong></p>
    <?=list_view_type()?> 
  
  </form>

  <br/>

  <p class="mb-2"><strong>리스트</strong></p>
  <ul class="list-group list-group-flush">  
    <?=list_view()?>
  </ul>


  <br/>
  <p class="fs-14 text-gray text-center mb-4">확실한 정보는 <strong>굵게</strong> 표시됩니다.</p>

	
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


//type focus
function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
  function(m,key,value) {
    vars[key] = value;
  });
  return vars;
}
var get_id = getUrlVars()["type_search"];

var type = document.getElementById(eval(""+get_id+""));
type.style.backgroundColor = "#1e7e34";

</script>



<?php
include 'footer.php';
?>