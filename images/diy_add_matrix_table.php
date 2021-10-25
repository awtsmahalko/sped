<?php
include '../core/config.php';
$branch_id = get_branch();
$nutri_id = PHILSAN;
$company_id = $_SESSION['system']['company_id'];
$time = date("YmdHis");
$code = "$nutri_id-$time-$company_id-$branch_id";
$preset_id = $_POST['preset_id'];
if($preset_id == 1){
	$preset_name = "Concentrate";
}else if($preset_id == 2){
	$preset_name = "Basemix";
}else if($preset_id == 3){
	$preset_name = "Premix";
}else{
	$preset_name = "";
}
$feed_type = $_POST['feed_type'];
$density = $_POST['density'];
if($density == 1){
	$density_name = "Low";
}else if($density == 2){
	$density_name = "Medium";
}else if($density == 3){
	$density_name = "High";
}else{
	$density_name = "";
}
$formula_name_type = getFeedTypeData($feed_type)." $preset_name - $density_name";
$warehouse_id = $_POST['warehouse_id'];

	foreach ($_POST['preset'] as $key => $raw_id) {
		$minmax = getMinMax($raw_id);
	   saveNutMatrix(0,$nutri_id,$code,$raw_id,0,$minmax[0],$minmax[1],0);
	}
	$query_nut = mysql_query("SELECT * FROM tbl_diy_formula_density_matrix WHERE feed_type_id = $feed_type AND density = $density AND presets_id = $preset_id");
	while($row_nut = mysql_fetch_array($query_nut)){
		saveNutMatrix($company_id,$nutri_id,$code,0,$row_nut['nut_id'],$row_nut['min'],$row_nut['max'],1);
	}
	insertPresetRaw($nutri_id,$code,$feed_type,$preset_id);
	$query = mysql_query("INSERT INTO `tbl_formula_company_matrix` (`cust_matrix_id`, `company_id`, `branch_id`, `nutri_id`, `nut_code`, `code`, `product_id`, `batch_size`, `remarks`, `status`, `feed_type_id`, `formulation_type`, `density`, `warehouse_id`) VALUES (NULL, '$company_id', '$branch_id', '$nutri_id', '', '$code', '0', '0', '$formula_name_type', 'F', '$feed_type', '$preset_id', '$density', '$warehouse_id')");

	if($query){
		echo $code;
	}else{
		echo 0;
	}

function saveNutMatrix($company_id,$nutri_id,$code,$raw_id,$nut_id,$min,$max,$order){
	$warehouse_id = $_POST['warehouse_id'];
	if($order == 1){
		$nut_order = getNutOrder($nut_id);
		$raw_cost = 0;
	}else{
		$nut_order = 0;
		if($warehouse_id == -1){
			$raw_cost = getStoreCost($raw_id);
		}else{
			$raw_cost = getWHCost($raw_id,$warehouse_id);
		}
	}
	mysql_query("INSERT INTO `tbl_formula_matrix_table` (`mt_id`, `nutri_id`, `code`, `raw_id`, `nut_id`, `min`, `max`, `raw_order`, `nut_order`, `raw_cost`, `raw_qty`) VALUES (NULL, '$nutri_id', '$code', '$raw_id', '$nut_id', '$min', '$max', '0', '$nut_order', '$raw_cost', '0')");
}
function insertPresetRaw($nutri_id,$code,$feed_type,$preset_id){
	$query_nut = mysql_query("SELECT raw_id,min,max FROM `tbl_diy_formula_type_presets` WHERE feed_type_id = $feed_type AND presets_id = $preset_id AND status = 1");
	while($row_nut = mysql_fetch_array($query_nut)){
		saveNutMatrix(0,$nutri_id,$code,$row_nut['raw_id'],0,$row_nut['min'],$row_nut['max'],0);
	}
}
function getNutOrder($nut_id){
	$nutri_id = PHILSAN;
	$fetch = mysql_fetch_array(mysql_query("SELECT nut_order FROM tbl_formula_nutrients WHERE nutri_id = $nutri_id AND nut_id = $nut_id"));
	return $fetch[0];
}
function getWHCost($raw_id,$warehouse_id){
	$branch_id = get_branch();
	$company_id = $_SESSION['system']['company_id'];
	$prod_id = prodDic($raw_id);
	if($prod_id > 0){
		$cost = mysql_fetch_array(mysql_query("SELECT cost FROM `tbl_warehouse_product_cost` WHERE company_id = $company_id AND branch_id = $branch_id AND warehouse_id = $warehouse_id AND product_id = $prod_id"));
		return $cost[0];
	}else{
		return 0;
	}
}
function getStoreCost($raw_id){
	$company_id = $_SESSION['system']['company_id'];
	$cost = mysql_fetch_array(mysql_query("SELECT cost FROM `tbl_diy_company_cost` WHERE company_id = $company_id AND raw_id = $raw_id"));
	return $cost[0];
}
function getMinMax($raw_id){
	$preset_id = $_POST['preset_id'];
	$feed_type = $_POST['feed_type'];
	$fetch = mysql_fetch_array(mysql_query("SELECT min,max FROM tbl_diy_formula_type_presets WHERE feed_type_id = '$feed_type' AND presets_id = '$preset_id' AND raw_id = '$raw_id'"));
	return $fetch;
}
function getFeedTypeData($id){
$fetch = mysql_fetch_array(mysql_query("SELECT feed_name FROM `tbl_diy_feed_type` WHERE feed_type_id = $id"));
return $fetch[0];
}
function prodDic($raw_id){
$company_id = $_SESSION['system']['company_id'];
	$prodName = mysql_fetch_array(mysql_query("SELECT raw_tag FROM tbl_formula_raw_mats WHERE raw_id = $raw_id"));
	$getProd_dic_id = mysql_fetch_array(mysql_query("SELECT product_id FROM tbl_product_dictionary_feeds WHERE UCASE(product_keyword) = '$prodName[0]' AND company_id ='$company_id'"));
	return $getProd_dic_id[0] * 1;
}