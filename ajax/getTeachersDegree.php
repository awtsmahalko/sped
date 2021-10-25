<?php
include '../core/config.php';

$t_id = $_POST['id'];

$query = mysql_query("SELECT * FROM tbl_degree WHERE t_id = $t_id");
if(mysql_num_rows($query) > 0){
	while ($row = mysql_fetch_array($query)) {
?>
	<tr>
		<td><input type="checkbox" name="record"></td>
		<td contenteditable="true"><?=$row['degree_name']?></td>
		<td contenteditable="true"><?=$row['course']?></td>
		<td contenteditable="true"><?=$row['school']?></td>
		<td contenteditable="true"><?=$row['year_grad']?></td>
	</tr>
<?php } }else{ ?>
	<tr>
		<td></td>
		<td contenteditable="true">Bachelor</td>
		<td contenteditable="true"></td>
		<td contenteditable="true"></td>
		<td contenteditable="true"></td>
	</tr>
<?php } ?>