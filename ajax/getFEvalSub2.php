<?php
include '../core/config.php';
$class_id = $_POST['class_id'];
$sub_id = $_POST['sub_id'];
$over = getOver($class_id,$sub_id);
$class_d = mysql_fetch_array(mysql_query("SELECT class_name FROM tbl_class WHERE class_id = $class_id"));
$sub_d = mysql_fetch_array(mysql_query("SELECT sub_name FROM tbl_subject WHERE sub_id = $sub_id"));
function getOver($class_id,$sub_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(h.cq_id) FROM `tbl_class_quiz_head` AS h,`tbl_class_quiz_detail` AS d WHERE h.cq_id = d.cq_id AND h.class_id = $class_id AND h.sub_id = $sub_id AND h.status = 1"));
	return $fetch[0];
}
function getAllScoreOver($class_id,$sub_id,$stu_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(score) FROM `tbl_stu_quiz_head` WHERE class_id = $class_id AND sub_id = $sub_id AND stu_id = $stu_id AND status = 1"));
	return $fetch[0] * 1;
}
function getQuizScore($cq_id,$stu_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT score FROM `tbl_stu_quiz_head` WHERE cq_id = $cq_id AND stu_id = $stu_id"));
	return $fetch[0] * 1;
}
?>
<button class="btn btn-primary" type="button" onClick="printDiv('inventory_balance');"><span class="fa fa-print"></span> Print Evaluation</button>
<div class="card">
	<div class="card-block"  id="inventory_balance">
		<center><h3>BACOLOD CITY SPED CENTER</h3></center>
		<center><h4>EVALUATION BY SUBJECT</h4></center>
		<center><h4 style="text-transform:uppercase"><?= "$class_d[0] - $sub_d[0]";?></h4></center>
		<center><h4><?= date("F d, Y");?></h4></center>
		<center><h4></h4></center>
		<br>
			<table class='table table-bordered table-striped' style='width:100%;'>
				<tr style='background: #4e6882; color: #fff;vertical-align: center;'>
					<th style='color:#fff;width:5%;'>#</th>
					<th style='color:#fff;'>STUDENT</th>
					<th style='color:#fff;'>STATUS</th>
					<?php
					$fetch_quiz = mysql_query("SELECT `quiz_name`,`over` FROM `tbl_class_quiz_head` WHERE class_id = '$class_id' AND status = 1 ORDER BY cq_id ASC");
					while($result_quiz = mysql_fetch_array($fetch_quiz)){?>
					<th style='color:#fff;'><?=$result_quiz[0]."<span style='float:right;'>(".$result_quiz[1].")</span>";?></th>
					<?php } ?>
					<th style='color:#fff;'>%</th>
					<th style='color:#fff;'>REMARKS</th>
				</tr>
				<tbody>
				<?php
					$get_stud_class = mysql_query("SELECT cl.stu_id,s.stu_lname,s.stu_fname,s.stu_mname,s.stu_special FROM tbl_class_load AS cl,tbl_student AS s WHERE s.stu_id = cl.stu_id AND cl.class_id = $class_id ORDER BY s.stu_lname ASC");
					$count = 1;
					while($result_class = mysql_fetch_array($get_stud_class)){
						$score = getAllScoreOver($class_id,$sub_id,$result_class[0]);
						if($over == 0){
							$percent = 0;
						}else{
							$percent = ($score / $over) * 100;
						}
				?>
				<tr>
					<th style='width:5%;padding-left:5px;'><?= $count++ ?></th>
					<th style='padding-left:5px;'><?= "$result_class[1], $result_class[2] $result_class[3] ";?></th>
					<th style='padding-left:5px;'><?= "$result_class[4]";?></th>
					<?php
					$fetch_quiz1 = mysql_query("SELECT `cq_id` FROM `tbl_class_quiz_head` WHERE class_id = '$class_id' AND status = 1 ORDER BY cq_id ASC");
					while($result_quiz1 = mysql_fetch_array($fetch_quiz1)){?>
					<th style='padding-left:5px;'><?=getQuizScore($result_quiz1[0],$result_class[0]);?></th>
					<?php } ?>
					<th style='padding-left:5px;'><?=number_format($percent,2)?></th>
					<th style='padding-left:5px;'><?="<span class='label label-rouded label-success' style='font-size:15px;'>".getRemarks($percent)."</span>";?></th>
				</tr>
				<?php } ?>
				</tbody>
			</table>
	</div>
</div>