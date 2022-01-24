<?php
//
// Конттроллер страницы товара.
//

class C_Product extends C_Base
{
	//
	// Конструктор.
	//var_dump($_SERVER["HTTP_REFERER"]);
	
	public function action_open(){
		$this->title .= '::Товар';
		$product = new M_Product;
		$good = $product->getGood((int)$_GET['id']);
		$comments = M_Rating::getRatings((int)$_GET['id']);
		if ($_SESSION['admin'] || $good['active'] === "Y") {
		$this->content = $this->twig()->render('v_product.twig', ['comments' => $comments, 'good' => $good, 'id_user' => $_SESSION['id_user']]);
		} else header("Location: index.php");
	}

}
