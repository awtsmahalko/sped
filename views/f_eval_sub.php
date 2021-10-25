<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
	</div>
	<!-- End Bread crumb -->
	<!-- Container fluid  -->
	<div class="container-fluid">
		<!-- Start Page Content -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="col-md-12">
							<div class="col-md-4" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Class Name :</label>
									<select id='class_id' onchange='getSubject()' name='class_id' class="form-control select2" required>
										<option value='0'>&mdash; Please Select Class Name &mdash;</option>
										<?php
										if($_SESSION['user_type'] == 2){
											$inject = " WHERE t_id = ".$_SESSION['account_id'];
										}else{
											$inject = "";
										}
										$fetch_class = mysql_query("SELECT * FROM tbl_class$inject");
										while($row_class = mysql_fetch_array($fetch_class)){
											$class_text = "$row_class[class_name] - $row_class[class_section] ($row_class[class_year]-".($row_class['class_year'] + 1).") [".getTeacherName($row_class['t_id'])."]"; 
										?>
										<option value='<?= $row_class['class_id']; ?>'><?=strtoupper($class_text);?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-4" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Subject :</label>
									<select id='subject_id' onchange='getAllStudent()' name='subject_id' class="form-control select2" required>
									</select>
								</div>
							</div>
							<div class="col-md-4" style='float:left;'>
								<div class="form-group">
									<label class="control-label">Filter by Quarter :</label>
									<select onchange='getAllStudent()' id='quarter' name='quarter' class="form-control select2" required>
										<option value="">&mdash; Please Select &mdash;</option>
										<option value="1">First Quarter</option>
										<option value="2">Second Quarter</option>
										<option value="3">Third Quarter</option>
										<option value="4">Fourth Quarter</option>
									</select>
								</div>
							</div>
						</div>
						<div id="list-content">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End PAge Content -->
	</div>
	<!-- End Container fluid  -->
	<!-- footer -->
	<footer class="footer"> &copy; 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
	<!-- End footer -->
</div>
<?php include 'modals/modal_assessment.php'; ?>
<script type='text/javascript'>
$(document).ready(function (){
});
function getAllStudent(){
	$("#list-content").html("<center><span class='fa fa-spin fa-spinner'></span> Loading..</center>");
	var sub_id = $("#subject_id").val();
	var id = $("#class_id").val();// * 1;
	var q_id = $("#quarter").val();// * 1;
	$.post("ajax/getFEvalSub.php",{
		sub_id:sub_id,
		class_id:id,
		q_id:q_id
	},function(data,status){
		//alert(data);
		$("#list-content").html(data);
	});
}
function getQuizName(){
	var class_id = $("#class_id_modal").val();
	var sub_id = $("#subject_id_modal").val();
	$.post("ajax/getQuizName.php",{
		class_id:class_id,
		sub_id:sub_id
	}, function (data,status){
		$("#quiz_name").val(data);
	});
}
function getSubjectModal(){
	var id = $("#class_id_modal").val();
	$.post("ajax/getSubject.php",{
		id:id
	}, function (data,status){
		$("#subject_id_modal").html(data);
	});
}
function getSubject(){
	var id = $("#class_id").val();
	$.post("ajax/getSubject.php",{
		id:id
	}, function (data,status){
		$("#subject_id").html(data);
	});
}
function printDiv(inventory_balance){
	var printContents = document.getElementById(inventory_balance).innerHTML;
	var originalContents = document.body.innerHTML;
	document.body.innerHTML = printContents;
	window.print();
	document.body.innerHTML = originalContents;
 }
 function export_data(){
	var confirm_export = confirm("You are about to export data to excel.");
	if(confirm_export == true){
		tableToExcel('inventory_balance', 'Class Record');
	}
}
var tableToExcel = (function() {
				  var uri = 'data:application/vnd.ms-excel;base64,'
				  , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
				  , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
				  , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
				  return function(table, name) {
					if (!table.nodeType) table = document.getElementById(table)
					  var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
					window.location.href = uri + base64(format(template, ctx))

				  }
				})()
</script>