<?php
include '../core/config.php';
$id = $_POST['id'];
?>
<center><h3><i>Classes of Scool Year <?=$id?> - <?=$id + 1?></i></h3></center>
<table class="table table-bordered table-striped" style="width: 100%; margin-bottom:unset;">
	<tbody>
		<tr style="background: #4e6882; color: #fff;vertical-align: center;">
			<th style="width:5%;color: #fff">#</th>
			<th style="width:30%;color: #fff">Class</th>
			<th style="width:45%;color: #fff">Adviser</th>
			<th style="color: #fff">Students</th>
			<th style="color: #fff">Subjects</th>
		</tr>
	</tbody>
</table>
<div style="width:100%;max-height:250px;overflow-y: auto;">
	<table id="" class="table table-bordered table-striped" style="margin-top:2px;">
		<tbody>
			<?php
			$sql = mysql_query("SELECT * FROM tbl_class WHERE class_year = $id ORDER BY class_name ASC, class_section ASC");
				if (mysql_num_rows($sql) > 0) {
					$count = 1;
					while ($row = mysql_fetch_array($sql)) {
						$count_stu = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM `tbl_class_load` WHERE class_id = $row[0]"));
						$count_sub = mysql_fetch_array(mysql_query("SELECT COUNT(class_id) FROM `tbl_class_subject` WHERE class_id = $row[0]"));
			?>
				<tr>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;width:5%;"><?=$count++;?></th>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;width:30%;"><?=$row['class_name']." - ".$row['class_section']?></th>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;width:45%;"><?=getTeacherName($row['t_id'])?></th>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;"><?=$count_stu[0]?></th>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;"><?=$count_sub[0]?></th>
				</tr>
		<?php } }else{ ?>
				<tr>
					<th style="vertical-align:middle;padding:1px;border: 1px solid #ddd;text-transform: uppercase;font-size: 14px; padding-left:5px;" colspan="5">No Data Found</th>
				</tr>
		<?php }?>
		</tbody>
	</table>
</div>