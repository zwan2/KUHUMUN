<?php
include 'top.php';

$title = $_POST['title'];
$menu = $_POST['menu']; 
$price = $_POST['price'];

echo $title;
echo $menu;
echo $price;
//덮어씌워짐 문제 (3344가 덮음)
?>

<div class="container">





</div>



<?php
include 'footer.php';
?>