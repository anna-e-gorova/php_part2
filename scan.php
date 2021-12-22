
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
  $template = $twig->loadTemplate('scan.tmpl');
  
  // передаём в шаблон переменные и значения
  // выводим сформированное содержание
  $sql = "select id,title,alt from images order by count desc";
  $res = mysqli_query($connect,$sql);
  $files = mysqli_fetch_all($res, MYSQLI_ASSOC);
     $content = $template->render(array(
    'items' => $files
  ));
  echo $content;
  
} catch (Exception $e) {
  die ('ERROR: ' . $e->getMessage());
}
?>