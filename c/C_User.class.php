<?php
//
// Конттроллер пользователя.
//

class C_User extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_auth(){
		if ($_SESSION) {
			header("Location: index.php?c=User&act=lk");
		}
		$this->title .= '::Авторизация';
		$info = "Войдите в систему!";
       
		if($this->isPost()){
            $login =  !empty($_POST['login']) ? strip_tags($_POST['login']) : $errors .= "Поле Логин должно быть заполнено! ";
			$pass =  !empty($_POST['pass']) ? M_User::pass($login, strip_tags($_POST['pass'])) : $errors .= "Поле Пароль должно быть заполнено! ";
            if(!empty($errors)){
				$info = $errors;
			} else {
			$user = new M_User();
			$auth = $user->auth($login,$pass);
		    $auth ? header("Location: {$_POST['referer']}") : $info = "Пользователь не существует либо заблокирован";
			}
		}
		$this->content = $this->twig()->render('v_auth.twig', ['text' => $info, 'referer' => $_SERVER["HTTP_REFERER"]]);
	}

	public function action_exit(){
		session_destroy();
		header("Location: index.php");		
	}

	public function action_lk(){
		$this->title .= '::Личный кабинет';
		if ($_SESSION) {
			$user = new M_User();
			$username = $user->getUsername($_SESSION['id_user']);
			$info = "Hello $username";
			$orders = M_Order::getOrders($_SESSION['id_user']);
			if ($_SESSION['admin']) {
				$adminPanel = $this->twig()->render('v_admin_panel.twig');
			}
			$this->content = $this->twig()->render('v_lk.twig', ['text' => $info, 'orders' => $orders, 'adminPanel' => $adminPanel]);
		} else {
			header("Location: index.php?c=User&act=auth");	
		}	
	}

	public function action_reg() {
		if ($_SESSION) {
			header("Location: index.php?c=User&act=lk");
		}	
		$this->title .= '::Регистрация';
		$info = "Введите данные для регистрации";
		if($this->isPost()) {
			$new_user = new M_User();
			$reg = $new_user->regUser(strip_tags($_POST['name']), strip_tags($_POST['login']), M_User::pass(strip_tags($_POST['login']), strip_tags($_POST['pass'])));
			$reg ? header("Location: index.php?c=User&act=auth") : $info = "Пользователь с таким логином уже существует";
		}
		$this->content = $this->twig()->render('v_reg.twig', ['text' => $info]);
	}
}
