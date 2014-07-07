<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql0 = "SELECT u.uid, u.uname, u.email, u.fname, u.lname
	FROM tbl_users u
	WHERE u.uid = ".$_SESSION['asset_user_id'].
	" ORDER BY uname;";

$sql =	"SELECT `t`.`FirstName` as t_first , `t`.`LastName` as t_last, "
				."`t`.`Email` as t_email, `t`.`Biography` as bio, `Pic`, s.StuIndex, s.Email as s_email, "
				." s.FirstName as s_first, s.netid, s.LastName as s_last, s.LastName2 as s_last2, "
				." s.MiddleName as s_middle, s.fullName as s_full, n.name as country, "
				." p.title as title, c.CompanyName as company "
		    ."FROM `tbl_teamleaders` `t` , `tbl_students` `s` , `tbl_projects` `p` , `tbl_companies` `c`, `tbl_countries` `n` "
		    ."WHERE 1\n"
		    ."AND t.LeaderIndex = c.teamleader and p.Comindex = c.ComIndex "
		    ."and n.code = s.nationality and s.Team = p.projIndex and s.StuIndex = "
     		.$_SESSION['asset_user_id'];




?> 
<div class="prepend-1 span-17">
<p>&nbsp;</p>
<h2 class="catHead">Projects Information</h2>
<p><img src="images/ico_projects.png" class="left" width="72"/>
	<p class="errorMessage"><?php echo $errorMessage; ?></p>
<strong>This page shows the projects selection information</strong>
<br/>

<?php 
	
		$result = dbQuery($sql);
		$row = dbFetchAssoc($result);
		extract($row);

		echo "Your projetcs and team leader information is as below:"?>




 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td><?php echo "Project Information";
   	?></td>
    </tr>

  <tr class="<?php echo $class; ?>"> 
  <td><?php echo "Full Name:";?></td>
   <td><?php 
   		echo ucfirst($s_first);
   		if ($s_middle) echo " ".$s_middle; 
   		echo " ".$s_last; 
   		if ($s_last2)  echo " ".$s_last2;
	  ?>
   	</td>
 </tr>
 
 <tr>
 	<td><?php echo "Email:";?></td>
 	<td align="center"><a href="mailto:<?php echo $s_email; ?>"><?php echo $s_email; ?></a></td>
 	</tr>

  <tr>
 	<td><?php echo "Country:";?></td>
 	<td align="center"><?php echo $country; ?></td>
 	</tr>


<tr>
 	<td><?php echo "Name on Certificate:";?></td>
 	<td align="center"><?php echo $s_full; ?></td>
 	</tr>
 	
 	<tr>
 	<td>Your <a target="_blank" href="https://oit.utk.edu/accounts/net-id/" >NetID</a>:</td>  
 	<td align="center"><?php echo $netid; ?>  (<a target="_blank" href="https://directory.utk.edu/setup">Setup Password</a>)</td>
 	</tr>

	<tr> <td colspan=2><hr></td></tr>
	<td>Project</td>
 	 	<td align="center"><?php echo $title; ?></td>
 	</tr>
 	
 	<td>Company</td>
 	 	<td align="center"><?php echo $company; ?></td>
 	</tr>
	
	<tr> <td colspan=2><hr></td></tr>
 	<tr> <td>Online Session:</td><td><a target="_blank" href="https://bblearn.utk.edu/webapps/bb-collaborate-BBLEARN/launchSession/guest?uid=503f664d-5543-447d-9035-420d4bb01294">https://bblearn.utk.edu/webapps/bb-collaborate-BBLEARN/launchSession/guest?uid=503f664d-5543-447d-9035-420d4bb01294</a></td></tr>
 	<tr> <td>System Requirements</td><td>Click <a target="_blank" href="https://oit.utk.edu/instructional/tools/liveonline/Pages/Collaborate-Requirements.aspx">HERE</a> to see if your computer meets the system requirements</td></tr>
 	<tr> <td colspan=2><hr></td></tr>
 	
 	<tr>
	<td><?php echo "Team Leader:";?></td>
 	 	<td align="center"><?php echo $t_first." ".$t_last; ?></td>
 	</tr>
 	
 	<tr>
 	<td><?php echo "Email:";?></td>
 	<td align="center"><a href="mailto:<?php echo $t_email; ?>"><?php echo $t_email; ?></a></td>
 	</tr>

	 <tr>
 	<td><?php echo "Biography:";?></td>
 	<td align="center"><?php echo $bio; ?></td>
 	</tr>
 	
  	<tr>
 	<td><?php echo "Profile:";?></td>
 	
 	<td align="center"><img src="images/teamleader/<?php echo $Pic?>" class="left" height="240"/></td>
 	</tr>
 	
 	
 	

  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
  	<?php //if ($_SESSION["asset_user_type"] >= 1)
   			//echo '<td colspan="5" align="right"><input name="btnAddUser" type="button" id="btnAddUser" value="Choose Your Projects"  class="button" onClick="addUser()"></td>';
  	?>
  </tr>
 </table>
 <p>&nbsp;</p>
</div>
