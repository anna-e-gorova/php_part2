<h1>
    Каталог товаров
</h1>

<div id="catGoods">
    <?php foreach ($goods as $good): ?>
        <div class="shopUnit">
            <img src="<?= "images/goods/small/{$good['img']}" ?>"/>

            <div class="shopUnitName">
                <?= $good['name'] ?>
            </div>
            <div class="shopUnitShortDescription">
                <?= substr($good['description'],0,200)."..." ?>
            </div>
            <div class="shopUnitPrice">
                Цена: <?= $good['price'] ?>
            </div>
            <a href="index.php?page=product&id=<?= $good['id'] ?>" class="shopUnitMore">
                Подробнее
            </a>
        </div>
    <?php endforeach; ?>
</div>
<button onclick="viewMore()" class="shopUnit" >Показать еще</button>