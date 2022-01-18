<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы
    protected $keyWords;


     protected function before(){

		$this->title = 'тест';
		$this->content = '';
		$this->keyWords="...";

	}

	public static function twig() {
		$loader = new \Twig\Loader\FilesystemLoader('v');
		$twig = new \Twig\Environment($loader, [
			'cache' => 'cache',
		]);
		return $twig;
	}
	
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{	
		$refs = ['Каталог' => 'index.php'];
		$_SESSION ? $refs += ['Личный кабинет' => 'index.php?c=User&act=lk', 'Корзина' => 'index.php?c=Cart&act=show', 'Выйти' => 'index.php?c=User&act=exit'] : $refs += ['Войти' => 'index.php?c=User&act=auth', 'Регистрация' => 'index.php?c=User&act=reg'];
		$vars = array('title' => $this->title, 'content' => $this->content,'kw' => $this->keyWords, 'refs' => $refs);
		$page = $this->twig()->render('v_main.twig', $vars);				
		echo $page;
	}	
}
