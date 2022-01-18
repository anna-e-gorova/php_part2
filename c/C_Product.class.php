<?php
//
// Конттроллер страницы товара.
//

class C_Product extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_open(){
		$this->title .= '::Товар';
		$product = new M_Product;
		$good = $product->getGood();
		$comments = M_Rating::getRatings();
		$this->content = $this->twig()->render('v_product.twig', ['comments' => $comments, 'good' => $good, 'id_user' => $_SESSION['id_user']]);
	}
}
