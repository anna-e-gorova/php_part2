<div id="openedProduct-img">
    <img src="<?= "images/goods/big/{$good['img']}"; ?>">
</div>
<div id="openedProduct-price">
    <h1>Цена: <?= $good['price'] ?></h1>
    </div>
    <a onclick="addToCart(<?= $good['id'] ?>,<?= $_SESSION['id_user'] ?>)" href="#" class="button-primary shopUnitMore" >Добавить в корзину</a>
<div id="openedProduct-content">
    <h1 id="openedProduct-name">
        <?= $good['name'] ?>
    </h1>
    <p>Отзывы:</p>
    <div id="ratings">
        <?php
        $comments = getRatings($con, $good['id']);
        foreach ($comments as $comment): ?>
        <div id="ratingProduct" >
            <p>Пользователь: <?= $comment['username'] ?></p>
            <p>Оценка: <?= $comment['rating'] ?></p>
            <p>Комментарий: <?= $comment['comment'] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="index.php?page=rating&product=<?=$good['id']?>" class="shopUnitMore">Оставить отзыв</a>
    <div id="openedProduct-description">
        <?= $good['description'] ?>
    </div>
</div>
