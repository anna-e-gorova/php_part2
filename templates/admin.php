<?php
if(isset($_SESSION['admin'])){?>
	<div id=adminPanel>
		<a href="?page=edit_good">Редактирование товаров</a>
		<a href="?page=add_good">Добавить новый товар</a>
		<a href="?page=edit_orders">Управление заказами</a>
    </div>
<?php
}