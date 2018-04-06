<?php
include 'top.php';
?>


<div class="container">

  <span class="fs-13 text-gray-soft" onclick="window.history.back();">뒤로 가기</span>
  <?=detail_res_title()?>
  <br/>
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