<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'add' :
		addHardware();
		break;
		
	case 'modify' :
		modifyUser();
		break;
		
	case 'delete' :
		deleteHardware();
		break;
    

	default :
	    // if action is not defined or unknown
		// move to main user page
		header('Location: index.php');
}

/*
Function used to add entry in tbl_hardwares table.
*/
function addHardware()
{
	$catid = (int)$_POST['txtCategory'];
	$qnty = $_POST['txtQty'];
	$vid = (int)$_POST['txtVname'];
	$unit = $_POST['txtUnit'];
	$price = $_POST['txtPrice'];
	
	
	$sql = "SELECT id
	        FROM tbl_hardwares
			WHERE cid=$catid and vid=$vid and qnty=$qnty and unit='$unit'";
	$result = dbQuery($sql);
	
	if (dbNumRows($result) == 1) {
		header('Location: ../view.php?v=addhardware&error=' . urlencode('This product already exist. Choose Another one (Duplicated record found with Catetory, Vendor, Size, Unit all the same!)'));	
		// $sql = "";
		
	} else {			
		$sql   = "INSERT INTO tbl_hardwares (qnty, unit, vid, price, cid)
		          VALUES ($qnty, '$unit', $vid, $price, $catid)";
				  
		// echo $sql;
		
		dbQuery($sql);
		header('Location: ../menu.php?v=HRWR');	
	}
}

/*
	Remove a Hardware
*/
function deleteHardware()
{
	if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
		$id = (int)$_GET['id'];
	} else {
		header('Location: index.php');
	}
	
	
	$sql = "DELETE FROM tbl_hardwares
	        WHERE id = $id";
	dbQuery($sql);
	
	header('Location: ../menu.php?v=HRWR');
}
?>