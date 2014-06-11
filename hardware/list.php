<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$sql = "SELECT h.id, h.qnty, h.unit,h.price,  v.vname as vname, v.thumb AS thumb, c.cname AS cname, c.ctype AS ctype, h.price
        FROM tbl_hardwares h, tbl_categories c, tbl_vendors v
		WHERE h.vid = v.id AND h.cid = c.cid";
		
$result = dbQuery($sql);

?> 
<div class="prepend-1 span-17">
<p>&nbsp;</p>
<p><img src="<?php echo WEB_ROOT; ?>images/slowConsume.png" class="left"/>
<strong>A complete List of Products.</strong>
<br/>
It essentially supplies a list of users defined in the system. The user names are linked to a page where you can change the user's name, you can also reset their passwords through this page.

</p>

<p align="left"> 
 <input name="btnAddProd" type="button"   class="button" id="btnAddProd" value="Add New Product (+)" onClick="addHardware();">
 </p>

<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">
 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Product</td>
   <td>Size</td>
   <td>Unit</td>
   <td>Price</td>
   <td>Vendor</td>
   <td>Delete</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	if($thumb) {$img = WEB_ROOT . "images/vendors/".$thumb;}
	else {$img = "images/no-image-small.png";} 
	$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $ctype; ?></td>
   <td align="center"><?php echo $qnty; ?></td>
   <td align="center"><?php echo $unit; ?></td>
   <td align="center"><?php echo $price;?></td>
   <td align="center">
   <img src="<?php echo $img;?>" title="<?php echo $vname; ?>" /></td>
   <td align="center"><a href="javascript:deleteHw(<?php echo $id; ?>);">Delete</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddUser" type="button" id="btnAddUser" value="Add New Product (+)" class="button" onClick="addHardware()"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
</div>