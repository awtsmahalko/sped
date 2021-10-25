<?php
include '../core/config.php';
$cq_id = $_POST['cq_id'];
$user_id = $_POST['id'];
	$fetch_quest = mysql_query("SELECT * FROM tbl_class_quiz_detail WHERE cq_id = $cq_id ORDER BY item_no ASC");
	$count = 1;
	while($row_quest = mysql_fetch_array($fetch_quest)){
		if($row_quest['img'] == ""){
			$img = "";
		}else{
			$img = "<img src='question/".$row_quest['img']."' >";
		}
?>
	<h3>
	<?= $count.") ".$row_quest['quest']; ?></h3>
	<?=$img?>
	<div style='margin-left:5px;'><text-left>A. <?= $row_quest['item_1'];?></text-left></div>
	<div style='margin-left:5px;'><text-left>B. <?= $row_quest['item_2'];?></text-left></div>
	<div style='margin-left:5px;margin-top:5px;'><text-left><?= checkMyAnswer($row_quest['answer'],$row_quest['cqd_id'],$user_id); ?></text-left></div>
	<br>
<?php
$count++; 
}
function checkMyAnswer($ans,$cqd,$user_id){
	$account_id = $_SESSION['account_id'];
	$user_type = $_SESSION['user_type'];
	if($user_type == 1){
		$pre = "Your ";
	}else{
		$pre = "His/Her ";
	}
	$count = mysql_fetch_array(mysql_query("SELECT answer FROM `tbl_stu_quiz_detail` WHERE cqd_id = $cqd AND stu_id = $user_id AND status = 1"));
	if($count[0] == $ans){
		$data = "<span class='fa fa-check' style='color:green;'> $pre answer [$ans] is Correct</span>";
	}else{
		$data = "<span class='fa fa-times' style='color:red;'> $pre answer [$count[0]] is Wrong</span>";
	}
	return $data;
}
?>
