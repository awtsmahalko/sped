<?php
include '../core/config.php';
$code = $_GET['code'];
$view = $_GET['view'];
if($view == 'nutri'){
	$nutri_id = $_SESSION['system']['userid'];
}else{
	$nutri_id = PHILSAN;
}

$content = "";
$count = 1;
$fetch = mysql_query("SELECT n.nut_id,n.nut_name,mt.min,mt.max FROM tbl_formula_matrix_table AS mt,tbl_formula_nutrients AS n WHERE mt.nut_id = n.nut_id AND mt.code = '$code' ORDER BY n.nut_order = 0, n.nut_order");
//$fetch = mysql_query("SELECT * FROM tbl_formula_nutrients WHERE nutri_id = $nutri_id ORDER BY nut_name ASC");
while($row = mysql_fetch_array($fetch)){
	//$nut_matrix = mysql_fetch_array(mysql_query("SELECT min,max FROM tbl_formula_matrix_table WHERE nut_id = $row[0] AND code = '$code'"));
	$checkbox = "<input type='checkbox' class='nut-data' value='".$row['nut_id']."'>";
	$style = "vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 16px;";
	$textst = "display: block;width: 100%;height: 30px; padding: 3px 8px;font-size: 16px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;";
	$content .="
		<tr>
			<th style='$style padding-left:5px;width:5%;'>$checkbox</th>
			<th style='$style padding-left:5px;width:5%;'>$count</th>
			<th style='$style padding-left:5px;width:30%;'>".$row['nut_name']."</th>
			<th style='$style padding-left:5px;width:20%;'>".getNutInclusion($code,$nutri_id,$row['nut_id'],$row['min'],$row['max'])."</th>
			<th style='$style width: 15%;'>
				<input type='number' min='0' id='nut_min_".$row['nut_id']."' style='$textst' value='".($row['min'] * 1)."' step='.001' onchange='updateNutMin(\"$code\",".$row['nut_id'].")'>
			</th>
			<th style='$style width: 15%;'>
				<input type='number' min='0' id='nut_max_".$row['nut_id']."' style='$textst' value='".($row['max'] * 1)."' step='.001' onchange='updateNutMax(\"$code\",".$row['nut_id'].")'>
			</th>
		</tr>
	";
$count++;
}
echo $content;
function getNutInclusion($code,$nutri_id,$nut_id,$min,$max){
	$sum_raw = matrixTotalRaw($code,$nutri_id);
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(rs.qty * mt.raw_qty) / $sum_raw FROM `tbl_formula_raw_specs` AS rs, `tbl_formula_matrix_table` AS mt WHERE mt.nutri_id=$nutri_id AND mt.raw_id = rs.raw_id AND rs.nut_id = $nut_id AND rs.nutri_id = $nutri_id AND mt.code = '$code'"));
	return checkError($min,$max,$fetch[0]);
}
function matrixTotalRaw($code,$nutri_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(raw_qty) FROM tbl_formula_matrix_table WHERE code='$code' AND nutri_id = $nutri_id"));
	return $fetch[0];
}
function checkError($min,$max,$val){
$min = new_number_format($min,4);
$max = new_number_format($max,4);
$val = new_number_format($val,4);
	if($val == "0.0000"){
		return "";
	}else{
		if(($min > 0) && ($max > 0)){
			if($val <= $min){
				$data = "<span class='fa fa-arrow-circle-o-down' style='color: #08841e;font-size: 28px;'></span>";
				if($val < $min){
					$data .= "<span style='color:red;float:right;font-size: 18px;'>$val</span>";
				}else{
					$data .= "<span style='float:right;font-size: 18px;'>$val</span>";
				}
			}else if($val >= $max){
				$data = "<span class='fa fa-arrow-circle-o-up' style='color: red;font-size: 28px;'></span>";
				if($val > $max){
					$data .= "<span style='color:red;float:right;font-size: 18px;'>$val</span>";
				}else{
					$data .= "<span style='float:right;font-size: 18px;'>$val</span>";
				}
			}else{
				$data = "<span style='float:right;font-size: 18px;'>$val</span>";
			}
		}else if($min > 0){
			if($val <= $min){
				$data = "<span class='fa fa-arrow-circle-o-down' style='color: #08841e;font-size: 28px;'></span>";
				if($val < $min){
					$data .= "<span style='color:red;float:right;font-size: 18px;'>$val</span>";
				}else{
					$data .= "<span style='float:right;font-size: 18px;'>$val</span>";
				}
			}else{
				$data = "<span style='float:right;font-size: 18px;'>$val</span>";
			}
		}else if($max > 0){
			if($val >= $max){
				$data = "<span class='fa fa-arrow-circle-o-up' style='color: red;font-size: 28px;'></span>";
				if($val > $max){
					$data .= "<span style='color:red;float:right;font-size: 18px;'>$val</span>";
				}else{
					$data .= "<span style='float:right;font-size: 18px;'>$val</span>";
				}
			}else{
				$data = "<span style='float:right;font-size: 18px;'>$val</span>";
			}
		}else{
			$data = "<span style='float:right;font-size: 18px;'>$val</span>";
		}
		return $data;
	}
}