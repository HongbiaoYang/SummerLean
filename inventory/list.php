<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$changeMessage = (isset($_GET['info']) && $_GET['info'] != '') ? $_GET['info'] : '&nbsp;';


$sql = "SELECT c.ctype, i.level, i.unit from tbl_categories c, tbl_inventory i
		Where i.cid=c.cid";
		
$result = dbQuery($sql);

?> 



<table>
<tr>
<td width=40%></td><td width=40%></td><td>
<input name="btnConsume" type="button" id="btnConsume" align="right" value="Batch Consume (*)" class="button" onclick="BatchConsume();">
</td>
</tr>
</table>

<div class="prepend-1 span-17">
<p><img src="<?php echo WEB_ROOT; ?>images/slowConsume.png" class="left"/>
<strong>Current Inventory Status</strong>
<br/>
Displays all the inventory level for each category of products, check when a replenish is required

</p>

 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Product</td>
   <td>Level</td>

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
   <td align="center"><?php
	
	if ($level <= 50)
	{
		echo "<font color=\"red\">".$level."g</font> ";
	}
    else
    {
	    echo $level."g";
    }
   ?></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="3">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="1" align="right"><input name="btnReplenish" type="button" id="btnReplenish" value="Replenish (+)" class="button" onClick="Replenish()"></td>
	<td colspan="1" align="right"><input name="btnConsume" type="button" id="btnConsume" value="Consume (-)" class="button" onClick="Consume()"></td>	
  </tr>
 </table> 
 

  <FONT COLOR="blue"><?php echo $changeMessage?></FONT><br>
<p>&nbsp;</p>
</div>

