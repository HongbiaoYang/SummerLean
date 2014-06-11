<?php
require_once 'library/config.php';
require_once 'library/functions.php';

checkUser();

$content = 'main.php';

$pageTitle = 'Smart Kitchen';
$script = array();

//require_once('FirePHPCore/fb.php');

//ob_start();
//fb($pageTitle, "index title");


require_once 'template.php';

?>
