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
				." s.FirstName as s_first, s.netid, s.tnid, s.LastName as s_last, s.LastName2 as s_last2, "
				." s.MiddleName as s_middle, s.fullName as s_full, r.trip_amazon, r.trip_toyota, r.trip_vw, "
				." r.trip_aqua, r.trip_neyland, n.name as country, "
				." p.title as title, c.CompanyName as company "
		    ." FROM `tbl_teamleaders` `t` , `tbl_students` `s` , `tbl_projects` `p` ,  "
		    ." tbl_trips r, `tbl_companies` `c`, `tbl_countries` `n` "
		    ."WHERE 1\n"
		    ."AND t.LeaderIndex = c.teamleader and p.Comindex = c.ComIndex and r.stuindex = s.stuindex "
		    ."and n.code = s.nationality and s.Team = p.projIndex and s.StuIndex = "
     		.$_SESSION['asset_user_id'];


$amazon = array(
		0 => "TBD",
		11 => "Trip 1a, leaves at 7:30 AM, July 21, Driver: Kaveri",
		12 => "Trip 1b, leaves at 7:30 AM, July 21, Driver: Ali",
		13 => "Trip 1c, leaves at 7:30 AM, July 21, Driver: Girish",
		14 => "Trip 1d, leaves at 7:30 AM, July 21, Driver: Dhanush",
		21 => "Trip 2a, leaves at 7:30 AM, July 28, Driver: Enrique",
		22 => "Trip 2b, leaves at 7:30 AM, July 28, Driver: Ryan",
		31 => "Trip 3a, leaves at 10:30 AM, July 28, Driver: Abhishek",
		32 => "Trip 3b, leaves at 10:30 AM, July 28, Driver: Vahid",
		33 => "Trip 3c, leaves at 10:30 AM, July 28, Driver: Dinesh",
		41 => "Trip 4a, leaves at 12:30 AM, July 28, Driver: Bharadwaj",
		42 => "Trip 4b, leaves at 12:30 AM, July 28, Driver: MohammedAli",
		43 => "Trip 4c, leaves at 12:30 AM, July 28, Driver: Jason",
);

$toyota = array(
		0 => "TBD",
    1 => "Trip 1, leaves at 7 AM, July 11",
    2 => "Trip 2, leaves at 9 AM, July 11",
);


$vw = array(
		0 => "TBD",
		11 => "Trip 1a, leaves at 6:30 AM, July 21, Driver: Mostafa",
		12 => "Trip 1b, leaves at 6:30 AM, July 21, Driver: Enrique",
		2  => "Trip 2, leaves at 9:00 AM, July 21, Driver: MohammedAli",
		31 => "Trip 3a, leaves at 11:00 AM, July 21, Driver: Ryan",
		32 => "Trip 3b, leaves at 11:00 AM, July 21, Driver: Dinesh",
		41 => "Trip 4a, leaves at 6:30 AM, July 28, Driver: Vahid",
		42 => "Trip 4b, leaves at 6:30 AM, July 28, Driver: Abhishek",
		51 => "Trip 5a, leaves at 9:00 AM, July 28, Driver: Ali",
		52 => "Trip 5b, leaves at 9:00 AM, July 28, Driver: Jason",
    61 => "Trip 6a, leaves at 11:00 AM, July 28, Driver: Wolday",
    62 => "Trip 6b, leaves at 11:00 AM, July 28, Driver: Dhanush",
    63 => "Trip 6c, leaves at 11:00 AM, July 28, Driver: Ninad",
);

$aquarium = array(
		0 => "TBD",
);

$neyland = array(
		0 => "TBD",
);



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
  <td width=148><?php echo "Full Name:";?></td>
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
 	<td align="center"><?php echo $s_full."  "; ?><u><a href="menu.php?v=RENAME">Modify</a></u></td>
 	</tr>
 	
 	<tr>
 	<td><a target="_blank" href="https://oit.utk.edu/accounts/net-id/" >NetID</a>:</td>  
 	<td align="center"><?php echo $netid; ?>  (<a target="_blank" href="https://directory.utk.edu/setup">Setup Password</a>)</td>
 	</tr>

	<tr>
	<td>TNID:</td>
	<td><?php echo $tnid; ?></td>
	
	</tr>

	<tr> <td colspan=2><hr></td></tr>
	<td>Project</td>
 	 	<td align="center"><?php echo $title; ?></td>
 	</tr>
 	
 	<td>Company</td>
 	 	<td align="center"><?php echo $company; ?></td>
 	</tr>
	 	
	 	<tr> <td colspan=2><hr></td></tr>
	 	
	 	
	<td>Trip Toyota:</td>
 	 	<td align="center"><?php 
 	 		echo $toyota[$trip_toyota];
 	 		?></td>
 	</tr>
 		
	<td>Trip Amazon:</td>
 	 	<td align="center"><?php 
 	 		echo $amazon[$trip_amazon];
 	 		?></td>
 	</tr>
 	
	<td>Trip Volkswagen:</td>
 	 	<td align="center"><?php 
 	 		echo $vw[$trip_vw];
 	 		?></td>
 	</tr>
 	
	<td>Trip Aquarium:</td>
 	 	<td align="center"><?php 
 	 		echo $aquarium[$trip_aqua];
 	 		?></td>
 	</tr>
 	
	<td>Trip Neyland Stadium:</td>
 	 	<td align="center"><?php 
 	 		echo $neyland[$trip_neyland];
 	 		?></td>
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
