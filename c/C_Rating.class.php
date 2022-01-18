<?php
//
// Конттроллер страницы отзывов.
//

class C_Rating extends C_Base
{
	//
	// Конструктор.
	//
	public function action_add(){
		$this->title .= '::Добавление отзыва';
		if($this->isPost())
		{
			$rating = new M_Rating;
			$rating->addRating($_POST);
			header('location: index.php');
			exit();
		}
		$this->content = $this->twig()->render('v_rating.twig', ['good_id' => $_GET['id']]);
	}

}
