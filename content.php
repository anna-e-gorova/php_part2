<?php
    require('config.php');
    require('functions.php');
	mysqli_set_charset($con, "utf8");
	$goods = getGoods($con, 0);
    include "templates/admin.php";

    switch($_GET['page']){
        case 'shop':
            include('templates/shop.php');
            break;
        case 'product':
            $id = $_GET['id'];
            $good = [];
            foreach ($goods as $product) {
                if ($product['id'] == $id) {
                    $good = $product;
                    break;
                }
            }
            include('templates/openedProduct.php');
            break;
        case 'auth':
            include "templates/auth.php";
            break;
        case 'rating':
            include "templates/rating.php";
            break;
        case 'cart':
            include "templates/cart.php";
            break;
        case 'reg':
            include "templates/reg.php";
            break;
        case 'add_good':
             include "admin/add_good.php";
             break;
        case 'edit_good':
            include "admin/edit_good.php";
            break;
        case 'edit_orders':
           include "admin/edit_orders.php";
           break;
        case 'exit':
           unset($_SESSION['id_user']);
           session_destroy();
           $_SESSION = null;
          
            
            echo "Вы успешно вышли из системы<br>";
            echo "<a href='index.php'>Перейти на главную</a>";
            break;
        default:
            include "templates/shop.php";
    }
?>