<?php
include '../../core/config.php';
$code = $_GET['code'];
$nutri_id = 737;

initializeBaseCoefficient($nutri_id,$code);
initializeHeadCoefficient($nutri_id,$code);
initializeTableauFoot($nutri_id,$code);
$d = countVarNum($code,$nutri_id);
$c = countConstraint($nutri_id,$code);
//header("location:table_pivot_phase2.php?code=$code");
function countConstraint($nutri_id,$code){
	$count_min = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND min > 0"));
	$count_max = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND max > 0"));
	return $count_min[0] + $count_max[0] + 1;
}
function countRow($nutri_id,$code){
	$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_tableau_head` WHERE coefficient = 0 AND code='$code' AND nutri_id = $nutri_id"));
	return $fetch[0];
}
function countVarNum($code,$nutri_id){
	$count_ing = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND raw_id != 0"));
	$count_min = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND min > 0"));
	$count_max = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND max > 0"));
	return $count_ing[0] + $count_min[0] + $count_max[0];
}

function fetchTableuData($nutri_id,$code,$column,$row){
	$count = mysql_fetch_array(mysql_query("SELECT value FROM `tbl_formula_matrix_tableau` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = $column AND `row` = $row"));
	return $count[0] * 1;
}
function fetchHeadCoefficient($nutri_id,$code,$var){
	$count = mysql_fetch_array(mysql_query("SELECT coefficient FROM `tbl_formula_tableau_head` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `var` = '$var'"));
	return $count[0];
}
function fetchBaseVal($nutri_id,$code,$col,$val){
	$count = mysql_fetch_array(mysql_query("SELECT $val FROM `tbl_formula_tableau_base` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = '$col'"));
	return $count;
}
function fetchFootVal($nutri_id,$code,$row){
	$count = mysql_fetch_array(mysql_query("SELECT value FROM `tbl_formula_tableau_foot` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `row` = '$row'"));
	return $count[0] * 1;
}
function initializeHeadCoefficient($nutri_id,$code){
	$count_in = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_matrix_table` WHERE raw_id != 0 AND code='$code' AND nutri_id = $nutri_id"));
	for($i=1;$i <= $count_in[0];$i++){
		$cost = mysql_fetch_array(mysql_query("SELECT raw_cost FROM `tbl_formula_matrix_table` WHERE raw_order = $i AND code='$code' AND nutri_id = $nutri_id"));
		$cost_nega = $cost[0] * -1;
		//echo "$cost_nega = $cost[0]";
		mysql_query("UPDATE tbl_formula_tableau_head SET coefficient = '$cost_nega' WHERE var = $i AND code='$code' AND nutri_id = $nutri_id");
	}
}
function initializeBaseCoefficient($nutri_id,$code){
	$count_in = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_matrix_table` WHERE raw_id != 0 AND code='$code' AND nutri_id = $nutri_id"));
	for($i=1;$i <= $count_in[0];$i++){
		$cost = mysql_fetch_array(mysql_query("SELECT raw_cost FROM `tbl_formula_matrix_table` WHERE raw_order = $i AND code='$code' AND nutri_id = $nutri_id"));
		$cost_nega = $cost[0] / -1;
		//echo "$cost_nega = $cost[0]";
		mysql_query("UPDATE tbl_formula_tableau_base SET value = '$cost_nega' WHERE var = $i AND code='$code' AND nutri_id = $nutri_id");
	}
}
function initializeTableauFoot($nutri_id,$code){
	$con = countVarNum($code,$nutri_id) + 1;
	for($i = 1;$i <= $con;$i++){
		$sum_prod = mysql_fetch_array(mysql_query("SELECT SUM(b.value * t.value) FROM `tbl_formula_tableau_base` AS b,`tbl_formula_matrix_tableau` AS t WHERE t.column = b.column AND t.row = $i"));
		$cost = mysql_fetch_array(mysql_query("SELECT value FROM `tbl_formula_tableau_base` WHERE var = $i - 1 AND code='$code' AND nutri_id = $nutri_id"));
		$val = $sum_prod[0] - ($cost[0] * 1);
		//echo "$i,$val = $sum_prod[0] - $cost[0]<br>";
		saveIniTableauFoot($nutri_id,$code,$i,$val);
	}
}
function saveIniTableauFoot($nutri_id,$code,$row,$val){
	//echo "$row - $val <br>";
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_tableau_foot` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `row` = '$row'"));
	if($count[0] > 0){
		mysql_query("UPDATE `tbl_formula_tableau_foot` SET value = '$val' WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `row` = '$row'");
	}else{
		mysql_query("INSERT INTO `tbl_formula_tableau_foot` (`tableau_foot_id`, `nutri_id`, `code`, `row`, `value`) VALUES (NULL, '$nutri_id', '$code', '$row', '$val');");
	}
}
?>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
<br>
<center>
<div style='width:80%;height:400px;overflow-y: auto;'>
	<table id="customers" style='width:100%'>
	  <tr>
		<td width='10px'>Tableau 1</td>
		<td></td>
		<td></td>
	  <?php
	  $ini_d = 1;
	  while($ini_d <= $d){
	  ?>
		<td><?= fetchHeadCoefficient($nutri_id,$code,$ini_d) * 1;?></td>
	  <?php $ini_d++;} ?>
	  </tr>
	  <tr>
		<th>Base</th>
		<th>C<sub>b</sub></th>
		<th>P<sub>0</sub></th>
		<?php
		$ini_d = 1;
		while($ini_d <= $d){
		?>
		<th>P<sub><?= $ini_d; ?></sub></th>
		<?php $ini_d++;} ?>
	  </tr>
	  <?php
	  $ini_c = 1;
	  $column = 1;
	  while($ini_c <= $c){
		  $base = fetchBaseVal($nutri_id,$code,$column,"var,value");
	  ?>
	  <tr>
		<td>P<sub><?= $base[0];?></sub></td>
		<td><?= $base[1] * 1;?></td>
		<?php
		$ini_d = 0;
		while($ini_d <= $d){
			$ini_d++;
		?>
		<td><?= fetchTableuData($nutri_id,$code,$column,$ini_d); ?></td>
		<?php
		} ?>
	  </tr>
	  <?php
	  $ini_c++;
	  $column++;
	  }
	  ?>
	  <tr>
		<td style='background-color: #4CAF50;width:5px;'>Z</td>
		<td></td>
		<?php
		$ini_d = 0;
		while($ini_d <= $d){
		$ini_d++;
		?>
		<td><?= fetchFootVal($nutri_id,$code,$ini_d);?></td>
		<?php } ?>
	  </tr>
	</table>
</div>
<input type='button' onclick='window.location = "table_pivot_phase2.php?code=<?= $code; ?>"' value='Continue'>
<input type='button' onclick='window.location = "reset.php?code=<?= $code; ?>"' value='Clear'>
</center>