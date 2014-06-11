<?php 
$id = (int)$_GET['id'];
$con = mysql_connect("localhost","root","root") or die(mysql_error());
mysql_select_db("db_myasset");

$csql = "Select vname, tbl_pairs.vid as id from tbl_vendors, tbl_pairs
		Where tbl_pairs.vid = tbl_vendors.id and tbl_pairs.cid=$id";


$result = mysql_query($csql);
$data = "<select name=\"txtVname\">";
while($row = mysql_fetch_assoc($result)){
	extract($row);
	$data .= "<option value=\"$id\">".$vname."</option>";
}
$data .="</select>";
mysql_close($con);
echo $data;

?>