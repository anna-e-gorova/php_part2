<?php 
require('config.php');
require('functions.php');

$goods = getGoods($con, $_POST['lastView']);

echo json_encode($goods);