<link href="<?php echo WEB_ROOT; ?>css/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_ROOT; ?>css/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/jquery.min.js" language="javascript"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.ui.core.js" language="javascript"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.ui.datepicker.js" language="javascript"></script>
<?php
if (!defined('WEB_ROOT')) {
	exit;
}



$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';


$vsql = "Select id, vname from tbl_vendors";
$vresult = dbQuery($vsql);

$csql = "Select cid, ctype from tbl_categories
		Where cname = 'SlowConsume'";
$cresult = dbQuery($csql);


?> 

<div class="prepend-1 span-12">
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="assign/process.php?action=add" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr align="center" id="listTableHeader"> 
   <td colspan="2">Assign Category-Brand Pairs </td>
   </tr>
   
   <tr>
    <td width="150" class="label">Choose a Category </td>
    <td class="content" width="250">
	<select name="category" id="category" width="250">
	<option value=""> --- Category --- </option>
	<?php
	while($row = dbFetchAssoc($cresult)) {
		extract($row);
	?>
	<option value="<?php echo $cid; ?>"><?php echo $ctype; ?></option>
	<?php
	}
	?>
	</select>	</td>
  </tr>
  
  <tr> 
   <td width="150" class="label">Choose a Brand </td>
   <td class="content" width="250">
   <select name="vendor" id="vendor" width="250">
   <option value="">  ----- Vendor -----  </option>
		<?php
		while ($row = dbFetchAssoc($vresult)) {
		extract($row);
		?>
		<option value="<?php echo $id;?>"><?php echo $vname;?></option>
		<?php
		}
		?>		
	</select></td>
  </tr>

 
 </table>
 <p align="center"> 
  <input name="btnAddUser" type="button"   class="button" id="btnAddUser" value="Assign (+)"  onClick="checkAssignForm();">
  &nbsp;&nbsp;
  <input name="btnCancel" type="button" id="btnCancel" class="button"  value=" Cancel " onClick="window.location.href='index.php';">  
 </p>
</form>

</div>