<?php
include '../core/config.php';
$class_id = $_POST['class_id'];
$sub_id = $_POST['sub_id'] * 1;
$quarter = $_POST['q_id'] * 1;
$over = getOver($class_id,$sub_id,$quarter);
if(($sub_id > 0) && ($quarter > 0)){
	if($quarter == 1){
		$quarter_label = "FIRST QUARTER";
	}else if($quarter == 2){
		$quarter_label = "SECOND QUARTER";
	}else if($quarter == 3){
		$quarter_label = "THIRD QUARTER";
	}else if($quarter == 4){
		$quarter_label = "FORTH QUARTER";
	}else{
		$quarter_label = "NOT FOUND";
	}
	$class_d = mysql_fetch_array(mysql_query("SELECT class_name,class_year,class_section,t_id FROM tbl_class WHERE class_id = $class_id"));
	$sub_d = mysql_fetch_array(mysql_query("SELECT sub_name,sub_percent FROM tbl_subject WHERE sub_id = $sub_id"));
	$percentage = $sub_d[1];
?>
<button class="btn btn-primary" type="button" onclick="printDiv('inventory_balance');"><span class="fa fa-print"></span> Print Evaluation</button>
<button class="btn btn-success" type="button" onclick="export_data()"><span class="fa fa-download"></span> Export Evaluation</button>
<div class="card">
	<div class="card-block" id="inventory_balance">
		<div class="col-md-12" style="margin-bottom: 10px;">
			<div class="col-md-1" style="float: left;"><center><img src="images/deped.png" height="80px" width="80px"></center></div>
			<div class="col-md-10" style="float: left;">
				<center><h3><strong>Class Record</strong></h3></center>
				<table style="border-collapse: collapse;color: #5a5a5a;width: 100%;vertical-align: middle;text-align: center;">
					<tr>
						<td style="width: 10%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>REGION</strong></span>
						</td>
						<td style="width: 14%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<span style="font-size: 9px;text-align: center;vertical-align: middle;">VI-WESTERN VISAYAS</span>
						</td>
						<td style="width: 12%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>DIVISION</strong></span>
						</td>
						<td style="width: 12%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<span style="font-size: 10px;text-align: center;vertical-align: middle;">BACOLOD CITY</span>
						</td>
						<td style="width: 12%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>DISTRICT</strong></span>
						</td>
						<td style="width: 12%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<span style="font-size: 10px;text-align: center;vertical-align: middle;">V</span>
						</td>
						<td style="width: 12%;"></td>
						<td style="width: 12%;"></td>
					</tr>
					<tr>
						<td style="width: 12%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>SCHOOL NAME</strong></span>
						</td>
						<td colspan="3" style="width: 36%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<span style="font-size: 10px;text-align: center;vertical-align: middle;">BACOLOD CITY SPED CENTER</span>
						</td>
						<td style="width: 12%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>SCHOOL ID</strong></span>
						</td>
						<td style="width: 12%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<span style="font-size: 10px;text-align: center;vertical-align: middle;">117480</span>
						</td>
						<td style="width: 12%;color: #5a5a5a;">
							<span style="float: right;font-size: 11px;"><strong>SCHOOL YEAR</strong></span>
						</td>
						<td style="width: 12%;border:1px solid #5a5a5a;color: #5a5a5a;">
							<center>
								<span style="font-size: 10px;vertical-align: middle;"><?=$class_d[1]." - ".($class_d[1] + 1)?></span>
							</center>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-1" style="float: left;"><center><img src="images/customLogo.png" height="80px" width="80px"></center></div>
		</div>
		<div style="margin: 100px 0 5px 0"></div>
			<table style="border-collapse: collapse;color: #5a5a5a;width: 100%;">
				<tr>
					<td colspan="2" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<center>
							<span style="font-size: 12px;"><strong> <?=$quarter_label?></strong></span>
						</center>
					</td>
					<td colspan="5" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<center>
							<span style="font-size: 12px;"> <b>GRADE & SECTION :</b> <?=strtoupper($class_d[0])?> - <?=strtoupper($class_d[2])?></span>
						</center>
					</td>
					<td colspan="5" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<center>
							<span style="font-size: 12px;"> <strong> TEACHER : </strong><?=strtoupper(getTeacherName($class_d[3]))?></span>
						</center>
					</td>
					<td colspan="5" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<center>
							<span style="font-size: 12px;"> <strong>SUBJECT : </strong><?=strtoupper($sub_d[0])?></span>
						</center>
					</td>
				</tr>
				<tr>
					<td style="width: 2%;color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
					</td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<span style="font-size: 12px;"><strong>LEARNER'S NAME</strong></span>
					</td>
					<td colspan="14" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;">
						<center>
							<span style="font-size: 12px;"><strong>	QUIZ (<?=$percentage?>%)</strong></span>
						</center>
					</td>
				</tr>
				<tr>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"></td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>1</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>2</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>3</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>4</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>5</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>6</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>7</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>8</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>9</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>10</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>Total</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>PS</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>QS</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>REMARKS</center></span>
					</td>
				</tr>
				<tr>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
						<span style="font-size: 12px;float: right;"><strong>HIGHEST POSSIBLE SCORE</strong></span>
					</td>
					<?php
						for ($i=1; $i <= 10 ; $i++) { 
					?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=getHighestPS($quarter,$class_id,$sub_id,"Quiz $i");?></center></span>
					</td>
					<?php } ?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=getOverHighestPS($quarter,$class_id,$sub_id);?></center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center>100.00</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=$percentage?>%</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center></center></span>
					</td>
				</tr>
				<tr style="background: #cecece">
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
						<span style="font-size: 12px;float: left;"><strong>MALE</strong></span>
					</td>
					<td colspan="14" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;"></td>
				</tr>
				<?php
				$get_stud_class_male = mysql_query("SELECT cl.stu_id,s.stu_lname,s.stu_fname,s.stu_mname,s.stu_special FROM tbl_class_load AS cl,tbl_student AS s WHERE s.stu_id = cl.stu_id AND s.stu_gender = 1 AND cl.class_id = $class_id ORDER BY s.stu_lname ASC");
				$count_male = 1;
				while($result_class_male = mysql_fetch_array($get_stud_class_male)){
				?>
				<tr>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"><?=$count_male;?></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
						<span style="font-size: 12px;float: left;text-transform: uppercase;"><strong><?= "$result_class_male[1], $result_class_male[2] $result_class_male[3] ";?></strong></span>
					</td>
					<?php
						$score_male = 0;
						for ($i=1; $i <= 10 ; $i++) {
							$cq_id = getCqId($quarter,$class_id,$sub_id,"Quiz $i");
							$cq_score = getQuizScore($cq_id,$result_class_male[0]);
							//$score_female = getAllScoreOver($cq_id,$result_class_male[0]);
							$score_male += $cq_score;
					?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=$cq_score;?></center></span>
					</td>
					<?php
						}
						if($over == 0){
							$percent_male = 0;
						}else{
							$percent_male = ($score_male / $over) * 100;
						}
						$ps_male = ($percent_male / 100) * $percentage;
					?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=$score_male;?></center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=number_format($percent_male,2);?></center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=number_format($ps_male,2)?>%</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=getRemarks($ps_male)?></center></span>
					</td>
				</tr>
				<?php $count_male++; } ?>
				<tr style="background: #cecece">
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
						<span style="font-size: 12px;float: left;"><strong>FEMALE</strong></span>
					</td>
					<td colspan="14" style="color: #5a5a5a;border:1px solid #5a5a5a;color: #5a5a5a;"></td>
				</tr>
				<?php
				$get_stud_class_female = mysql_query("SELECT cl.stu_id,s.stu_lname,s.stu_fname,s.stu_mname,s.stu_special FROM tbl_class_load AS cl,tbl_student AS s WHERE s.stu_id = cl.stu_id AND s.stu_gender = 0 AND cl.class_id = $class_id ORDER BY s.stu_lname ASC");
				$count_female = 1;
				while($result_class_female = mysql_fetch_array($get_stud_class_female)){
				?>
				<tr>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;"><?=$count_female;?></td>
					<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
						<span style="font-size: 12px;float: left;text-transform: uppercase;"><strong><?= "$result_class_female[1], $result_class_female[2] $result_class_female[3] ";?></strong></span>
					</td>
					<?php
						$score_female = 0;
						for ($i=1; $i <= 10 ; $i++) {
							$cq_id = getCqId($quarter,$class_id,$sub_id,"Quiz $i");
							$cq_score = getQuizScore($cq_id,$result_class_female[0]);
							//$score_female = getAllScoreOver($cq_id,$result_class_female[0]);
							$score_female += $cq_score;
					?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=$cq_score;?></center></span>
					</td>
					<?php
						}
						if($over == 0){
							$percent_female = 0;
						}else{
							$percent_female = ($score_female / $over) * 100;
						}
						$ps_female = ($percent_female / 100) * $percentage;
					?>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=$score_female;?></center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=number_format($percent_female,2);?></center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=number_format($ps_female,2)?>%</center></span>
					</td>
					<td style="width: 5%;color: #5a5a5a;border:1px solid #5a5a5a;">
						<span><center><?=getRemarks($ps_female)?></center></span>
					</td>
				</tr>
				<?php $count_female++; } ?>
			</table>
		<br>
		<table style="border-collapse: collapse;color: #5a5a5a;width: 100%;">
			<tr>
				<td colspan="2" style="color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<strong>
							<span style="font-size: 14px;"> RATING SCALE</span>
						</strong>
					</center>
				</td>
			</tr>
			<tr>
				<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
				</td>
				<td style="color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<strong>
							<span style="font-size: 14px;"> INDICATORS</span>
						</strong>
					</center>
				</td>
			</tr>
			<tr>
				<td style="width:20%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<strong>
							<span style="font-size: 14px;"> 100 % - 90 %</span>
						</strong>
					</center>
				</td>
				<td style="width:80%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<span style="font-size: 14px;"> Consistent (C) - SKILL IS CONSISTENTLY PERFORMED SUCCESSFULLY</span>
					</center>
				</td>
			</tr>
			<tr>
				<td style="width:20%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<strong>
							<span style="font-size: 14px;"> 89 % - 75 %</span>
						</strong>
					</center>
				</td>
				<td style="width:80%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<span style="font-size: 14px;"> Developing (D) - SKILL MASTERY IS DEVELOPING</span>
					</center>
				</td>
			</tr>
			<tr>
				<td style="width:20%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<strong>
							<span style="font-size: 14px;"> 74 % - BELOW</span>
						</strong>
					</center>
				</td>
				<td style="width:80%;color: #5a5a5a;border:1px solid #5a5a5a;">
					<center>
						<span style="font-size: 14px;"> Beginning (B) - SKILL IS DEVELOPING, BUT NEEDS MORE TIME AND INSTRUCTION FOR MASTERY</span>
					</center>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php }else{ ?>
	<div class="card">
		<div class="card-block"  id="inventory_balance">
			<center><h3><strong><span class='fa fa-exclamation'></span> No data found.</strong></h3></center>
		</div>
	</div>
<?php } ?>


