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

$csql = "SELECT cid, cname, ctype FROM tbl_categories 
		WHERE cname = 'SlowConsume' and cid  in (select cid from tbl_pairs)";
$cresult = dbQuery($csql);

$unsql = "Select unit from tbl_units";
$unresult = dbQuery($unsql);

?> 

<script language="javascript">
	function showType(id){
			$.get("ajaxPair.php",
			{id: id},
			function(data){
				$("div#type").html(data);
			},
			"html");
	}
	
	$(function() {
		$("input#txtDp").datepicker({dateFormat: 'yy-mm-dd'});
		$("input#txtDr").datepicker({dateFormat: 'yy-mm-dd'});
	});

</script>

<div class="prepend-1 span-12">
<p class="errorMessage"><?php echo $errorMessage; ?></p>

<form action="hardware/processHardware.php?action=add" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr align="center" id="listTableHeader"> 
   <td colspan="2">Add New Product </td>
   </tr>
   <tr>
    <td class="label">Category</td>
    <td class="content">
	<select name="txtCategory" id="txtCategory" onchange="showType(this.value);">
	<option value=""> --- Category --- </option>
	<?php
	while($row = dbFetchAssoc($cresult)) {
		extract($row);
	?>
	<option value="<?php echo $cid; ?>"><?php echo $cname. " -> ".$ctype; ?></option>
	<?php
	}
	?>
	</select>
	</td>
  </tr>
  
  <tr>
    <td class="label">Vendor Name </td>
    <td class="content">
	<div id="type"></div>
	<!--
	<select name="txtVname" id="txtVname" >
	<?php
	while($row = dbFetchAssoc($vresult)) {
		extract($row);
	?>
	<option value="<?php echo $id; ?>"><?php echo $vname; ?></option>
	<?php
	}
	?>
	</select>
	-->
	
	</td>
  </tr>
  <tr> 
   <td width="150" class="label"> Size</td>
   <td class="content"> <input name="txtQty" type="text" id="txtQty" value="" size="10" maxlength="10" onKeyUp="checkNumber(this);"> 
    </td>
  </tr>
  <tr>
    <td class="label">Unit </td>
	<td class="content"><select name="txtUnit" id="txtUnit" value="">
	<option value=""> --- Units --- </option>
	<?php
	$unrow = dbFetchAssoc($unresult);
	while($unrow = dbFetchAssoc($unresult)) {
		extract($unrow);
	?>
	<option value="<?php echo $unit;?>"><?php echo $unit; ?></option>
	<?php
	}
	?>
	</select></td>
	
	
  </tr>
  <tr>
    <td class="label"> Price </td>
    <td class="content"><input name="txtPrice" type="text" id="txtPrice" value="" size="10" maxlength="20" onKeyUp="checkNumber(this);"/>(Unit:$)
</td>
  </tr>
 
 </table>
 <p align="center"> 
  <input name="btnAddUser" type="button"   class="button" id="btnAddUser" value="Confirm Add (+)" onClick="checkHardwareForm();">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" class="button"  value=" Cancel " onClick="window.location.href='index.php';">  
 </p>
</form>

</div>