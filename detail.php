<?php
include 'top.php';
?>


<div class="container">
  <small class="text-muted" onclick="window.history.back();">뒤로가기</small>
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