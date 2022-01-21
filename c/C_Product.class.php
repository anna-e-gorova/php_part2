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
		$good = $product->getGood((int)$_GET['id']);
		$comments = M_Rating::getRatings((int)$_GET['id']);
		$this->content = $this->twig()->render('v_product.twig', ['comments' => $comments, 'good' => $good, 'id_user' => $_SESSION['id_user']]);
	}

	public function action_photos(){
		$this->title .= '::Фотографии товара';
		$product = new M_Product;
		$files = $product->getGoodPhotos((int)$_GET['id']);
		$this->content = $this->twig()->render('v_photos.twig', ['files' => $files, 'good_id' => (int)$_GET['id']]);
	}
}
