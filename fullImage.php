<?php
// подгружаем и активируем авто-загрузчик Twig-а
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();
require_once "config.php";

try {
  // указывае где хранятся шаблоны
  $loader = new Twig_Loader_Filesystem('templates');
  
  // инициализируем Twig
  $twig = new Twig_Environment($loader);
  
  // подгружаем шаблон
  $template = $twig->loadTemplate('fullImage.tmpl');
  
  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  $sql = "select title,alt,count from images where id={$_GET['img']}";
  $res = mysqli_query($connect,$sql);
  $img = mysqli_fetch_assoc($res);
  $count = $img['count'] + 1;
  $sql = "update images set count=$count where id={$_GET['img']}";
  mysqli_query($connect,$sql);
  $content = $template->render(array(
    'fileName' => $img['title'],
    'fileAlt' => $img['alt'],
    'count' => $count
  ));
  echo $content;
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>