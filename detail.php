<?php
include 'top.php';
?>


<div class="container">

  <span class="fs-13 text-gray-soft" onclick="window.history.back();">뒤로 가기</span>
  <br/><br/>
  <?=detail_res_title()?>
  <br/>
  <p class="font-weight-bold">확실한 정보는 굵게 표시됩니다.</p>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">메뉴</th>
        <th scope="col">가격</th>
        <th scope="col">업데이트</th>
        <th scope="col">신고</th>
      </tr>
    </thead>
    <tbody>
      <?=detail_view()?>
    </tbody>
  </table>

</div>




<?php
include 'footer.php';
?>