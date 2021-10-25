<?php
include '../core/config.php';
$cq_id = $_POST['cq_id'] * 1;
$cq_d = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_class_quiz_head` WHERE `cq_id` = '$cq_id'"));
$class_d = mysql_fetch_array(mysql_query("SELECT class_name,class_year,t_id,class_section FROM tbl_class WHERE class_id = $cq_d[class_id]"));
$sub_d = mysql_fetch_array(mysql_query("SELECT sub_name FROM tbl_subject WHERE sub_id = $cq_d[sub_id]"));
if($cq_d['quarter'] == 1){
	$quarter_label = "FIRST QUARTER";
}else if($cq_d['quarter'] == 2){
	$quarter_label = "SECOND QUARTER";
}else if($cq_d['quarter'] == 3){
	$quarter_label = "THIRD QUARTER";
}else if($cq_d['quarter'] == 4){
	$quarter_label = "FORTH QUARTER";
}else{
	$quarter_label = "NOT FOUND";
}
?>
<button class="btn btn-primary" type="button" onClick="printDiv('inventory_balance');"><span class="fa fa-print"></span> Print Evaluation</button>
<div class="card">
	<div class="card-block"  id="inventory_balance">
		<div class="row" style="color:#1b1a1a;">
			<div class="col-md-3">
				<center><img src='images/customLogo.png'></center>
			</div>
			<div class="col-md-6">
				<center style="line-height: 18px;">
					<span>Republic of the Philippines</span><br>
					<span>Department of Education</span><br>
					<span>Region VI - Western Visayas</span><br>
					<span>Division of Bacolod</span><br>
					<span>BACOLOD CITY SPED CENTER</span><br><br>
					<!-- <span>SPED CENTER CURRICULUMN</span><br><br> -->
					<span><?= strtoupper($cq_d['quiz_name'])." IN ".strtoupper($sub_d[0]);?></span><br>
					<span><?=$quarter_label;?></span>
				</center>
			</div>
			<div class="col-md-3">
				<center><img src='images/deped.png' height="100px" width="100px"></center>
			</div>
		</div><br>
		<div class="row">
			<div class="col-md-6">
				<span>Instructor Name: <?=strtoupper(getTeacherName($class_d[2]));?></span>
			</div>
			<div class="col-md-3">
				<span>Class: <?=$class_d[0]." - ".$class_d[3]?></span>
			</div>
			<div class="col-md-3">
				<span>SY: <?=$class_d[1]." - ".($class_d[1] + 1)?></span>
			</div>
		</div>
		<br>
			<table class='table table-bordered table-striped' style='width:100%;'>
				<tr style='background: #4e6882; color: #fff;vertical-align: center;'>
					<th style='color:#fff;width:5%;'>#</th>
					<th style='color:#fff;'>STUDENT</th>
					<th style='color:#fff;'>STATUS</th>
					<th style='color:#fff;'>SCORE</th>
					<th style='color:#fff;'>Number of Items</th>
					<th style='color:#fff;'>%</th>
					<th style='color:#fff;'>REMARKS</th>
				</tr>
				<tbody>
				<?php
					$get_stud_class = mysql_query("SELECT cl.stu_id,s.stu_lname,s.stu_fname,s.stu_mname,s.stu_special,cl.score,cl.over,cl.status FROM tbl_stu_quiz_head AS cl,tbl_student AS s WHERE s.stu_id = cl.stu_id AND cl.cq_id = $cq_id ORDER BY s.stu_lname ASC");
					$count = 1;
					$count_s = mysql_num_rows($get_stud_class);
					if($count_s > 0){
						while($result_class = mysql_fetch_array($get_stud_class)){
							($result_class[7]==0)?$score=0:$score = $result_class[5];
							$over = $result_class[6];
							if($over == 0){
								$percent = 0;
							}else{
								$percent = ($score / $over) * 100;
							}
				?>
					<tr>
						<th style='width:5%;padding-left:5px;'><?= $count++ ?></th>
						<th style='padding-left:5px;'><?= "$result_class[1], $result_class[2] $result_class[3]";?></th>
						<th style='padding-left:5px;'><?= "$result_class[4]";?></th>
						<th style='padding-left:5px;'><?=$score;?></th>
						<th style='padding-left:5px;'><?=$over;?></th>
						<th style='padding-left:5px;'><?=number_format($percent,2);?></th>
						<th style='padding-left:5px;'><?=getRemarks($percent);?></th>
					</tr>
				<?php } }else{ ?>
					<tr>
						<th style='width:5%;padding-left:5px;' colspan='7'> No data Found!</th>
					</tr>
				<?php }?>
				</tbody>
			</table>
	</div>
</div>