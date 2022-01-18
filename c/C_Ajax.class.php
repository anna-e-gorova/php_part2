<?php
//
// Конттроллер страницы товара.
//

class C_Ajax
{
	//
	// Конструктор.
	//
	public function Request($action)
	{
		//$model = new M_Ajax();
		$this->$action();   //$this->action_index
	}

	public function action_moreGoods(){
		$goods = M_Catalog::getGoods($_POST['lastView']);
		$goodsList = C_Base::twig()->render('v_catalog_goods.twig', ['goods' => $goods]);
		echo $goodsList;
	}

	public function action_addToCart(){
		$sql="select * from cart inner join `users` on `cart`.`user_id`=`users`.`id` WHERE `good_id`='{$_POST['product']}' AND `user_id`='{$_POST['userId']}'";
		$existGoods = MPDO::getRow($sql);

		if (!$existGoods) {
			$sql="INSERT INTO `cart` (`user_id`, `good_id`, `count`) VALUES ('{$_POST['userId']}', '{$_POST['product']}', '1');";
			$res = MPDO::insert($sql);
		} else {
			$sql = "UPDATE `cart` SET `count` = `count` + 1 WHERE `good_id`='{$_POST['product']}' AND `user_id`='{$_POST['userId']}'";
			$res = MPDO::update($sql);	
		}
	}

	public function action_delFromCart(){
		$sql = "UPDATE `cart` SET `count` = `count` - 1 WHERE `good_id`='{$_POST['product']}' AND `user_id`='{$_POST['userId']}'";
		$res = MPDO::update($sql);	

		$sql = "DELETE FROM `cart` WHERE `cart`.`count` = 0";
		$res = MPDO::delete($sql);
	}

	public function action_createOrder(){
		$carts = M_Cart::getCart($_POST['userId']);
		if($carts){
			$date = date("Y-m-d H:i:s");
			$sql = "INSERT INTO `orders` (`date`, `user_id`) VALUES ('$date', '{$_POST['userId']}');";
			$res = MPDO::insert($sql);
		 
			$sql = "SELECT id FROM `orders` WHERE `date`='$date';";
			$res = MPDO::getRow($sql);
			$idOrder = $res['id'];
		 
			foreach ($carts as $cart) {
			   $sql = "INSERT INTO `goodsorder` (`order_id`, `good_id`, `count`) VALUES ('$idOrder', '{$cart['good_id']}', {$cart['count']});";
			   $res = MPDO::insert($sql);
			}
		 }
	}


}
