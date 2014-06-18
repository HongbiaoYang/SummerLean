<div class="span-24">
   <div id="underlinemenu">
	<ul>
<<<<<<< HEAD
	<li><a href="<?php echo WEB_ROOT; ?>" title="Home">Home</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>menu.php?v=USER" title="Choose Project">Choose Projects</a></li>
	
=======
	<?php 
	$fullname = 'Guest';
	$sql = "Select email, fullname from tbl_students
					Where stuIndex = ".$_SESSION["asset_user_id"];
	
	$result = dbQuery($sql);
	if ($result)
	{
		$row = dbFetchAssoc($result);
		extract($row);
	}
				
	?>
		<li><a href="<?php echo WEB_ROOT; ?>" title="Home">Home</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>menu.php?v=USER" title="Choose Project">Choose Projects</a></li>
		<li><a href="<?php echo WEB_ROOT; ?>" title="Home"><?php echo  "Welcome, ".$fullname;?></a></li>
>>>>>>> 3c8ce8b4e69bf2e8fc056bdbcccd9040632bda0d

		

	</ul>
	</div>
</div>
