<?php
require('config.php');

$sql="select * from cart inner join `users` on `cart`.`user_id`=`users`.`id` WHERE `good_id`='{$_POST['product']}' AND `user_id`='{$_POST['userId']}'";
$result = mysqli_query($con, $sql);
$existGoods = mysqli_fetch_all($result, MYSQLI_ASSOC);
$count= $existGoods['0']['count'];

if (!$existGoods) {
    $sql="INSERT INTO `cart` (`user_id`, `good_id`, `count`) VALUES ('{$_POST['userId']}', '{$_POST['product']}', '1');";
} else {
    if ($_POST['action'] == "del") {
        $count--;
     }
     else { 
        $count++;
     }
    $sql = "UPDATE `cart` SET `count`=$count WHERE `good_id`='{$_POST['product']}' AND `user_id`='{$_POST['userId']}'";
}

$res = mysqli_query($con, $sql);
$sql = "DELETE FROM `cart` WHERE `cart`.`count` = 0";
$res = mysqli_query($con, $sql);