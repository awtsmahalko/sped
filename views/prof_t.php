<?php
$t_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = ".$_SESSION['account_id']));
if($t_data[t_gender] == 1){
    $w_ = "Widower";
}else{
    $w_ = "Widow";
}
?>
<input type="hidden" id="h_cs" name="h_cs" value="<?= $t_data['t_civil_status']?>" >
<input type="hidden" id="h_g" name="h_g" value="<?= $t_data['t_gender']?>" >
<div class="page-wrapper">

            <div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-two">
                                    <center>
                                        <!--<img src="pictures/<?=$t_data['img']?>" alt="user" width="200px" height="200px" style="border-radius:50%" />-->
                                        <img src="pictures/<?=$t_data['img']?>" alt="user" width="200px" height="200px" style="border-radius:50%" /><br><br>
										<button class='btn btn-primary' data-toggle="modal" data-target="#exampleModal" >Change Picture</button>
                                    </center>
                                    <h3><?="$t_data[t_lname], $t_data[t_fname]";?></h3>
                                    <div class="desc">
                                        Teacher
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs profile-tab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Profile</a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Educational Background</a> </li>
                                </ul>
                            <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                    <form method="POST" id="updateProfile_form">
                                        <div class="card card-outline-primary">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">Personal Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" value="<?= $t_data['t_lname'];?>" name="t_lname" id="t_lname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" value="<?= $t_data['t_fname'];?>" name="t_fname" id="t_fname" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Middle Name</label>
                                                                <input type="text" value="<?= $t_data['t_mname'];?>" name="t_mname" id="t_mname" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Birthday</label>
                                                                <input type="date" value="<?= $t_data['t_bdate'];?>" name="t_bdate" id="t_bdate" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Civil Status</label>
                                                                <select class="form-control" id='t_civil_status' name='t_civil_status' required>
                                                                    <option value="">--Please Select--</option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="<?=$w_?>"><?=$w_?></option>
                                                                    <option value="Divorce">Divorce</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Gender</label>
                                                                <select class="form-control" name='t_gender' id='t_gender' required>
                                                                    <option value="">--Please Select--</option>
                                                                    <option value="1">Male</option>
                                                                    <option value="0">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Address</label>
                                                                <input type="text" value="<?= $t_data['t_add'];?>" name="t_add" id="t_add" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Citizenship</label>
                                                                <input type="text" value="<?= $t_data['t_citizen'];?>" name="t_citizen" id="t_citizen" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" id="btn-submit" class="btn btn-success"> <i class="fa fa-check-circle"></i>  Update Profile</button>
                                        </div>
                                    </form>
                                    </div>
                                        <!--second tab-->
                                    <div class="tab-pane" id="profile" role="tabpanel">
                                        <div class="card card-outline-danger">
                                            <div class="card-header">
                                                  <div class="input-group">
                                                    <input type="text" class="form-control" id="degree_name" placeholder="Degree">
                                                    <div class="input-group-prepend">
                                                    <button class="btn btn-primary" type="button" onclick="addDegree()">ADD DEGREE</button> 
                                                    </div>
                                                  </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label"><strong>Course</strong></label>
                                                                <input type="text" id='course' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>School</strong></label>
                                                                <input type="text" id='school' class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Batch</strong></label>
                                                                <input type="text" id='year_grad' class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $query = mysql_query("SELECT * FROM tbl_degree WHERE t_id = $_SESSION[account_id]");
                                            while ($row_degree = mysql_fetch_array($query)) {
                                        ?>
                                        <div class="card card-outline-primary">
                                            <div class="card-header">
                                                <h4 class="m-b-0 text-white">
                                                    <span contenteditable="true" onBlur="saveToDatabase(this,<?=$row_degree[0]?>,'degree_name')"><?=$row_degree['degree_name']?></span>'s Degree
                                                    <span style="float: right;cursor: pointer;" class="fa fa-minus-circle" onclick="removeDegree(<?=$row_degree[0]?>)"></span>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label"><strong>Course</strong></label>
                                                                <input type="text" value="<?=$row_degree['course']?>" class="form-control" id="course-<?=$row_degree[0]?>" onchange="updateDegree_d(<?=$row_degree[0]?>,'course')">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>School</strong></label>
                                                                <input type="text" value="<?=$row_degree['school']?>" class="form-control" id="school-<?=$row_degree[0]?>"onchange="updateDegree_d(<?=$row_degree[0]?>,'school')">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>Batch</strong></label>
                                                                <input type="text" value="<?=$row_degree['year_grad']?>" class="form-control" id="year_grad-<?=$row_degree[0]?>" onchange="updateDegree_d(<?=$row_degree[0]?>,'year_grad')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

                <!-- End PAge Content -->
            </div>
        <!-- Modal -->
    <!-- End Container fluid  -->
    <!-- footer -->
   <footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
    <!-- End footer -->
</div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form enctype="multipart/form-data" action='' method='POST' id='updatePhoto_form'>
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Picture</h5>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group col-md-12">
                                    <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                    Browse… <input type="file" accept="image/*" name="fileToUpload" id="fileToUpload" required>
                                    </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                <center><img id='img-upload' style="height: 250px;width: 250px;border-radius: 50%;" /></center>
                            </div>                              
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready( function(){
    var gender = $("#h_g").val();
    var cs = $("#h_cs").val();
    $("#t_gender").val(gender);
    $("#t_civil_status").val(cs);
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
$("#updatePhoto_form").on('submit',(function(e) {
	e.preventDefault();

	$("#submit").prop('disabled', true);
	$("#submit").html("<span class='fa fa-spinner'></span> Adding ...");
	$.ajax({
		type:"POST",
		url:"ajax/updatePhoto.php",
		data: new FormData(this),
		contentType: false,
    	cache: false,
		processData:false,
		success: function(data){
			closeModal('exampleModal');
			//alert(data);
			if(data == 1){
				 swal("Good!", "Profile Picture Successfully Changed!", "success");
			}else{
				 swal("Error!", "Unable to proccess!", "error");
			}
			$('#updatePhoto_form').each(function(){
				this.reset();
			});
			setTimeout(function(){ location.reload(); }, 2000);
			
			$("#submit").prop('disabled', false);
			$("#submit").html("<span class='fa fa-plus-circle'></span> SAVE");
		}
	});
}));
$('#updateProfile_form').submit(function(e){

    $("#btn-submit").prop("disabled",true);
    $("#btn-submit").html("<span class='fa fa-spin fa-spinner'></span> Loading...");

    e.preventDefault();
    $.ajax({
        type:"POST",
        url:"ajax/update_prof_t.php",
        data:$('#updateProfile_form').serialize(),
        success:function(data){
            // alert(data);
            if(data == 1){
                swal("Hey, Good job !!", "Your profile successfully updated!!", "success");
            }else{
                sweetAlert("Oops...", "Something went wrong !!", "error");
                setTimeout(function(){ location.reload(); }, 2000);
            }
            $("#btn-submit").prop("disabled",false);
            $("#btn-submit").html("<span class='fa fa-check-circle'></span> Update Profile");
        }
    });
    
});
function removeDegree(id){
    swal({
        title: "Are you sure to remove this degree?",
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
            var data = "degree_id = "+id;
            $.post("ajax/deleteData.php",{
                id:id,
                data:data,
                table:"tbl_degree"
            },function (data,status){
                if(data == 1){
                    success_delete();
                }else if(data == 2){
                    swal("Oops!", "Unable to delete "+name+" !", "warning");
                }else{
                    error_delete();
                }
                setTimeout(function(){
                    location.reload();
                },1500);
            });
        }
        else {
            error_delete();
        }
    });
}
function addDegree(){
    var degree_name = $("#degree_name").val();
    var course = $("#course").val();
    var school = $("#school").val();
    var year_grad = $("#year_grad").val();
    // alert(degree_name+" "+course+" "+school+" "+year_grad);
    if(degree_name == "" || course == "" || school == "" || year_grad == ""){
        swal("Oops!", "Complete data first", "warning");
    }else{
        $.post("ajax/addNewTeacherDegree.php",{
            degree_name:degree_name,
            course:course,
            school:school,
            year_grad:year_grad
        },function(data,status){
            if(data == 1){
                swal("Nice!", "New degree added", "success");
            }else{
                swal("Oops!", "Error occur while adding", "error");
            }
            setTimeout(function(){
                location.reload();
            },1500);
        });
    }
}
function updateDegree_d(id,field){
    var data = $("#"+field+"-"+id).val();
    var table = "tbl_degree";
    var setter = "SET "+field+" = '"+data+"'";
    var param = "WHERE degree_id = "+id;
    var query = "UPDATE "+table+" "+setter+" "+param;
    // alert(query);
    $.post("ajax/queryFile.php",{
        sql:query
    },function(data,status){
    });
}
function saveToDatabase(editableObj,id,field) {
    var data = editableObj.innerHTML;
    var table = "tbl_degree";
    var setter = "SET "+field+" = '"+data+"'";
    var param = "WHERE degree_id = "+id;
    var query = "UPDATE "+table+" "+setter+" "+param;
    // alert(query);
    $.post("ajax/queryFile.php",{
        sql:query
    },function(data,status){
    });
}
</script>