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
		if (!$_SESSION) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Корзина';
		$cart = new M_Cart;
		$userCart = $cart->getCart($_SESSION['id_user']);
		$this->content = $this->twig()->render('v_cart.twig', ['cart' => $userCart, 'id_user' => $_SESSION['id_user']]);
	}
}
