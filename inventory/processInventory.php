<?php
require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../library/common.php';

require_once('../FirePHPCore/fb.php');

/*
$page = $_SERVER['PHP_SELF'];
$sec = "5";
header("Refresh: $sec; url=$page");
*/

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

fb($action, "action in processinventory");

switch ($action) {
	
	case 'add' :
		addInventory();
		break;
	case 'consume' :
		consumeInventory();
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
function addInventory()
{
	$catid = (int)$_POST['txtCategory'];
	$pdid = $_POST['prodid'];

	
	$rsql = "SELECT id
	        FROM tbl_inventory
			WHERE cid=$catid";
	$rresult = dbQuery($rsql);
	// $rrow = dbFetchAssoc($rresult);
	
	$psql = "select qnty, unit, price 
			From tbl_hardwares
			Where id=$pdid";
	$presult = dbQuery($psql);
	$prow = dbFetchAssoc($presult);
	extract($prow);
	
	if (dbNumRows($rresult) == 1) {
		$commonQnty = calcCommonQnty($qnty, $unit);

		$usql = "Update tbl_inventory
				Set level = level + $commonQnty, pref = $pdid
				Where cid=$catid";
		dbQuery($usql);

		$dsql = "Delete from tbl_shoplist where cid=$catid";
		dbQuery($dsql);


		header('Location: ../menu.php?v=INVR');	
		
	} else {			
		$sql   = "INSERT INTO tbl_inventory ( cid, level, unit, pref)
		          VALUES ($catid, '$qnty', $unit, $pdid)";
		
		dbQuery($sql);
			

		header('Location: ../menu.php?v=INVR');	
	}
}

function consumeInventory()
{
	$catvid = $_POST['txtCategory'];
	$amt = $_POST['amount'];
	do_consumeInventory($catvid, $amt);
	header('Location: ../menu.php?v=INVR&info='.urlencode('The inventory of '.$ctype.' is changed: '.$level." -> ".($level-$amt)));
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
