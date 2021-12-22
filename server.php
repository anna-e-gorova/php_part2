<?php
if ($_FILES['photo']['error']) {
    echo "Ошибка файла";
}elseif ($_FILES['photo']['size'] > 1048576 ) {
        echo "Файл слишком большого размера!";
}elseif (exif_imagetype($_FILES['photo']['tmp_name'])) {
    $path = "big/".$_FILES['photo']['name'];
    if(move_uploaded_file($_FILES['photo']['tmp_name'],$path)){
        $src = imagecreatefromjpeg($path);
        $imgResized = imagescale($src , 150, 150);
        imagejpeg($imgResized, "small/".$_FILES['photo']['name']);
        echo $_FILES['photo']['name']." успешно загружен!";
    }
} else echo "Выберите другой файл";




