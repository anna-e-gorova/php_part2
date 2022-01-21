<?php
session_start();

require_once 'autoload.php';

$action = 'action_';
$action .= $_GET['act'] ?? 'index';

switch ($_GET['c'])
{
	case 'Catalog':
		$controller = new C_Catalog();
		break;
	case 'User':
		$controller = new C_User();
		break;
	case 'Product';
		$controller = new C_Product();
		break;
	case 'Cart';
		$controller = new C_Cart();
		break;
	case 'Rating';
		$controller = new C_Rating();
		break;
	case 'Ajax';
		$controller = new C_Ajax();
		break;
	default:
		$controller = new C_Catalog();
}
if (php_sapi_name() != 'cli') $controller->Request($action);
