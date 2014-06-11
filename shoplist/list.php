<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$changeMessage = (isset($_GET['info']) && $_GET['info'] != '') ? $_GET['info'] : '&nbsp;';


$sql = "SELECT c.cid as catid, c.ctype, i.level, i.pref, s.prio 
		From tbl_categories c, tbl_inventory i, tbl_shoplist s
		Where c.cid = i.cid and c.cid = s.cid";
		
$result = dbQuery($sql);
if (dbNumRows($result) > 0) 
{
	$isEmpty = 0;
}
else
{
	$isEmpty = 1;
}

?> 


<div class="prepend-1 span-17">
<table>
<tr>
<td>
<strong>Products You Need to Buy Next</strong>
<br>
The list of grocery products you need to replenish in your next shoppoing trip
</td>
<td>
<p><img src="<?php echo WEB_ROOT; ?>images/order-icon.png" class="right"/>
</td>
</tr>
</table>


<form action="shoplist/processList.php?action=order" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">

 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Category</td>
   <td>Level</td>
   <td>Product</td>
   <td>Priority</td>
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
   <td><?php echo $ctype; ?></td>
   <td align="center"><?php echo $level; ?> g</td>
   
   <td align="center" class="content">
	<select name="txtProduct[]" id="txtProduct">
	
	<?php 
	
	$psql = "Select h.id as pid, qnty, unit, vname, price 		
			From tbl_hardwares h, tbl_vendors		
			Where h.vid = tbl_vendors.id and cid=$catid order by pid=$pref desc";


	$presult = dbQuery($psql);	
	
	while($prow = mysqli_fetch_assoc($presult)){
	extract($prow);
	echo "<option value=\"$pid\">".$vname.", (".$qnty." ".$unit.",".$price."$)</option>";
	}
	
	?>
	
	</select>   
   </td>
   
   <td align="center"><?php echo $prio; ?></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 


  </tr>
 </table> 
     <td colspan="1" align="right"><input name="btnSendOrder" type="button" id="btnSendOrder" value="Send Order" class="button" onClick="SendOrder(<?php echo $isEmpty;?>)"></td>
	 <td colspan="1" align="right"><input name="btnHisOrder" type="button" id="btnHisOrder" value="History Order" class="button" onClick="HistoryOrder()"></td>
 
</form>
  <FONT COLOR="blue"><?php echo $changeMessage?></FONT><br>
<p>&nbsp;</p>
</div>

