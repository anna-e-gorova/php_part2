<?php
//
// Конттроллер пользователя.
//

class C_Admin extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_editGoodList(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Управление товарами';
		$info = "Управление товарами";
       
		$goods = M_Catalog::getAllStatusGoods(0,9999);
		$this->content = $this->twig()->render('v_admin_editGoodList.twig', ['text' => $info, 'goods' => $goods]);

	}

	public function action_editGood(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Редактор товара';
		$info = "Редактор товара";
       
		$goodId = (int)$_GET['id'];
		$good = M_Product::getGood($goodId);

		if($this->isPost()) {
			if ($_FILES['img']['error']) {
				$_FILES['img']['name'] = strip_tags($_POST['oldImg']);
			} elseif ($_FILES['img']['size'] > 1048576 ) {
				$info = "Файл слишком большого размера!";
			} elseif (exif_imagetype($_FILES['img']['tmp_name'])) {
				$path = DIR_BIG_IMG . $_FILES['img']['name'];
				if(move_uploaded_file($_FILES['img']['tmp_name'],$path)){
					$src = imagecreatefromjpeg($path);
					$imgResized = imagescale($src , 384, 256);
					imagejpeg($imgResized, DIR_SMALL_IMG . $_FILES['img']['name']);
				}
			}
			$admin = new M_Admin();
			$res = $admin->editGood(strip_tags($_POST['name']), strip_tags($_POST['description']), strip_tags($_POST['price']), $_FILES['img']['name'], $goodId);
			$res ? header("Location: index.php?c=Product&act=open&id=$goodId") : $info = "Ошибка редактирования";
		}
		
		$this->content = $this->twig()->render('v_admin_editGood.twig', ['text' => $info, 'good' => $good]);
	}

	public function action_addGood(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Добавление товаров';
		$info = "Добавление нового товара";
		
		if($this->isPost()) {
			if ($_FILES['img']['error']) {
				$info = "Ошибка файла";
			} elseif ($_FILES['img']['size'] > 1048576 ) {
				$info = "Файл слишком большого размера!";
			} elseif (exif_imagetype($_FILES['img']['tmp_name'])) {
				$path = DIR_BIG_IMG . $_FILES['img']['name'];
				if(move_uploaded_file($_FILES['img']['tmp_name'],$path)){
					$src = imagecreatefromjpeg($path);
					$imgResized = imagescale($src , 384, 256);
					imagejpeg($imgResized, DIR_SMALL_IMG . $_FILES['img']['name']);
				}
			}
			$admin = new M_Admin();
			$res = $admin->addGood(strip_tags($_POST['name']), strip_tags($_POST['description']), strip_tags($_POST['price']), $_FILES['img']['name'], $_POST['active']);
			$res ? header("Location: index.php?c=Product&act=open&id=$res") : $info = "Ошибка добавления";
		}
		$this->content = $this->twig()->render('v_admin_addGood.twig', ['text' => $info]);	
	}

	public function action_delGood(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Удаление товара';
		$info = "Удаление товара";
		$admin = new M_Admin();
		$res = $admin->delGood((int)$_GET['id']);
		$res ? header("Location: index.php?c=Admin&act=editGoodList") : $info = "Ошибка Удаления";	
	}

	public function action_editOrder(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Управление заказами';
		$info = "Управление заказами";
       
		$orders = M_Order::getAllOrders();
		$this->content = $this->twig()->render('v_admin_editOrder.twig', ['text' => $info, 'orders' => $orders]);
	}

	public function action_editRating(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Управление отзывами';
		$info = "Управление отзывами";
       
		$ratings = M_Rating::getAllRatings();
		$this->content = $this->twig()->render('v_admin_editRating.twig', ['text' => $info, 'ratings' => $ratings]);
	}

	public function action_editUser(){
		if (!$_SESSION['admin']) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Управление пользователями';
		$info = "Управление пользователями";
       
		$sql = "SELECT * FROM users";
        $users = MPDO::Select($sql);
		$this->content = $this->twig()->render('v_admin_editUser.twig', ['text' => $info, 'users' => $users]);
	}
}
