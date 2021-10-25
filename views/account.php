<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Password Verification!</h4>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="hidden_pass" value="<?= $_SESSION['password']?>">
                        <div class="form-body">
                            <h3 class="card-title m-t-15">Account Info</h3>
                            <hr>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Username</label>
                                        <input type="text" id="username" class="form-control" value="<?= $_SESSION['username'];?>">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Current Password</label>
                                        <input type="password" id="curr_pass" class="form-control form-control-danger" onkeyup="checkCurrPass()">
                                        <small class="form-control-feedback" id="curr-label"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" id="cp" style="display: none;">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Update Username and Password!</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <h3 class="card-title m-t-15">Change Password!</h3>
                            <hr>
                            <div class="row p-t-5">
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">New Password</label>
                                        <input type="password" id="new_pass1" class="form-control form-control-danger" onkeyup="checkMatch()">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-12">
                                    <div class="form-group has-danger">
                                        <label class="control-label">Repeat New Password</label>
                                        <input type="password" id="new_pass2" class="form-control form-control-danger" onkeyup="checkMatch()">
                                        <small class="form-control-feedback" id="match-label"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" id="act" style="display: none;">
                            <button type="submit" class="btn btn-success" onclick="updateAccount()"> <i class="fa fa-edit"></i> Update Changes!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->
   <footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
    <!-- End footer -->
</div>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
function checkCurrPass(){
    var hidden = $("#hidden_pass").val();
    var curr = $("#curr_pass").val();
    if(hidden == curr){
        $("#curr-label").html("<span style='color:green'><span class='fa fa-check-circle'></span> Good! You entered Current Password!</span>");
        $("#cp").show();
    }else{
        $("#curr-label").html("<span style='color:red'><span class='fa fa-warning'></span> Oops! This is not your Current Password!</span>");
        $("#cp").hide();
    }
}
function checkMatch(){
    var np1 = $("#new_pass1").val();
    var np2 = $("#new_pass2").val();
    if(np1 == "" || np2 == ""){
        $("#act").hide();
    }else{
        if(np1 == np2){
            $("#match-label").html("<span style='color:green'><span class='fa fa-check-circle'></span> Good! Password Match</span>");
            $("#act").show();
        }else{
            $("#match-label").html("<span style='color:red'><span class='fa fa-warning'></span> Oops! Password does not match!</span>");
            $("#act").hide();
        }
    }
}
function updateAccount() {
    var password = $("#new_pass1").val();
    var username = $("#username").val();
    $.post("ajax/updateAccount.php",{
        username:username,
        password:password
    },function(data,status){
        if(data == 1){
            swal({
                title: "Account successfully updated!",
                text: "You will be redirect to login page!!",
                timer: 2000,
                showConfirmButton: false
            },function() {
                window.location = "auth/logout.php";
            });
        }else{
            sweetAlert("Oops...", "Something went wrong !!", "error");
        }
    });
}
</script>