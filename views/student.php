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
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudent" data-backdrop="static"><span class='fa fa-plus-circle'></span> Add </button>
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
					<div class="card-body">
						<div class="table-responsive">
							<table id="myTable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<th>Specialty</th>
										<th>Lastname</th>
										<th>Firstname</th>
										<th>Middlename</th>
										<th>Age</th>
										<th>Gender</th>
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
<?php include 'modals/modal_student.php'; ?>

<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type='text/javascript'>
$(document).ready( function() {
	getAllStudent();
	$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
	    
	    var input = $(this).parents('.input-group').find(':text'),
	        log = label;
	    
	    if( input.length ) {
	        input.val(log);
	    } else {
	        if( log ) alert(log);
	    }
    
	});
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) {
	            $('#img-upload').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	function readURLu(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        
	        reader.onload = function (e) {
	            $('#u_img-upload').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$("#fileToUpload").change(function(){
	    readURL(this);
	});
	$("#u_fileToUpload").change(function(){
	    readURLu(this);
	}); 	
});
function getAllStudent(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllStudent.php",
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
				"data":"status"
			},
			{
				"data":"lname"
			},
			{
				"data":"fname"
			},
			{
				"data":"mname"
			},
			{
				"data":"age"
			},
			{
				"data":"gender"
			},
			{
				"data":"stat"
			}
		]
	});
}
$("#addStud_form").on('submit',(function(e) {
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Adding ...");
	$.ajax({
		type:"POST",
		url:"ajax/addNewStudent.php",
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			closeModal('addStudent');
			// alert(data);
			if(data == 1){
				 swal("Good!", "New student added!", "success");
			}else if(data == 2){
				 swal("Oops!", "Student Already loaded!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#addStud_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> SAVE");
			getAllStudent();
			setTimeout( function(){
				location.reload();
			}, 1500);
		}
	});
}));
$('#update_form').submit(function(e){
	e.preventDefault();

	$("#u_submit").prop('disabled', true);
	$("#u_submit").html("<span class='fa fa-spinner'></span> Updating ...");
	$.ajax({
		type:"POST",
		url:"ajax/updateStudent.php",
		data:$('#update_form').serialize(),
		success: function(data){
			// alert(data);
			closeModal('update_modal');
			if(data == 1){
				 swal("Good!", "Student Detail successfully updated!", "success");
			}else if(data == 2){
				 swal("Oops!", "Student Detail Already Exist!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-edit'></span> UPDATE");
			getAllStudent();
			setTimeout( function(){
				location.reload();
			}, 1500);
		}
	});
});
function update_student(id){
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
	});
}
function removeStu(id,name){
	swal({
		title: "Are you sure to delete?",
		text: "You will not be able to recover "+name+" records!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it !!",
		cancelButtonText: "No, cancel it !!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
				$.post("ajax/deleteStudent.php",{
				id:id
			},function (data,status){
				if(data == 1){
					success_delete();
				}else if(data == 2){
					swal("Oops!", "Unable to delete "+name+" !", "warning");
				}else{
					error_delete();
				}
				getAllStudent();
			});
		}
		else {
			error_delete();
		}
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