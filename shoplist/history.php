<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$changeMessage = (isset($_GET['info']) && $_GET['info'] != '') ? $_GET['info'] : '&nbsp;';


$sql = "Select ctype, pid, pdate, pdesc
		From tbl_categories c, tbl_history h 
		Where h.cid=c.cid order by pdate desc";
		
$result = dbQuery($sql);

$total = mysqli_num_rows($result);

if(!isset($_GET["page"])) //是否获得GET参数
{
	$thispage = 1; //未获得即为第1页
}
else
{
	$thispage = $_GET["page"];
}

$perpage = 15; //每页显示记录数
$limit = $perpage*($thispage-1); //本页记录数起始位置

?> 


<div class="prepend-1 span-17">
<table>
<tr>
<td>
<strong>Products You Have Purchased Before</strong>
<br>
The historical list of grocery products you have already purchased before
</td>
<td>
<p><img src="<?php echo WEB_ROOT; ?>images/order-icon.png" class="right"/>
</td>
</tr>
</table>

<?php


$sql = "Select hid, ctype, pid, pdate, pdesc
		From tbl_categories c, tbl_history h 
		Where h.cid=c.cid order by pdate desc limit ".$limit.",".$perpage;
		
$result = dbQuery($sql);

?>

 <table  border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Category</td>
   <td>Product</td>
   <td>Purchase Time</td>
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
   <td align="center"><?php echo $pdesc; ?></td>     
   <td align="center"><?php echo $pdate; ?></td>
  </tr>
  <?php 
  } // end of while
  ?>
  <tr> 
   <td colspan="3">&nbsp;</td>
  </tr>
 </table> 

	 <tr><td colspan = "3"><?php page($total, $perpage, $thispage,"?v=HISTORYORDER&page=");?></td></tr>
	 <br>
     <tr><td colspan="1" align="right"><input name="btnSendOrder" type="button" id="btnSendOrder" value="Back" class="button" onClick="BacktoList()"></td></tr>

 
  <FONT COLOR="blue"><?php echo $changeMessage?></FONT><br>
<p>&nbsp;</p>
</div>

