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
		$goodId = (int)$_GET['id'];
		$_SESSION['id_user'] ? $user = M_User::getUsername($_SESSION['id_user']) : $user = "anonymous";
		if($this->isPost())
		{
			$rating = new M_Rating;
			$rating->addRating($_POST);
			header("location: index.php?c=Product&act=open&id=$goodId");
			exit();
		}
		$this->content = $this->twig()->render('v_rating.twig', ['good_id' => $goodId, 'user_name' => $user]);
	}

}
