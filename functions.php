<?php

function getGoods($con, $offset) {
    $sql = "SELECT * FROM goods LIMIT $offset, 25";
	$result = mysqli_query($con, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
 
function addRating($con, $rating) {
    $sql = "INSERT INTO `rating` (`rating`, `comment`, `good_id`, `username`) VALUES ('{$rating['rating']}', '{$rating['comment']}', '{$rating['good']}', '{$rating['username']}')";
    $result = mysqli_query($con, $sql);
}

function getRatings($con, $goodId) {
    $sql="SELECT * FROM rating WHERE good_id=$goodId";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getCart($con, $id) {
    $sql="SELECT `cart`.`id`, `good_id`,`name`, `count` FROM `cart` inner join `users` on `cart`.`user_id`=`users`.`id` inner join `goods` on `cart`.`good_id`=`goods`.`id` WHERE `users`.`id`='$id';";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getOrders($con, $id) {
    $sql = "SELECT order_id, date, SUM(price*count) as totalprice, SUM(count) as totalcount FROM `orders` INNER JOIN `goodsorder` ON `orders`.`id` = `goodsorder`.`order_id` INNER JOIN `users` ON `orders`.`user_id` = `users`.`id` INNER JOIN `goods` ON `goodsorder`.`good_id` = `goods`.`id` WHERE users.id = '$id' GROUP BY order_id;";
	$result = mysqli_query($con, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAllOrders($con) {
    $sql = "SELECT `order_id`, `login`, date, SUM(price*count) as totalprice, SUM(count) as totalcount FROM `orders` INNER JOIN `goodsorder` ON `orders`.`id` = `goodsorder`.`order_id` INNER JOIN `users` ON `orders`.`user_id` = `users`.`id` INNER JOIN `goods` ON `goodsorder`.`good_id` = `goods`.`id` GROUP BY order_id;";
	$result = mysqli_query($con, $sql);
	return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

?>