<?php
if (!defined('WEB_ROOT')) {
	exit;
}



$changeMessage = (isset($_GET['info']) && $_GET['info'] != '') ? $_GET['info'] : '&nbsp;';


$sql = "SELECT c.cid as catid, c.ctype, i.level, i.pref, s.prio, h.price
		From tbl_categories c, tbl_inventory i, tbl_shoplist s, tbl_hardwares h
		Where s.cid = i.cid and c.cid = s.cid and s.cid = h.cid and h.id = i.pref";
		
$result = dbQuery($sql);

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


</p>

<form action="shoplist/processList.php?action=confirm" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">

 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Category</td>
   <td>Level</td>
   <td>Product</td>
   <td>Price</td>
  </tr>
<?php
$i=0;
$sumPrice=0;
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
   <td align="center"><?php
   
   $psql = "Select h.id as pid, qnty, unit, vname, price 
			From tbl_hardwares h, tbl_vendors v 
			Where h.vid = v.id and h.cid = $catid and h.id = $pref;";

	$presult = dbQuery($psql);

	while($prow = mysqli_fetch_assoc($presult)){
	extract($prow);
	echo "<option value=\"$pid\">".$vname." (".$qnty." ".$unit.")</option>";
	}
   
   
   
   ?></td>
   <td align="right">$<?php echo $price; $sumPrice = $sumPrice + $price;?></td>
  </tr>
<?php }?>
	<tr><td> </td></tr>
	<tr><td></td><td></td><td></td><td>Sum:<?php echo "$".$sumPrice;?></td></tr>

  <input name="total" value=<?php echo $sumPrice;?> hidden=true />
 </table> 
      <td colspan="1" align="right"><input name="btnBack" type="button" id="btnBack" value="Back" class="button" onClick="BacktoList()"></td>
	  <td colspan="1" align="right"><input name="btnSendOrder" type="button" id="btnSendOrder" value="Confirm Order" class="button" onClick="ConfirmOrder(<?php echo $sumPrice;?>)"></td>
 </form>

  <FONT COLOR="blue"><?php echo $changeMessage?></FONT><br>
<p>&nbsp;</p>
</div>

