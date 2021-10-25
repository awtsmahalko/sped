<?php
include '../core/config.php';
	$cq_id = $_POST['cq_id'];
	$class_id = mysql_fetch_array(mysql_query("SELECT class_id,quarter FROM tbl_class_quiz_head WHERE cq_id = '$cq_id'"));
	if($class_id['quarter'] == 1){
		$quarter_label = "<span class='label label-rouded label-danger'>FIRST QUARTER</span>";
	}else if($class_id['quarter'] == 2){
		$quarter_label = "<span class='label label-rouded label-danger'>SECOND QUARTER</span>";
	}else if($class_id['quarter'] == 3){
		$quarter_label = "<span class='label label-rouded label-danger'>THIRD QUARTER</span>";
	}else if($class_id['quarter'] == 4){
		$quarter_label = "<span class='label label-rouded label-danger'>FOURTH QUARTER</span>";
	}else{
		$quarter_label = "<span class='label label-rouded label-danger'>NOT FOUND</span>";
	}
	$fetch_stu_quiz = mysql_query("SELECT * FROM `tbl_class_load` WHERE class_id = $class_id[0]");
	$count_quiz = mysql_num_rows($fetch_stu_quiz);
	if($count_quiz > 0){
		while($row_stu_quiz = mysql_fetch_array($fetch_stu_quiz)){
			$status_q = getData("status,score","tbl_stu_quiz_head","cq_id = $cq_id AND stu_id = ".$row_stu_quiz['stu_id']);
			if($status_q[0] == 1){
				$disabled = "";
				$score = "Score $status_q[1]";
				$label = "<i class='fa fa-eye'></i> View Result";
			}else{
				$disabled = "disabled";
				$score = "";
				$label = "<i class='fa fa-exclamation'></i> Not Yet Taken";
			}
				$link = md5('stu-view-quiz')."&quiz=$cq_id&id=".$row_stu_quiz['stu_id'];
				$studentData = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = '$row_stu_quiz[stu_id]'"));

?>
	<div class="col-md-4">
		<div class="card p-30 animated flipInX">
			<center>
				<?=$quarter_label?><br><br>
				<img src="pictures/<?=$studentData['img']?>" style="border-radius: 50%;" width="150px" height="150px"><br>
				<span><?="$studentData[stu_lname], $studentData[stu_fname]"?></span><br>
				<span><?=$score?></span><br>
				<button <?=$disabled?> type="button" onclick="linkMe('<?=$link?>')" class="btn btn-success"><?=$label?></button>
			</center>
		</div>
	</div>
<?php
		}
	}else{
?>
	<div class="col-lg-12">
		<div class="alert alert-primary alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>No Quiz Posted!</strong> You should check or follow up your teacher now.
		</div>
	</div>
<?php
	}
?>