<?php 
require_once 'library/config.php';
//$con = mysqli_connect("localhost","root","root", "db_myasset") or die(mysql_error());
//$dbConn = mysqli_connect ($dbHost, $dbUser, $dbPass, $dbName) or die ('MySQL connect failed. ' . mysqli_error());

$reduce = rand(1, 9);

//$usql = "Update tbl_inventory 
//		Set level = level*(100 - $reduce) * 0.01";

//$result = dbQuery($usql);
//mysqli_close($dbConn);

updateShoplist($reduce);

echo 'rand='.$reduce;

?>
