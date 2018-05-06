<?php
include 'top.php';
?>


<div class="container">

  <a href="list.php"><span class="fs-13 text-gray-soft">뒤로 가기</span></a>
  <br/>
  <?=detail_res_title()?>
  <div class="float-right">
    <a id="kakao-link-btn" href="javascript:sendLink()">
      <img src="//developers.kakao.com/assets/img/about/logos/kakaolink/kakaolink_btn_small.png"/>
    </a>
  </div><br>
  
  
  <?=detail_img()?>
  

  <br/>
  <table class="table table-sm">
    <thead>
      <tr>
        <th scope="col">메뉴</th>
        <th scope="col">가격</th>
        <th scope="col">업데이트</th>
      </tr>
    </thead>
    <tbody>
      <?=detail_view()?>
    </tbody>
  </table>

  <?=detail_res_report()?>
  <p class="fs-14 text-gray mb-1 text-center">확실한 정보는 <strong>굵게</strong> 표시됩니다.</p>


  <br/><hr/>
  <form method="post" action="comment.php" onsubmit="return comment_check();" name="comment">
    <div class="form-row align-items-center">
      <div class="col-10 col-md-11 my-1">
        <label class="sr-only" id="c" for="inlineFormInputName">코멘트</label>
        <input type="text" class="form-control" id="inlineFormInputName" placeholder="코멘트" maxlength="30" name="comment">
        <input type="hidden" name="res_id" value="<?=$_GET['res_id']?>">
      </div>
      
    
      <div class="col-2 col-md-1 my-1">
        <button type="submit" class="btn btn-outline-success">입력</button>
      </div>
    </div>
  </form>
  <?=detail_comment()?>


</div>


<!--카카오톡 공유-->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script type='text/javascript'>
  var now_link = window.location.href;
  //<![CDATA[
    // // 사용할 앱의 JavaScript 키를 설정해 주세요.
    Kakao.init('934c0a9e2ff59605632b32d65098ceae');
    // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
    function sendLink() {
      Kakao.Link.sendScrap({
        requestUrl: now_link
      });
    }




$('.carousel').carousel({
  interval: false
});

function comment_check() {
  var form = document.comment;

  //코멘트
  if(form.comment.value == "") {
    form.comment.focus();
    return false;
  }

}




</script>




<?php
include 'footer.php';
?>