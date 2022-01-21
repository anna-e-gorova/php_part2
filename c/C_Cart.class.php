<?php
//
// Конттроллер Корзины.
//

class C_Cart extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_show(){
		$this->title .= '::Корзина';
		$cart = new M_Cart;
		$userCart = $cart->getCart($_SESSION['id_user']);
		$goodsList = $this->twig()->render('v_cart_goods.twig', ['cart' => $userCart, 'id_user' => $_SESSION['id_user']]);
		$this->content = $this->twig()->render('v_cart_base.twig', ['list_goods' => $goodsList, 'id_user' => $_SESSION['id_user']]);
	}
}
