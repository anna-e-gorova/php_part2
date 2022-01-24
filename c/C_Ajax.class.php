<?php
//
// Конттроллер Axajes.
//

class C_Ajax
{
	//
	// Конструктор.
	//
	public function Request($action)
	{
		$this->$action();
	}

	public function action_moreGoods(){
		if ((int)$_POST['lastView']){
			$goods = M_Catalog::getGoods((int)$_POST['lastView']);
			$goodsList = C_Base::twig()->render('v_catalog_goods.twig', ['goods' => $goods, 'id_user' => $_SESSION['id_user']]);
			echo $goodsList;
		}
	}

	public function action_addToCart(){
		if ((int)$_POST['goodId']){
			return M_Product::addToCart((int)$_POST['goodId'], (int)$_POST['userId']);
		}   else return false; 
	}

	public function action_delFromCart(){
		if ((int)$_POST['goodId']){
			return M_Cart::delFromCart((int)$_POST['goodId'], (int)$_POST['userId']);
		}   else return false; 
	}

	public function action_createOrder(){
		if ((int)$_POST['userId']){
			return M_Cart::createOrder((int)$_POST['userId']);
		}
	}

	public function action_cleanCart(){
			return M_Cart::cleanCart((int)$_POST['userId']);
	}

	public function action_galary(){
			$files = M_Product::getGoodPhotos((int)$_POST['goodId']);
			$photos = C_Base::twig()->render('v_photos.twig', ['files' => $files, 'good_id' => (int)$_POST['id']]);
			echo $photos;
	}

	public function action_refreshCart(){
			$userCart = M_Cart::getCart((int)$_POST['userId']);
			$goodsList = C_Base::twig()->render('v_cart_goods.twig', ['cart' => $userCart, 'id_user' => $_SESSION['id_user']]);
			echo $goodsList;		
	}

	public function action_changeStatusGood(){
		if ($_SESSION['admin']) {
			$status = strip_tags($_POST['newStatus']);
			$id = (int)($_POST['goodId']);
			$sql = "UPDATE `goods` SET `active` = '$status' WHERE `id` = $id";
			return $res = MPDO::update($sql);
			} else return false;		
	}

	public function action_delOrder(){
		if ($_SESSION['admin']) {
			$orderId = (int)$_POST['orderId'];
			$sql = "DELETE FROM `orders` WHERE `id` = '$orderId'";
        	return $res = MPDO::delete($sql);
		} else return false;
	}

	public function action_changeStatusOrder(){
		if ($_SESSION['admin']) {
		$status = strip_tags($_POST['newStatus']);
		$id = (int)($_POST['orderId']);
		$sql = "UPDATE `orders` SET `status` = '$status' WHERE `id` = '$id'";
		return $res = MPDO::update($sql);
		} else return false;		
	}

	public function action_delRating(){
		if ($_SESSION['admin']) {
			$ratingId = (int)$_POST['ratingId'];
			$sql = "DELETE FROM `rating` WHERE `id` = '$ratingId'";
        	return $res = MPDO::delete($sql);
		} else return false;
	}

	public function action_changeStatusRating(){
		if ($_SESSION['admin']) {
		$status = strip_tags($_POST['newStatus']);
		$id = (int)($_POST['ratingId']);
		$sql = "UPDATE `rating` SET `active` = '$status' WHERE `id` = $id";
		return $res = MPDO::update($sql);
		} else return false;		
	}

	public function action_delUser(){
		if ($_SESSION['admin']) {
			$userId = (int)$_POST['userId'];
			$sql = "DELETE FROM `users` WHERE `id` = '$userId'";
        	return $res = MPDO::delete($sql);
		} else return false;
	}

	public function action_changeGroupUser(){
		if ($_SESSION['admin']) {
		$group = strip_tags($_POST['newGroup']);
		$id = (int)($_POST['userId']);
		$sql = "UPDATE `users` SET `usergroup` = '$group' WHERE `id` = $id";
		return $res = MPDO::update($sql);
		} else return false;		
	}

	public function action_changeStatusUser(){
		if ($_SESSION['admin']) {
		$status = strip_tags($_POST['newStatus']);
		$id = (int)($_POST['userId']);
		$sql = "UPDATE `users` SET `active` = '$status' WHERE `id` = $id";
		return $res = MPDO::update($sql);
		} else return false;		
	}


}
