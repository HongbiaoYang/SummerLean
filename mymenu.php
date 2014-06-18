<div class="span-24">
   <div id="underlinemenu">
	<ul>
	<?php 
	$sql = "Select email, fullname from tbl_students
					Where stuIndex = ".$_SESSION["asset_user_id"];
	
	$result = dbQuery($sql);
	$row = dbFetchAssoc($result);
	extract($row);
					
	?>
		<li><a href="<?php echo WEB_ROOT; ?>" title="Home">Home</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>menu.php?v=USER" title="Choose Project">Choose Projects</a></li>
	
		<li><a href="<?php echo WEB_ROOT; ?>" title="Home"><?php echo  "Welcome, ".$fullname;?></a></li>

		

	</ul>
	</div>
</div>