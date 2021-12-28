<p>Корзина:</p>
    <div id="cart">
        <?php
        $cart = getCart($con, $_SESSION['id_user']);
        foreach ($cart as $good): ?>
        <div id="cartProduct" >
            <p>Товар: <?= $good['name'] ?></p>
            <p>Кол-во: <?= $good['count'] ?></p>
            <a onclick="delFromCart(<?= $good['good_id'] ?>,<?= $_SESSION['id_user'] ?>)" href="index.php?page=cart" class="button-primary shopUnitMore" >Удалить</a>
        </div>
        <?php endforeach; ?>
    </div>
    <a onclick="createOrder(<?= $_SESSION['id_user'] ?>)" href="index.php?page=cart" class="button-primary shopUnitMore" >Оформить заказ</a>
<p>Заказы:</p>

<?php
        $orders = getOrders($con, $_SESSION['id_user']);
        foreach ($orders as $order): ?>
        <div id="cartProduct" >
            <p>Номер заказа: <?= $order['order_id'] ?></p>
            <p>Дата: <?= $order['date'] ?></p>
            <p>Кол-во товаров: <?= $order['totalcount'] ?></p>
            <p>Сумма: <?= $order['totalprice'] ?></p>
        </div>
        <?php endforeach; ?>