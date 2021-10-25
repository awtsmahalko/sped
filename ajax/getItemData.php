<?php
include '../core/config.php';
$cq_id = $_POST['cq_id'];
$restrict = $_POST['restrict'];
if($restrict == 1){
	$display = '';
}else{
	$display = 'display:none';
}
	$fetch_quest = mysql_query("SELECT * FROM tbl_class_quiz_detail WHERE cq_id = $cq_id ORDER BY item_no ASC");
	$count = 1;
	while($row_quest = mysql_fetch_array($fetch_quest)){
		if($row_quest['img'] == ""){
			$img = "";
		}else{
			$img = "<img src='question/".$row_quest['img']."' style='width:300px;height:300px'>";
		}
?>
	<h3>
	<button style="<?= $display;?>" type="button" class="btn btn-sm btn-success" onclick="update_item(<?= $row_quest[0];?>)" data-toggle="modal" data-target="#update_modal" data-backdrop="static"><span class='fa fa-edit'></span></button>
	<button style="<?= $display;?>" type="button" class="btn btn-sm btn-danger" onclick="deleteQuestion(<?= $row_quest[0].",".$cq_id;?>)"><span class='fa fa-trash'></span></button>
	<?= $count.") ".$row_quest['quest']; ?></h3>
	<?=$img?>
	<div style='margin-left:5px;'><text-left>A. <?= $row_quest['item_1'];?></text-left></div>
	<div style='margin-left:5px;'><text-left>B. <?= $row_quest['item_2'];?></text-left></div>
	<div style='margin-left:5px;margin-top:5px;color:green'><text-left>Correct Answer : <?= $row_quest['answer'];?></text-left></div>
	<br>
<?php $count++; } ?>
