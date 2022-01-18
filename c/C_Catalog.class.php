<?php
//
// Конттроллер каталога.
//

class C_Catalog extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
		$this->title .= '::Каталог';
		$catalog = new M_Catalog;
		$goods = $catalog->getGoods();
		$goodsList = $this->twig()->render('v_catalog_goods.twig', ['goods' => $goods]);
		$this->content = $this->twig()->render('v_catalog_base.twig', ['list_goods' => $goodsList]);
	}
}
