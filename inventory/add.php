<link href="<?php echo WEB_ROOT; ?>css/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" />
<link href="<?php echo WEB_ROOT; ?>css/jquery.ui.theme.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/jquery.min.js" language="javascript"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.ui.core.js" language="javascript"></script>
<script src="<?php echo WEB_ROOT; ?>library/jquery.ui.datepicker.js" language="javascript"></script>
<script language="javascript">
/*	$(function() {
		$("input#txtDp").datepicker({dateFormat: 'yy-mm-dd'});
	});
*/
</script>

<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

$sql = "SELECT id, room_name, floor, building FROM tbl_depts";
$result = dbQuery($sql);

$vsql = "SELECT id, vname FROM tbl_vendors";
$vresult = dbQuery($vsql);

$csql = "SELECT distinct tbl_hardwares.cid as catid, ctype FROM tbl_categories, tbl_hardwares
		WHERE tbl_hardwares.cid = tbl_categories.cid";
$cresult = dbQuery($csql);


?> 

<script language="javascript">
	function showVendor(id){
		// alert('id='+id);
		if (id == "addnew")
		{
			// alert('add new');
			self.location='view.php?v=assign';
			return;
		}
	
		$.get("ajaxProd.php",
			{id: id},
			function(data){
				$("div#type").html(data);
			},
			"html");
	}

</script>

<div class="prepend-1 span-12">
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="inventory/processInventory.php?action=add" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr align="center" id="listTableHeader"> 
   <td colspan="2">Replenish Your Product</td>
   </tr>
   <tr>
    <td class="label">Category</td>
    <td class="content">
	<select name="txtCategory" id="txtCategory" onchange="showVendor(this.value);">
	<option value=""> --- Category --- </option>
	<?php
	while($row = dbFetchAssoc($cresult)) {
		extract($row);
	
	$lvsql = "Select level, unit from tbl_inventory where cid = $catid";
	$lvresult = dbQuery($lvsql);
	$lvrow=dbFetchAssoc($lvresult);
	if ($lvrow)
	{
		extract($lvrow);
	}
	else
	{
		$level = 0;
		$unit = "";
	}
	
	?>
	<option value="<?php echo $catid; ?>"><?php echo $ctype."(Remain:".$level." ".$unit.")"; ?></option>
	<?php
	}
	?>
	<option value="addnew">Add New Product</option>
	</select>
	</td>
  </tr>
  
  <tr>
    <td class="label">Product</td>
    <td class="content">
	<div id="type"></div>	
	</td>
  </tr>
  <tr> 
   
 </table>
 <p align="center"> 
  <input name="btnAddUser" type="button"   class="button" id="btnAddUser" value="Replenish this Product (+)" onClick="checkInventory();">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" class="button"  value=" Cancel " onClick="window.location.href='menu.php?v=INVR';">  
 </p>
</form>
</div>