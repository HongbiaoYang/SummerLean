<?php 

$id = $_GET['id'];
if ($id == "")
{
	return;
}
else if ($id == "firstname" || $id == "lastname")
{
	echo "<input name=\"ckey\" id=\"ckey\"  value=\"\" size=\"20\" maxlength=\"100\" \\>";
	return;
}

	$dbHost = 'localhost';
	$dbUser = 'lean';
	$dbPass = 'lean2014';
	$dbName = 'lean';

	$dbConn = mysqli_connect ($dbHost, $dbUser, $dbPass, $dbName) or die ('MySQL connect failed. ' . mysqli_error());
	
	
	$psql =  "SELECT p.ProjIndex, p.Title, p.ComIndex, c.CompanyName
						FROM tbl_companies c, tbl_projects p
						WHERE p.ComIndex = c.ComIndex";
	
	
	$result = mysqli_query($dbConn ,$psql);
	$data = "<select name=\"ckey\" id=\"ckey\">";
	while($row = mysqli_fetch_assoc($result)){
		extract($row);
		$data .= "<option value=\"$ProjIndex\">".$Title."</option>";
	}
	$data .="</select>";
	//mysqli_close($dbConn);
	echo $data;


?>