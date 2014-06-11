<?php
require_once '../library/config.php';
require_once '../library/functions.php';

checkUser();


	
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'add' :
		assignUser();
		break;
		
	case 'delete' :
		deleteUser();
		break;

	default :
	    // if action is not defined or unknown
		// move to main user page
		header('Location: index.php');
}


/*
functaion is used to assign Hardware, software to user, lab.
if the given qualtity is greater then available quantity then it shows error message to user.
*/
function assignUser()
{

	
    $vendor = $_POST['vendor'];
	$category = $_POST['category'];
	
	$cksql = "SELECT cid, vid   
	        FROM tbl_pairs
			WHERE cid = $category and vid = $vendor";
			
	$adsql = "Insert into tbl_pairs (cid, vid)
			 Values($category, $vendor)";

	$res = dbQuery($cksql);
	
	
	if (!$res) {
		print 'Debug: problem with query';
	}
	else {
		$row_num = mysql_num_rows($res);
		if ( $row_num == 0) {
			dbQuery($adsql);
			header('Location: ../assign');		
		}	
		else {
			header('Location: ../view.php?v=assign&error=' . urlencode('Product - Vendor pair already existed. Choose Add another'));	
		}
	}
	
			
	
	
}

?>