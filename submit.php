<?php
include 'top.php';

$title = $_POST['title'];
$menu = $_POST['menu']; 
$price = $_POST['price'];

$menu = implode(',', $menu);
$price = implode(',', $price);


for($i=0;$i<count($menu);$i++)
  {
    echo $addText[$i]."<br>\n";
    $query = "INSERT INTO RES_DETAIL () "
  }

?>

<div class="container">





</div>



<?php
include 'footer.php';
?>