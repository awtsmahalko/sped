<?php
include '../../core/config.php';
$code = $_GET['code'];
$nutri_id = $_SESSION['system']['userid'];
$d = countVarNum($code,$nutri_id);
$c = countConstraint($nutri_id,$code);
$counter = mysql_fetch_array(mysql_query("SELECT COUNT(row) FROM `tbl_formula_tableau_foot` WHERE nutri_id = $nutri_id AND code = '$code' AND `value` < 0 AND (row > 1 AND row <= $d) ORDER BY `value` ASC"));
if($counter[0] > 0){
	getPivotRow($code,$nutri_id);
	convertToZero($code,$nutri_id);
	initializeBaseCoefficient($nutri_id,$code,$_SESSION['column'],$_SESSION['pivot'] - 1,0);
	//header("Refresh:0");
}else{
	
	mysql_query("UPDATE tbl_formula_company_matrix SET status = 'F' WHERE code='$code' AND nutri_id = $nutri_id");
	$count_in = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_matrix_table` WHERE raw_id != 0 AND code='$code' AND nutri_id = $nutri_id"));
	for($i=1;$i <= $count_in[0];$i++){
		$qty = mysql_fetch_array(mysql_query("SELECT (t.value * 100) FROM `tbl_formula_matrix_tableau` AS t, `tbl_formula_tableau_base` AS b WHERE b.column = t.column AND t.row = 1 AND (t.nutri_id = $nutri_id AND b.nutri_id = $nutri_id) AND (t.code='$code' AND b.code='$code') AND b.var = $i"));

		echo "P<sub>$i</sub> = $qty[0] <br>";
		mysql_query("UPDATE tbl_formula_matrix_table SET raw_qty = '$qty[0]' WHERE raw_order = $i AND code='$code' AND nutri_id = $nutri_id");
	}
}

function getPivotRow($code,$nutri_id){
	$row_limit = countVarNum($code,$nutri_id);
	$fetch = mysql_fetch_array(mysql_query("SELECT row,value FROM `tbl_formula_tableau_foot` WHERE nutri_id = $nutri_id AND code = '$code' AND `value` < 0 AND (row > 1 AND row <= $row_limit) ORDER BY `value` ASC LIMIT 1"));
	$row = $fetch[0];
	$_SESSION['pivot'] = $row;
	$_SESSION['pivot-z'] = $fetch[1];
	$fetch_pivot = mysql_fetch_array(mysql_query("SELECT a.column,a.value,(b.value / a.value) as value_new FROM `tbl_formula_matrix_tableau` as a, `tbl_formula_matrix_tableau` AS b WHERE a.nutri_id = $nutri_id AND a.code = '$code' AND a.row = $row AND b.row = 1 AND a.column = b.column AND (b.value > 0 AND a.value > 0) ORDER BY value_new ASC LIMIT 1"));

	$column = $fetch_pivot['column'];
	$_SESSION['column'] = $column;
		$content.="Pivot row (Row $column)<br>";
		for($j = 1;$j <= $row_limit + 1 ; $j++){
			$trans = mysql_fetch_array(mysql_query("SELECT `value` FROM `tbl_formula_matrix_tableau` WHERE nutri_id = $nutri_id AND code = '$code' AND `column` = $column AND row = $j"));
			$value = $trans[0] * 1;
			$_SESSION['val'][$j] = 0;
			if($value != 0){
				$val = $value / $fetch_pivot['value'];
				if($val == 0){
					$new_val = 0;
				}else{
					$new_val = new_number_format($val,15);
				}
				$content .= "$value / ".$fetch_pivot['value']." = $new_val <br>";
				$_SESSION['val'][$j] = $new_val;
				transformPivot($code,$nutri_id,$column,$j,$new_val);
			}
		}
	echo $content;
}
function transformPivot($code,$nutri_id,$column,$row,$val){
	//echo "P<sub>$column</sub>,P<sub>$row</sub>, ==> $val <br>";
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_matrix_tableau` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = $column AND `row` = $row"));
	if($count[0] > 0){
		mysql_query("UPDATE tbl_formula_matrix_tableau SET value = '$val' WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = $column AND `row` = $row");
	}else{
		//echo "P<sub>$column</sub>,P<sub>$row</sub>, ==> $val <br>";
		mysql_query("INSERT INTO tbl_formula_matrix_tableau (`tableau_id`,`nutri_id`,`code`,`column`,`row`,`value`,`tag`,`status`) VALUES (NULL,'$nutri_id','$code','$column','$row','$val','added','')");
	}
}
function convertToZero($code,$nutri_id){
	$column = countConstraint($nutri_id,$code);
	$pivot = $_SESSION['pivot'];
	for($i = 1;$i <= $column ; $i++){
		if($_SESSION['column'] != $i){
			$content.= "Row $i <br>";
			$fetch_key = mysql_fetch_array(mysql_query("SELECT value FROM `tbl_formula_matrix_tableau` WHERE code='$code' AND nutri_id='$nutri_id' AND `column` = $i AND `row` = $pivot"));
			$key = $fetch_key[0] * 1;
			if($key != 0){
				$row_limit = countVarNum($code,$nutri_id) + 1;
				for($j = 1;$j <= $row_limit ; $j++){
					$fetch_val = mysql_fetch_array(mysql_query("SELECT value,status FROM `tbl_formula_matrix_tableau` WHERE code='$code' AND nutri_id='$nutri_id' AND `column` = $i AND `row` = $j"));
						$old_val = $fetch_val[0] * 1;
						if($_SESSION['val'][$j] != 0){
							$new_val = $old_val - ($key * $_SESSION['val'][$j]);
							transformPivot($code,$nutri_id,$i,$j,$new_val);
							$content.= "$old_val - ($key * ".$_SESSION['val'][$j].") = $new_val<br>";
						}else{
							$content.= "$old_val - ($key * ".$_SESSION['val'][$j].") = $old_val Y<br>";
						}
				}
				$content.= "<br>";
			}
		}
	}
	$content.= "Roz Z<br>";
	$pivot_z = $_SESSION['pivot-z'];
	$row_limit = countVarNum($code,$nutri_id) + 1;
	for($j = 1;$j <= $row_limit ; $j++){
		$fetch_val = mysql_fetch_array(mysql_query("SELECT value,status FROM `tbl_formula_tableau_foot` WHERE `nutri_id` = $nutri_id AND code = '$code' AND `row` = $j"));
		//if($fetch_val[1] != 'DONE'){
			$old_val = $fetch_val[0] * 1;
			if($_SESSION['val'][$j] != 0){
				$new_val = $old_val - ($pivot_z * $_SESSION['val'][$j]);
				saveIniTableauFoot($nutri_id,$code,$j,$new_val);
				$content.= "$old_val - ($pivot_z * ".$_SESSION['val'][$j].") = $new_val<br>";
			}else{
				$content.= "$old_val - ($pivot_z * ".$_SESSION['val'][$j].") = $old_val Y<br>";
			}
		//}
	}
	echo $content;
}


function countConstraint($nutri_id,$code){
	$count_min = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND min > 0"));
	$count_max = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id AND max > 0"));
	return $count_min[0] + $count_max[0] + 1;
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
function initializeBaseCoefficient($nutri_id,$code,$column,$row,$val){
	//echo "$nutri_id,$code,$column,$row,$val";
	$value = mysql_fetch_array(mysql_query("SELECT coefficient FROM `tbl_formula_tableau_head` WHERE code = '$code' AND var = '$row'"));
	//echo "$nutri_id,$code,$column,$row,$val";
	$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `tbl_formula_tableau_base` WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = '$column'"));
	if($count[0] > 0){
		mysql_query("UPDATE `tbl_formula_tableau_base` SET value='$value[0]',var = '$row' WHERE nutri_id = '$nutri_id' AND `code` = '$code' AND `column` = '$column'");
	}else{
		mysql_query("INSERT INTO `tbl_formula_tableau_base` (`tableau_base_id`, `nutri_id`, `code`, `column`, `var`, `value`) VALUES (NULL, '$nutri_id', '$code', '$column', '$row', '$value[0]')");
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