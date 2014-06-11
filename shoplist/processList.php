<?php
require_once '../library/config.php';
require_once '../library/functions.php';

require_once('../FirePHPCore/fb.php');

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

fb($action, "action in processinventory");

switch ($action) {
	
	case 'order' :
		prepareOrder();
		break;
	case 'confirm' :
		confirmOrder();
		break;
	default :
	    // if action is not defined or unknown
		// move to main user page
		header('Location: index.php');
}

/*
Function used to add entry in tbl_hardwares table.
*/
function prepareOrder()
{	
	$pdids = $_POST['txtProduct'];

	foreach ($pdids as $value)
	{
		$csql = "Select pref 
				 From tbl_inventory 
				 Where cid = 
				 (Select cid from tbl_hardwares where id = $value)";
		$cresult = dbQuery($csql);
		$crow = dbFetchAssoc($cresult);		
		extract($crow);
		
		//header('Location: ../view.php?v=sendorder&info='.urlencode("-".$pref."-".$value));	
		
		if ($pref == $value)
		{
			continue;			
		}
		else
		{
			$usql = "Update tbl_inventory
					 Set pref = $value where pref = $pref";
			dbQuery($usql);
		}
	}
	
	header('Location: ../view.php?v=sendorder&info='.urlencode(""));	

	// header('Location: ../menu.php?v=INVR');	
}

function confirmOrder()
{
	//// save the shop list into the history table for later check
	// $xsql = "Insert into tbl_history (cid, pid, date, desc)  
			 // Select s.cid, pref ,now(), concat()
			 // From tbl_shoplist s, tbl_inventory i 
			 // Where s.cid=i.cid;";
			 
	$xsql = 'Insert into tbl_history (cid, pid, pdate, pdesc)
			 Select s.cid, i.pref, now(), 
			 concat(h.qnty, " ", h.unit,", $ ", h.price,", ", v.vname) 
			 From tbl_shoplist s, tbl_inventory i, tbl_hardwares h, tbl_vendors v 
			 Where s.cid=i.cid and h.id=i.pref and v.id = h.vid';
			 
	dbQuery($xsql);
		
	//// replenish the inventory
	$psql = "Select id, cid, qnty ,unit,price 
			 From tbl_hardwares 
			 Where id in 
			 (Select pref From tbl_shoplist s, tbl_inventory i Where s.cid=i.cid)";
	$presult = dbQuery($psql);
		
	while($prow = dbFetchAssoc($presult)) {
		
		extract($prow);

		$commonQnty = calcCommonQnty($qnty, $unit);
		
		$usql = "Update tbl_inventory
				Set level = level + $commonQnty, pref = $id
				Where cid=$cid";
		dbQuery($usql);		
	}
	
	//// delete the record from the shoplist table
	$dsql = "Delete from tbl_shoplist;";
	dbQuery($dsql);
	
	//// navigate to the new page
	header('Location: ../menu.php?v=INVR');	
	
}



?>