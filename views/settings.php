<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_modal" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Subject</li>
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
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<th>School Year</th>
										<th>Status</th>
										<th>Enrolled</th>
										<!-- <th>Language</th> -->
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
<form action='' method='POST' id='add_form'>
	<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document" >
		<div class="modal-content">
		  <div class="modal-header" style="background: #6610f2;">
			<h5 class="modal-title"><span style='color:#fff'>ADD NEW SCOOL YEAR</span></h5>
		  </div>
		  <div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name='school_year' value="<?=date('Y')?>">
						<div class="form-group">
							<label class="control-label"><font style='color:blue'>School Year</font></label>
							<input type="text" name='school_year_ini' class="form-control" value="<?=date('Y')?>-<?=date('Y') + 1?>" readonly>
						</div>
					</div>
				</div>
		  </div>
		  <div class="modal-footer">
			<button id='submit' type="submit" class="btn btn-success"> <span class="fa fa-check"></span> Save</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
</form>
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
	<div class="modal-content">
	  <div class="modal-header" style="background: #6610f2;">
		<h5 class="modal-title"><span style='color:#fff'>SCOOL YEAR DETAILS</span></h5>
	  </div>
	  <div class="modal-body">
			<div id="sy-details">
			</div>
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
$(document).ready(function (){
	getAllData();
});
function view_detail(id){
	$.post("ajax/viewSYDetailsModal.php",{
		id:id
	},function(data,status){
		console.log(data);
		$("#sy-details").html(data);
	});
}
function getAllData(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllSchoolYear.php",
			"dataSrc":"data"
		},
		"columns":[
			{
				"data":"count"
			},
			{
				"data":"action"
			},
			{
				"data":"school_year"
			},
			{
				"data":"status"
			},
			{
				"data":"enroll"
			}
			// {
			// 	"data":"lang"
			// }
		]
	});
}
$('#add_form').submit(function(e){
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Submitting ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewSchoolYear.php",
		data:$('#add_form').serialize(),
		success: function(data){
			closeModal('add_modal');
			if(data == 1){
				 swal("Good!", "New Scool Year opened!", "success");
			}else if(data == 2){
				 swal("Oops!", "Scool Year Already Added!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#add_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> ADD");
			getAllData();
			setTimeout( function(){
				location.reload();
			}, 1500);
		}
	});
});

function closeSY(sy){
	swal({
		title: "Sure to close SY "+sy+"?",
		text: "Once close means all classes ends!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, close it !!",
		cancelButtonText: "No, cancel it !!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			var sql = "UPDATE tbl_school_year SET status = 0";
			$.post("ajax/queryFile.php",{
				sql:sql
			},function (data,status){
				if(data == 1){
					updateStuDetails(sy);
				}else{
					swal("Oops!", "Unable to close "+sy+" !", "warning");
				}
			});
		}else {
			error_delete();
		}
	});
}
function updateStuDetails(sy){
	var sql = "UPDATE tbl_student SET status = 0";
	$.post("ajax/queryFile.php",{
		sql:sql
	},function (data,status){
		if(data == 1){
			swal("Nice!", "School Year "+sy+" successfully closed!", "success");
		}else{
			swal("Oops!", "Unable to close "+sy+" !", "warning");
		}
		getAllData();
	});
}
</script>