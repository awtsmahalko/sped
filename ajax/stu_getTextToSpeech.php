<?php
include '../core/config.php';
	$cq_id = $_POST['cq_id'];
	$item = $_POST['item'];
	$l = 0;
	if($l == 0){
		if($item == 1){
			$content = "Listen carefully. Press letter A for item A and B otherwise.";
		}else{
			$content = "";
		}
		$content .= "Question number $item. ";
		$data = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_class_quiz_detail` WHERE `cq_id` = $cq_id AND item_no = $item"));
		$content .= $data['quest'].". ";
		$content .= "A. ".$data['item_1'].". ";
		$content .= "B. ".$data['item_2'].". ";
	}else{
		if($item == 1){
			$content = "Makinig ng mabuti. Pindutin ang letrang A kung ang tamang sagot ay A at B.";
		}else{
			$content = "";
		}
		$content .= "Unang Tanong. ";
		$data = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_class_quiz_detail` WHERE `cq_id` = $cq_id AND item_no = $item"));
		$content .= $data['quest'].". ";
		$content .= " sah letrang, ah. ".$data['item_1'].". ";
		$content .= " sah letrang, ba. ".$data['item_2'].". ";
	}
	echo $content;
?>