<h1>Добавление нового товара</h1>

<form action="../admin_goods.php" method="post" enctype="multipart/form-data">
	<input name="action" type="hidden" value="add">
	<p>Название товара</p>
	<input type="text" name="title">
	<p>Стоимость товара</p>
	<input type="text" name="price">
	<p>Информация о товаре</p>
	<textarea name="info" rows="10" cols="30"></textarea>
	<p>Загрузить фото</p>
	<input type="file" name="photo" accept="image/jpeg"><br></br>
	<input type="submit" value="Сохранить"> 	
</form>