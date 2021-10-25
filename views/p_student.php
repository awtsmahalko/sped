<style type="text/css">
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Student</li>
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
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Filter by Teacher</label>
					<select class="form-control select2" id="filter_id" onchange="getAllStudent(0)">
						<option value="0">&mdash; Select All &mdash;</option>
						<?php
						$fetch_t = mysql_query("SELECT t_id,t_lname,t_fname,t_mname FROM tbl_teacher");
						while ($get_t = mysql_fetch_array($fetch_t)) {
						?>
						<option value="<?=$get_t[0]?>"><?=strtoupper("$get_t[2] $get_t[3] $get_t[1]");?></option>
						<?php } ?>
					</select>
				</div>
			</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<th>Name</th>
										<th>Specialty</th>
										<th>Age</th>
										<th>Gender</th>
										<th>Teacher</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End PAge Content -->
	</div>
	<!-- End Container fluid  -->
	<!-- footer -->
	<footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
	<!-- End footer -->
</div>
<div style="" class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>VIEW STUDENT DETAILS</span></h5>
		  </div>
				<div class="modal-body">
					<div id="stu-content">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#u_home" role="tab" aria-controls="home" aria-selected="true">Personal Information</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#u_profile" role="tab" aria-controls="profile" aria-selected="false">Family Background</a>
							</li>
						</ul>
						<input type="hidden" id="u_stu_id" name="u_stu_id">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="u_home" role="tabpanel" aria-labelledby="home-tab">
								<br>
								<div class="col-md-12">
									<div class="col-md-4" style="float: left;height: 300px;">
										<div class="form-group">
											<img id='u_img-upload' style="height: 250px;width: 100%;border: 5px solid #5241b7;" />
										</div>								
									</div>
									<div class="col-md-8" style="float: right;">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">First Name</label>
													<input type="text" name='u_stu_fname' id="u_stu_fname" class="form-control" readonly>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group has-danger">
													<label class="control-label">Middle Name</label>
													<input type="text" name='u_stu_mname' id="u_stu_mname" class="form-control" readonly>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group has-danger">
													<label class="control-label">Last Name</label>
													<input type="text" name='u_stu_lname' id="u_stu_lname" class="form-control" readonly>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Specialty</label>
													<select class="form-control" name='u_stu_special' id="u_stu_special" disabled>
														<option value="">--Please Select--</option>
														<option value="Blind">Blind</option>
														<option value="Deaf">Deaf</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Gender</label>
													<select class="form-control" name='u_stu_gender' id="u_stu_gender" disabled>
														<option value="">--Please Select--</option>
														<option value="1">Male</option>
														<option value="0">Female</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Date of Birth</label>
													<input type="date" name='u_stu_bdate' id="u_stu_bdate" class="form-control" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="u_profile" role="tabpanel" aria-labelledby="profile-tab">
								<br>
								<div class="row">
									<div class="col-md-4">
										<h3>Father's Information</h3>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group has-danger">
											<label class="control-label" style="color: blue;">Father's Name</label>
											<input type="text" name='u_stu_f_name' id="u_stu_f_name" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Birthdate</label>
											<input type="date" name='u_stu_f_bdate' id="u_stu_f_bdate" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Occupation</label>
											<input type="text" name='u_stu_f_occ' id="u_stu_f_occ" class="form-control" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group has-danger">
											<label class="control-label" style="color: blue;">Address</label>
											<input type="text" name='u_stu_f_add' id="u_stu_f_add" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Contact Number</label>
											<input type="text" name='u_stu_f_no' id="u_stu_f_no" class="form-control" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<h3>Mother's Information</h3>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group has-danger">
											<label class="control-label" style="color: blue;">Mother's Name</label>
											<input type="text" name='u_stu_m_name' id="u_stu_m_name" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Birthdate</label>
											<input type="date" name='u_stu_m_bdate' id="u_stu_m_bdate" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Occupation</label>
											<input type="text" name='u_stu_m_occ' id="u_stu_m_occ" class="form-control" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group has-danger">
											<label class="control-label" style="color: blue;">Address</label>
											<input type="text" name='u_stu_m_add' id="u_stu_m_add" class="form-control" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label" style="color: blue;">Contact Number</label>
											<input type="text" name='u_stu_m_no' id="u_stu_m_no" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="loader" style="height: 100px;"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
		</div>
	</div>
</div>

<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready( function() {
	getAllStudent(-1);
});
function getAllStudent(id){
	if(id == -1){
		var filter_id = 0;
	}else{
		var filter_id = $("#filter_id").val();
	}
	console.log(filter_id);
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllStudent.php?q=principal&t="+filter_id,
			"dataSrc":"data"
		},
		"columns":[
			{
				"data":"count"
			},
			{
				"data":"p_action"
			},
			{
				"data":"p_name"
			},
			{
				"data":"status"
			},
			{
				"data":"age"
			},
			{
				"data":"gender"
			},
			{
				"data":"p_teacher"
			},
			{
				"data":"stat"
			}
		]
	});
}
function update_student(id){
	$("#stu-content").hide();
	$("#loader").html("<center><span class='fa fa-spin fa-spinner' style='font-size: 40px;'></span><span style='font-size: 40px;'> Loading...</span></center>");
	$("#loader").show();
	$.post("ajax/getDetails.php?table=tbl_student&primary=stu_id",{
		id:id
	}, function (data,status){
		var o = JSON.parse(data);
		$("#u_stu_id").val(id);
		$("#u_img-upload").prop("src","pictures/"+o.img);
		$("#u_stu_fname").val(o.stu_fname);
		$("#u_stu_mname").val(o.stu_mname);
		$("#u_stu_lname").val(o.stu_lname);
		$("#u_stu_special").val(o.stu_special);
		$("#u_stu_gender").val(o.stu_gender);
		$("#u_stu_bdate").val(o.stu_bdate);

		$("#u_stu_m_name").val(o.stu_m_name);
		$("#u_stu_m_bdate").val(o.stu_m_bdate);
		$("#u_stu_m_occ").val(o.stu_m_occ);
		$("#u_stu_m_add").val(o.stu_m_add);
		$("#u_stu_m_no").val(o.stu_m_no);

		$("#u_stu_f_name").val(o.stu_f_name);
		$("#u_stu_f_bdate").val(o.stu_f_bdate);
		$("#u_stu_f_occ").val(o.stu_f_occ);
		$("#u_stu_f_add").val(o.stu_f_add);
		$("#u_stu_f_no").val(o.stu_f_no);
		$("#stu-content").show();
		$("#loader").hide();
	});
}
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}
</script>