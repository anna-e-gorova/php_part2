<?php

if($_GET['success'] == 1){?>
    <h1 style="color: red;">Товар успешно обновлен!</h1>
<?php }

if($_GET['action'] == "edit") {

    $id = $_GET['id'];
    $good = [];
    foreach ($goods as $product) {
        if ($product['id'] == $id) {
            $good = $product;
            break;
        }
    }
    ?>
    
    <form method="post" action="../admin_goods.php" enctype="multipart/form-data">
        <input name="id" type="hidden" value="<?= $_GET['id']?>">
        <input name="action" type="hidden" value="edit">
        <p>Название товара</p>
        <input name="title" type="text" value="<?= $good['name']?>">
        <p>Стоимость товара</p>
        <input name="price" type="text" value="<?= $good['price']?>">
        <p>Информация о товаре</p>
        <textarea name="info" cols="30" rows="10" value="<?= $good['description']?>"><?= $good['description']?></textarea>
        <p>Изображение товара</p>
        <img name="img" width="100" src="images/goods/big/<?= $good['img']?>" alt="">
        <input name="oldImg" type="hidden" value="<?= $good['img']?>">
        <input type="file" accept="image/jpeg" name="photo"><br><br>
        <input type="submit" value="Сохранить">
    </form>

    <?php
}



if($_GET['action'] != "edit") {
?>

<h1>Редактирование товаров</h1>

<table align="center" border="1" width="600">
    <tr>
        <th>Название товара</th>
        <th>Действие</th>
    </tr>
    <?php
    if(!empty($goods)){
    foreach ($goods as $good){?>
        <tr>
            <td><?= $good['name']?></td>
            <td>
                <a href="admin_goods.php?action=delete&id=<?= $good['id']?>"><button>Удалить товар</button></a>
                <a href="/?page=edit_good&action=edit&id=<?= $good['id']?>"><button>Редактировать товар</button></a>
            </td>
        </tr>
    <?php
    }
    }
    else{?>
        <h1>Товары отсутствуют!</h1>
    <?php
    }
    ?>

</table>
<?php
}
?>