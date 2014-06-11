<?php 
$id = (int)$_GET['id'];
$con = mysql_connect("localhost","root","root") or die(mysql_error());
mysql_select_db("db_myasset");

$psql = "Select tbl_hardwares.id as pid, qnty, unit, vname, price 
		From tbl_hardwares, tbl_vendors
		Where tbl_hardwares.vid = tbl_vendors.id and cid=$id";


$result = mysql_query($psql);
$data = "<select name=\"prodid\" id=\"prodid\">";
while($row = mysql_fetch_assoc($result)){
	extract($row);
	$data .= "<option value=\"$pid\">".$vname.", (".$qnty." ".$unit.",".$price."$)</option>";
}
$data .="</select>";
mysql_close($con);
echo $data;

?>