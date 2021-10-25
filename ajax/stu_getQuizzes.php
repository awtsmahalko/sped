<?php
include '../core/config.php';
	$sub_id = $_POST['sub_id'];
	$class_id = $_POST['class_id'];
	$user_id = $_POST['user_id'];
	$fetch_stu_quiz = mysql_query("SELECT * FROM `tbl_stu_quiz_head` WHERE class_id = $class_id AND stu_id = $user_id AND sub_id = $sub_id ORDER BY cq_id DESC");
	$count_quiz = mysql_num_rows($fetch_stu_quiz);
	if($count_quiz > 0){
		while($row_stu_quiz = mysql_fetch_array($fetch_stu_quiz)){
			$quiz_name = mysql_fetch_array(mysql_query("SELECT quiz_name,quarter FROM tbl_class_quiz_head WHERE cq_id = $row_stu_quiz[cq_id]"));

			if($quiz_name[1] == 1){
				$quarter = "<span class='label label-rouded label-success'>FIRST QUARTER</span>";
			}else if($quiz_name[1] == 2){
				$quarter = "<span class='label label-rouded label-danger'>SECOND QUARTER</span>";
			}else if($quiz_name[1] == 3){
				$quarter = "<span class='label label-rouded label-success'>THIRD QUARTER</span>";
			}else if($quiz_name[1] == 4){
				$quarter = "<span class='label label-rouded label-danger'>FOURTH QUARTER</span>";
			}else{
				$quarter = "<span class='label label-rouded label-danger'>NOT FOUND</span>";
			}

			if($row_stu_quiz['status'] == 1){
				$title = "Taken: ".date("M d, Y", strtotime($row_stu_quiz['date_taken']));
				$button = "<button type='button' onclick='window.location=\"index.php?page=".md5('stu-view-quiz')."&quiz=".$row_stu_quiz['cq_id']."\"' class='btn btn-success'><i class='fa fa-eye'></i> View Result</button>";
				$under = "Score";
				$score = $row_stu_quiz['score']." / ".$row_stu_quiz['over'];
			}else{
				$date_posted = mysql_fetch_array(mysql_query("SELECT date_posted FROM tbl_class_quiz_head WHERE cq_id = ".$row_stu_quiz['cq_id']));
				$title = "Posted: ".date("M d, Y", strtotime($date_posted[0]));
				$button = "<button type='button' onclick='window.location=\"index.php?page=".md5('stu-take-quiz')."&cq_id=".$row_stu_quiz['cq_id']."&item_no=1\"' class='btn btn-primary'><i class='fa fa-plus-circle'></i> Take Now</button>";
				$under = "Items";
				$score = $row_stu_quiz['over'];
			}
?>
	<div class="col-md-4">
		<div class="card p-30 animated flipInX">
			<center><span style="color:red;font-size:18px;margin-top:none;"><?= $title; ?></span></center>
			<center><span style="color:red;font-size:18px;margin-top:none;"><?= $quarter; ?></span></center>
<!-- 			<div class="media">
				<div class="media-left meida media-middle">
				<p class="m-b-0"><span style='color:green'> <?=$quiz_name[0]?></span></p>
					<?= $button; ?>
				</div>
				<div class="media-body media-text-right">
					<h2 style='color:black'><?= $score; ?></h2>
					<p class="m-b-0" style='color:blue'><?= $under?></p>
				</div>
			</div> -->
			<div class="media">
				<p class="m-b-0" style='color:green'> <?=$quiz_name[0]?></p>
			</div>
			<div class="media">
				<p class="m-b-0" style='color:blue'><?= $under." : ".$score; ?></p>
			</div>
			<div class="media">
				<center><?= $button; ?></center>
			</div>
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