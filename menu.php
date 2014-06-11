<?php
require_once 'library/config.php';
require_once 'library/functions.php';
require_once('FirePHPCore/fb.php');	

/*
$page = $_SERVER['PHP_SELF'];
$sec = "10";
header("Refresh: $sec; url=$page"."?v=INVR");
*/

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();
//alwaysUpdateDebug();

$view = (isset($_GET['v']) && $_GET['v'] != '') ? $_GET['v'] : '';

switch ($view) {
	case 'USER' :
		$content 	= 'user/list.php';		
		$pageTitle 	= 'Asset Management - View Users';
		break;

	case 'HRWR' :
		$content 	= 'hardware/list.php';		
		$pageTitle 	= 'Asset Management - View Hardwares';
		break;

	case 'SFWR' :
		$content 	= 'software/list.php';		
		$pageTitle 	= 'Asset Management - View Softwares List';
		break;

	case 'LABS' :
		$content 	= 'labs/list.php';		
		$pageTitle 	= 'Asset Management - View Labs List';
		break;

	case 'STCK' :
		$content 	= 'stock/list.php';		
		$pageTitle 	= 'Asset Management - View Labs List';
		break;		
		
	case 'SHOPLIST' :
		$content 	= 'shoplist/list.php';		
		$pageTitle 	= 'Shopping List Management - What you need to buy';
		break;		
	case 'HISTORYORDER' :
		$content 	= 'shoplist/history.php';		
		$pageTitle 	= 'Shopping List Management - What you have purchased before';
		break;		
	case 'INVR' :
		$content 	= 'inventory/list.php';		
		$pageTitle 	= 'Inventory Management - Check Current Inventory';
		break;
}

$script    = array('user.js', 'hardware.js', 'software.js', 'inventory.js');

require_once 'template.php';

?>
