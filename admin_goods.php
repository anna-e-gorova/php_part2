<?php
include "config.php";

if($_GET['action'] == 'delete') {
    $id=(int)$_GET['id'];
    $sql = "DELETE FROM `goods` WHERE `goods`.`id` = $id";
    $res = mysqli_query($con,$sql); 
    header("Location: index.php?page=edit_good");
}

if($_GET['action'] == 'deleteOrder') {
    $id=(int)$_GET['id'];
    $sql = "DELETE FROM `orders` WHERE `id` = $id";
    $res = mysqli_query($con,$sql); 
    header("Location: index.php?page=edit_orders");
}

$title = strip_tags($_POST['title']);
$price = (int)strip_tags($_POST['price']);
$info = strip_tags($_POST['info']);

if ($_FILES['photo']['error'] && $_POST['action'] == "edit") {
    $_FILES['photo']['name'] = $_POST['oldImg'];
} elseif ($_FILES['photo']['error']) {
    echo "Ошибка файла";
}elseif ($_FILES['photo']['size'] > 1048576 ) {
        echo "Файл слишком большого размера!";
}elseif (exif_imagetype($_FILES['photo']['tmp_name'])) {
    $path = "images/goods/big/".$_FILES['photo']['name'];
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
        $src = imagecreatefromjpeg($path);
        $imgResized = imagescale($src , 384, 256);
        imagejpeg($imgResized, "images/goods/small/".$_FILES['photo']['name']);
    }
} 

if ($_POST['action'] == "edit"){
    $sql = "update goods set name='$title',description='$info',price=$price,img='{$_FILES['photo']['name']}' where id={$_POST['id']}";    
} elseif ($_POST['action'] == "add") {
    $sql = "insert into goods(name,description,price,img) value('$title','$info',$price,'{$_FILES['photo']['name']}')";
}        
$res = mysqli_query($con,$sql);
if($res){
    header("Location: index.php?page=shop");
}
echo "error";






