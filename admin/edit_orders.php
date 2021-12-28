<h1>Управление заказами</h1>
<table border='1' width='800'>
<tr>
	<th>№ заказа</th>
	<th>Логин</th>
	<th>Общая сумма заказа</th>
	<th>Удалить</th>
</tr>
<?php 
    $orders = getAllOrders($con);
    foreach ($orders as $order){
    ?>
       <tr>
       		<td><?= $order['order_id']?></td>
       		<td><?=$order['login']?></td>
       		<td><?=$order['totalprice']?></td>
       		<td><a href="admin_goods.php?action=deleteOrder&id=<?= $order['order_id']?>"><button>Удалить заказ</button></a></td> 
       </tr> 
    <?php }
?>
</table>