<?php
require('config.php');
require('functions.php');
$date = date("Y-m-d H:i:s");
$sql = "INSERT INTO `orders` (`date`, `user_id`) VALUES ('$date', '{$_POST['userId']}');";
$res = mysqli_query($con, $sql);

$sql = "SELECT id FROM `orders` WHERE `date`='$date';";
$res = mysqli_query($con, $sql);
$idOrder = mysqli_fetch_assoc($res)['id'];


$carts = getCart($con, $_POST['userId']);
foreach ($carts as $cart) {
   $sql = "INSERT INTO `goodsorder` (`order_id`, `good_id`, `count`) VALUES ('$idOrder', '{$cart['good_id']}', {$cart['count']});";
   $res = mysqli_query($con, $sql);
}

