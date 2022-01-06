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

	function db() {
		static $pdo;
	
		if ($pdo === null) {
			$pdo = new PDO('mysql:host=localhost;dbname=shop','root','root');
		}
	
		return $pdo;
	}
	
	//
	// Генерация базового шаблонаы
	//	
	public function render()
	{	
		$refs = ['Читать текст' => 'index.php', 'Редактировать текст' => 'index.php?c=page&act=edit'];
		$_SESSION ? $refs += ['Личный кабинет' => 'index.php?c=User&act=lk', 'Выйти' => 'index.php?c=User&act=exit'] : $refs += ['Войти' => 'index.php?c=User&act=auth'];
		$vars = array('title' => $this->title, 'content' => $this->content,'kw' => $this->keyWords, 'refs' => $refs);
		$page = $this->Template('v/v_main.php', $vars);				
		echo $page;
	}	
}