<?php
function getOver($class_id,$sub_id,$quarter){
	$fetch = mysql_fetch_array(mysql_query("SELECT COUNT(h.cq_id) FROM `tbl_class_quiz_head` AS h,`tbl_class_quiz_detail` AS d WHERE h.cq_id = d.cq_id AND h.class_id = $class_id AND h.sub_id = $sub_id AND h.status = 1 AND h.quarter = $quarter"));
	return $fetch[0];
}
function getAllScoreOver($cq_id,$stu_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(score) FROM `tbl_stu_quiz_head` WHERE cq_id = $cq_id AND stu_id = $stu_id AND status = 1"));
	return $fetch[0] * 1;
}
function getQuizScore($cq_id,$stu_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT score FROM `tbl_stu_quiz_head` WHERE cq_id = $cq_id AND stu_id = $stu_id AND status = 1"));
	return $fetch[0];
}
function getCqId($quarter,$class_id,$sub_id,$quiz){
	$fetch = mysql_fetch_array(mysql_query("SELECT `cq_id` FROM `tbl_class_quiz_head` WHERE class_id = $class_id AND sub_id = $sub_id AND quiz_name = '$quiz' AND quarter = $quarter"));
	return $fetch[0] * 1;
}
function getHighestPS($quarter,$class_id,$sub_id,$quiz){
	$fetch = mysql_fetch_array(mysql_query("SELECT `over` FROM `tbl_class_quiz_head` WHERE class_id = $class_id AND sub_id = $sub_id AND quiz_name = '$quiz' AND quarter = $quarter"));
	return $fetch[0];
}
function getOverHighestPS($quarter,$class_id,$sub_id){
	$fetch = mysql_fetch_array(mysql_query("SELECT SUM(`over`) FROM `tbl_class_quiz_head` WHERE class_id = $class_id AND sub_id = $sub_id AND quarter = $quarter"));
	return $fetch[0];
}
?>