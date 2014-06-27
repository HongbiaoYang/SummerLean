<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql_leader = "SELECT t.firstname as t_first, t.lastname as t_last, "
		. "t.email as t_email, t.pic as pic, t.biography as bio "
    . " FROM tbl_students s, tbl_teamleaders t\n"
    . " WHERE 1 And t.leaderindex = s.team and s.stuIndex = "
    . $_SESSION['asset_user_id'];

$sql_project = " SELECT p.ProjIndex as pid, p.title as title, c.companyname as company, "
		. " t.firstname as t_first, t.lastname as t_last, t.email as t_email "
		. " FROM tbl_projects p, tbl_companies c, tbl_students s, tbl_teamleaders t"
		. " WHERE 1 And t.leaderindex = s.team and p.ComIndex = c.ComIndex and "
		. " c.teamleader = t.leaderindex and s.stuIndex = "
    . $_SESSION['asset_user_id'];




?> 
<div class="prepend-1 span-17">
<p>&nbsp;</p>
<h2 class="catHead">Projects Information</h2>
<p><img src="images/users.png" class="left"/>
	<p class="errorMessage"><?php echo $errorMessage; ?></p>
<strong>This page shows your team and projects information</strong>
<br/>

<?php 
	
		$result_leader = dbQuery($sql_leader);
		$row_leader = dbFetchAssoc($result_leader);
		extract($row_leader);

		echo "Your projetcs and team members information is as below:"?>

 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td colspan = "2"><?php echo "Team Information";
   	?></td>
    </tr>


  <tr class="<?php echo $class; ?>"> 
  <td><?php echo "Your Name:";?></td>
   <td><?php 
   		echo ucfirst($t_first)." ".ucfirst($t_last); 
	  	?>
   	</td>
 </tr>
 
 	<tr>
 	<td>Email:</td>
 	<td align="center"><a href="mailto:<?php echo $t_email; ?>"><?php echo $t_email; ?></a></td>
 	</tr>
 	<tr>
 	 	<td align="center"><p><img src="images/teamleader/<?php echo $pic; ?>" class="left" height = "240"/></td>
 		<td align="left"><?php echo $bio; ?></td>
 	</tr>
 	
 	
 	
</table>
  
  <?php
  	$result_project = dbQuery($sql_project);
  	
  	$i = 0;
  	
  while($row_project = dbFetchAssoc($result_project)) {  // get each project for this teamleader
 				extract($row_project);
   			$i++;		
   	?>
  <tr>
	 	<td><strong><?php echo "Project ".$i;?></strong></td>
	 	<td align="center"><?php echo $title."(".$company.")"; ?></td>
 	</tr>
   
    <?php
 		$sql_stu =  "SELECT s.Email as s_email, s.fullName, c.name as country, s.Semester, s.EnglishWrite, "
    . " s.EnglishListen, s.EnglishSpeak, s.Gender, s.University, s.Major, s.GPA "
    . " FROM tbl_students s, tbl_countries c"
    . " WHERE 1 and s.nationality = c.code and s.rank = 0 and Team = ".$pid;
		
		$result_stu = dbQuery($sql_stu);
	
	?>
	
	 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
	 	<tr align="center" id="listTableHeader"> 
	 		<td>Full Name</td>
	 		<td>Email</td>
	 		<td>Country</td>
	 		<td>Gender</td>
	 		<td>University</td>
			<td>Major</td>
	 		</tr>
	<?php
		while ($row_stu = dbFetchAssoc($result_stu)) {
				
			extract($row_stu);
   ?>
 
		<tr>
		  <td><?php echo $fullName; ?></td>
		  <td><a href="mailto:<?php echo $s_email; ?>"><?php echo $s_email; ?></a></td>
		  <td><?php echo $country; ?></td>
		  <td><?php echo $Gender; ?></td>
		  <td><?php echo $University; ?></td>
		  <td><?php echo $Major; ?></td>
		  
		</tr>

	
   
   
   <?php   
 		}
   ?>
  	</table> 
  
 <?php   
	}
 ?>

</div>