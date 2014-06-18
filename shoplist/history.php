<?php
if (!defined('WEB_ROOT')) {
	exit;
}





$changeMessage = (isset($_GET['info']) && $_GET['info'] != '') ? $_GET['info'] : '&nbsp;';

$condition = "";
if(isset($_POST['submit']))
{
	$cate = $_POST["cate"];
	$ckey = $_POST["ckey"];


	$condition = "And s.".$cate." = ".$ckey;
	
}


$sql ="SELECT s.firstname, s.lastname, s.email, p1.title AS Choice1, 
				p2.title AS Choice2, p3.title AS Choice3, p4.title AS Choice4
				FROM tbl_students s
				JOIN tbl_projects p1 ON ( s.Choice1 = p1.Projindex )
				JOIN tbl_projects p2 ON ( s.Choice2 = p2.Projindex )
				JOIN tbl_projects p3 ON ( s.Choice3 = p3.Projindex )
				JOIN tbl_projects p4 ON ( s.Choice4 = p4.Projindex )
				WHERE 1 And s.StuIndex != 0".$condition;

$result = dbQuery($sql);

$total = mysqli_num_rows($result);

if(!isset($_GET["page"])) //whether get page parameter
{
	$thispage = 1; // use 1 by default
}
else
{
	$thispage = $_GET["page"];
}

$perpage = 10; // records per page
$limit = $perpage*($thispage-1); //start position

?> 

<script language="javascript">
	function showOption(id){

		$.get("ajaxQuery.php",
			{id: id},
			function(data){
				$("div#type").html(data);
			},
			"html");
	}

</script>



<form action= <?php echo $_SERVER['PHP_SELF']; ?> method="post">
<div class="prepend-1 span-17">
<table>
<tr>
<td colspan = "2">
<strong>List of students and projects informatoin<?php echo "-".$condition."-".$_SERVER['PHP_SELF'];?></strong>
<br>
The list of students, and the choices of the projects they have chosen.
</td>
<td>
<p><img src="<?php echo WEB_ROOT; ?>images/order-icon.png" class="right"/>
</td>
</tr>
<tr>
	<td>
	<select name="cate" onchange="showOption(this.value)">
		<option value="">--Choose Type--</option>
		<option value="firstname">By First Name</option>
		<option value="lastname">By Last Name</option>
		<option value="choice1">By 1st Choice</option>
		<option value="choice2">By 2nd Choice</option>
		<option value="choice3">By 3rd Choice</option>
		<option value="choice4">By 4th Choice</option>
	</select>
	</td>
		
	<td colspan="1" align="left"><div id="type"></div>	</td>
	<td colspan="1" align="left">
		<input name="filter" type="submit" id="filter" value="Filter" class="button">
		</td>
</tr>
</table>
</form>
<?php


$sql = "SELECT s.firstname, s.lastname, s.email, p1.title AS Choice1, 
				p2.title AS Choice2, p3.title AS Choice3, p4.title AS Choice4
				FROM tbl_students s
				JOIN tbl_projects p1 ON ( s.Choice1 = p1.Projindex )
				JOIN tbl_projects p2 ON ( s.Choice2 = p2.Projindex )
				JOIN tbl_projects p3 ON ( s.Choice3 = p3.Projindex )
				JOIN tbl_projects p4 ON ( s.Choice4 = p4.Projindex )
				WHERE 1 And s.StuIndex != 0 order by firstname asc limit ".$limit.",".$perpage;
		
$result = dbQuery($sql);

?>

 <table  border="0" align="left" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>FirstName</td>
   <td>LastName</td>
   <td>Choice1</td>
   <td>Choice2</td>
   <td>Choice3</td>
   <td>Choice4</td>
   
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	$i += 1;
?>
   <tr class="<?php echo $class; ?>"> 
   <td align="center"><?php echo $firstname; ?></td>
   <td align="center"><?php echo $lastname; ?></td>
   <td align="center"><?php echo $Choice1; ?></td>
   <td align="center"><?php echo $Choice2; ?></td>
   <td align="center"><?php echo $Choice3; ?></td>
   <td align="center"><?php echo $Choice4; ?></td>
  </tr>
  <?php 
  } // end of while
  
  ?>
  <tr> 
   <td colspan="3">&nbsp;</td>
  </tr>
 </table> 

	 <tr><td colspan = "3"><?php page($total, $perpage, $thispage,"?v=HISTORYORDER&page=");?></td></tr>
	 <br>
     <tr><td colspan="1" align="right">
     	<input name="btnSendOrder" type="button" id="btnSendOrder" value="Back" class="button" onClick="BacktoList()">
     	</td></tr>

 
  <FONT COLOR="blue"><?php echo $changeMessage?></FONT><br>
<p>&nbsp;</p>
</div>

