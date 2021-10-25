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
				<li class="breadcrumb-item active">Teacher</li>
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
										<th>Lastname</th>
										<th>Firstname</th>
										<th>Middlename</th>
										<th>Civil Status</th>
										<th>Citizenship</th>
										<th>Age</th>
										<th>Gender</th>
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
<?php include 'modals/modal_teacher.php'; ?>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script src="js/jquery.json.js"></script>
<script type='text/javascript'>
function storeTblValues_add()
{
    var TableData = new Array();

    $('#teacherTbl_add tr').each(function(row, tr){
        TableData[row]={
            "degree" : $(tr).find('td:eq(1)').text()
            , "course" :$(tr).find('td:eq(2)').text()
            , "school" : $(tr).find('td:eq(3)').text()
            , "year" : $(tr).find('td:eq(4)').text()
        }    
    }); 
    TableData.shift();  // first row will be empty - so remove
    return TableData;
}
function addDegree(){
    var markup = "<tr><td><input type='checkbox' name='record'></td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td></tr>";
    $("table tbody#add-body").append(markup);
}
function deleteDegree(){
	$("table tbody#add-body").find('input[name="record"]').each(function(){
		if($(this).is(":checked")){
	        $(this).parents("tr").remove();
	    }
	});
}
function storeTblValues_update()
{
    var TableData = new Array();

    $('#teacherTbl_update tr').each(function(row, tr){
        TableData[row]={
            "degree" : $(tr).find('td:eq(1)').text()
            , "course" :$(tr).find('td:eq(2)').text()
            , "school" : $(tr).find('td:eq(3)').text()
            , "year" : $(tr).find('td:eq(4)').text()
        }    
    }); 
    TableData.shift();  // first row will be empty - so remove
    return TableData;
}
function addDegree_u(){
    var markup = "<tr><td><input type='checkbox' name='record'></td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td><td contenteditable='true'></td></tr>";
    $("table tbody#update-body").append(markup);
}
function deleteDegree_u(){
	$("table tbody#update-body").find('input[name="record"]').each(function(){
		if($(this).is(":checked")){
	        $(this).parents("tr").remove();
	    }
	});
}
$(document).ready(function (){
	getAllData();
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
	$("#fileToUpload").change(function(){
	    readURL(this);
	});
});
function getAllData(){
	$("#myTable").DataTable().destroy();
	$("#myTable").DataTable({
		"ajax":{
			"url":"ajax/datatables/getAllTeacher.php",
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
				"data":"lname"
			},
			{
				"data":"fname"
			},
			{
				"data":"mname"
			},
			{
				"data":"status"
			},
			{
				"data":"citizen"
			},
			{
				"data":"age"
			},
			{
				"data":"gender"
			}
		]
	});
}
$("#addStud_form").on('submit',(function(e) {
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Adding ...");
	var TableData;
	TableData = $.toJSON(storeTblValues_add());
	$.ajax({
		type:"POST",
		url:"ajax/addNewTeacher.php?c="+TableData,
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			// alert(data);
			console.log(data);
			closeModal('addStudent');
			if(data == 1){
				 swal("Good!", "New Teacher added!", "success");
			}else if(data == 2){
				 swal("Oops!", "Teacher Already Exist!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#addStud_form').each(function(){
				this.reset();
			});
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> SAVE");
			getAllData();
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
	var TableData;
	TableData = $.toJSON(storeTblValues_update());
	$.ajax({
		type:"POST",
		url:"ajax/updateTeacher.php?c="+TableData,
		data:$('#update_form').serialize(),
		success: function(data){
			closeModal('update_modal');
			if(data == 1){
				 swal("Good!", "Teacher Details successfully updated!", "success");
			}else if(data == 2){
				 swal("Oops!", "Teacher Detail Already Exist!", "warning");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$("#u_submit").prop('disabled', false);
			$("#u_submit").html("<span class='fa fa-edit'></span> UPDATE");
			getAllData();
			setTimeout( function(){
				location.reload();
			}, 1500);
		}
	});
});
function deleteTeacher(id,name){
	swal({
		title: "Are you sure to delete "+name+"?",
		text: "You will not be able to recover this record !!",
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
				$.post("ajax/deleteTeacher.php",{
				id:id
			},function (data,status){
				if(data == 1){
					success_delete();
				}else if(data == 2){
					swal("Oops!", "Unable to delete "+name+" !", "warning");
				}else{
					error_delete();
				}
				getAllData();
			});
		}
		else {
			error_delete();
		}
	});
}
function update_teacher(id){
	$.post("ajax/getDetails.php?table=tbl_teacher&primary=t_id",{
		id:id
	}, function (data,status){
		var o = JSON.parse(data);
		$("#u_t_id").val(id);
		$('#u_img-upload').attr('src', "pictures/"+o.img);
		$("#u_t_fname").val(o.t_fname);
		$("#u_t_mname").val(o.t_mname);
		$("#u_t_lname").val(o.t_lname);
		$("#u_t_civil_status").val(o.t_civil_status);
		$("#u_t_gender").val(o.t_gender);
		$("#u_t_bdate").val(o.t_bdate);
		$("#u_t_citizen").val(o.t_citizen);

		$("#u_b_course").val(o.b_course);
		$("#u_b_school").val(o.b_school);
		$("#u_b_year").val(o.b_year);

		$("#u_m_course").val(o.m_course);
		$("#u_m_school").val(o.m_school);
		$("#u_m_year").val(o.m_year);
	});
	$.post("ajax/getTeachersDegree.php",{
		id:id
	},function(data,status){
		$("#update-body").html(data);
	});
}
</script>