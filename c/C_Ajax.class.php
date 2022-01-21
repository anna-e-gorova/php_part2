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

	public function action_refreshCart(){
			$userCart = M_Cart::getCart((int)$_POST['userId']);
			$goodsList = C_Base::twig()->render('v_cart_goods.twig', ['cart' => $userCart, 'id_user' => $_SESSION['id_user']]);
			echo $goodsList;		
	}


}
