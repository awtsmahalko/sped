<style type="text/css">
.panel-shadow {
    box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
}
.panel-white {
  border: 1px solid #dddddd;
}
.panel-white  .panel-heading {
  color: #333;
  background-color: #fff;
  border-color: #ddd;
}
.panel-white  .panel-footer {
  background-color: #fff;
  border-color: #ddd;
}

.post .post-heading {
  height: 95px;
  padding: 20px 15px;
}
.post .post-heading .avatar {
  width: 60px;
  height: 60px;
  display: block;
  margin-right: 15px;
}
.post .post-heading .meta .title {
  margin-bottom: 0;
}
.post .post-heading .meta .title a {
  color: black;
}
.post .post-heading .meta .title a:hover {
  color: #aaaaaa;
}
.post .post-heading .meta .time {
  margin-top: 8px;
  color: #999;
}
.post .post-image .image {
  width: 100%;
  height: auto;
}
.post .post-description {
  padding: 15px;
}
.post .post-description p {
  font-size: 14px;
}
.post .post-description .stats {
  margin-top: 20px;
}
.post .post-description .stats .stat-item {
  display: inline-block;
  margin-right: 15px;
}
.post .post-description .stats .stat-item .icon {
  margin-right: 8px;
}
.post .post-footer {
  border-top: 1px solid #ddd;
  padding: 15px;
}
.post .post-footer .input-group-addon a {
  color: #454545;
}
.post .post-footer .comments-list {
  padding: 0;
  margin-top: 20px;
  list-style-type: none;
}
.post .post-footer .comments-list .comment {
  display: block;
  width: 100%;
  margin: 20px 0;
}
.post .post-footer .comments-list .comment .avatar {
  width: 35px;
  height: 35px;
}
.post .post-footer .comments-list .comment .comment-heading {
  display: block;
  width: 100%;
}
.post .post-footer .comments-list .comment .comment-heading .user {
  font-size: 14px;
  font-weight: bold;
  display: inline;
  margin-top: 0;
  margin-right: 10px;
}
.post .post-footer .comments-list .comment .comment-heading .time {
  font-size: 12px;
  color: #aaa;
  margin-top: 0;
  display: inline;
}
.post .post-footer .comments-list .comment .comment-body {
  margin-left: 50px;
}
.post .post-footer .comments-list .comment > .comments-list {
  margin-left: 50px;
}

.clockdate-wrapper {
    background-color: #333;
    padding:25px;
    width:100%;
    text-align:center;
    border-radius:5px;
    margin:0 auto;
    margin-top:5%;
}
#clock{
    background-color:#333;
    font-family: sans-serif;
    font-size:60px;
    text-shadow:0px 0px 1px #fff;
    color:#fff;
}
#clock span {
    color:#888;
    text-shadow:0px 0px 1px #333;
    font-size:30px;
    position:relative;
    top:-27px;
    left:-10px;
}
#date {
    letter-spacing:10px;
    font-size:14px;
    font-family:arial,sans-serif;
    color:#fff;
}
</style>
<?php
if($_SESSION['user_type'] == 1){
  echo "<script>window.location = 'index.php?page=".md5('stu-dashboard')."';</script>";
}
date_default_timezone_set('Asia/Manila');
$Hour = date('G');

if ( $Hour >= 5 && $Hour <= 11 ) {
    $day_g = "Good Morning";
} else if ( $Hour >= 12 && $Hour <= 18 ) {
    $day_g = "Good Afternoon";
} else if ( $Hour >= 19 || $Hour <= 4 ) {
    $day_g = "Good Evening";
}
if(isset($_GET['q'])){
  if($_GET['q'] == 1){
      $greetings = $day_g.", ".$_SESSION['pre']." ".$_SESSION['lname'].".";
  }else{
      $greetings ="";
  }
}else{
  $greetings = "";
}

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7" style="max-height: 600px;overflow: auto;">
                <div class="col-md-12" style="padding: 5px;margin-bottom: 5px;">
                    <br>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleTextarea"><b><?=$day_g."! ".$_SESSION['pre']." ".$_SESSION['lname']?> ,post something!</b></label>
                            <textarea style="height: 100px;" class="form-control" id="exampleTextarea" rows="5" placeholder="Let everyone knows your annoucement! &#10;Never bother to ask!&#10;Post something now!"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div style="float: right;">
                            <!-- <button class="btn btn-secondary btn-sm">Post</button> -->
                            <div class="btn-group" role="group">
                                <button onclick="postNow()" type="button" class="btn btn-success">POST</button>
                            </div>
                        </div>
                    </div>
                </div><br>
                <hr>
                <div class="col-md-12" style="margin-top: 15px;" id="post-id">
                </div>
            </div>
            <div class="col-lg-5">
              <div id="clockdate">
                <div class="clockdate-wrapper">
                  <div id="clock"></div>
                  <div id="date"></div>
                </div>
              </div>
              <?php if(getCurrentSY() > 0){ ?>
                <div class="card bg-dark">
                    <div class="testimonial-widget-one p-17">
                        <div class="testimonial-widget-one owl-carousel owl-theme">
                            <div class="item">
                                <div class="testimonial-content">
                                    <div class="testimonial-author">CURRENT SCHOOL YEAR</div>
                                    <div class="testimonial-text">
                                        <span style="font-size: 50px;"><?=getCurrentSY()."- ".(getCurrentSY()+1);?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-dark">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-users f-s-40"></i></span>
                        </div>
                        <div class="media-body media-text-right" style="color: #fff">
                            <h2 style="color: #fff"><?=getEnrolled(getCurrentSY())?></h2>
                            <p class="m-b-0">Enrolled Students</p>
                        </div>
                    </div>
                </div>
              <?php }else{ ?>
                <div class="card bg-dark">
                    <div class="testimonial-widget-one p-17">
                        <div class="testimonial-widget-one owl-carousel owl-theme">
                            <div class="item">
                                <div class="testimonial-content">
                                    <div class="testimonial-author">NO SCHOOL YEAR FOUND</div>
                                    <div class="testimonial-text">
                                        <a href="index.php?page=<?=md5('settings')?>">Click here to add new School Year</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                  <div class="card bg-dark">
                    <h4 class="card-title" style="color: #fff">BIRTH MONTH</h4>
                    <h6 class="card-subtitle" style="color: #fff">List of Student born on <?=date('F')?>.</h6>
                    <ul class="list-icons">
                      <?php
                      $MONTH = date('m');
                        $get_stu_b = mysql_query("SELECT stu_id,stu_bdate FROM `tbl_student` WHERE MONTH(stu_bdate) = '$MONTH'");
                        if(mysql_num_rows($get_stu_b) > 0){
                          while ($row_b = mysql_fetch_array($get_stu_b)) {
                      ?>
                        <li><a href="javascript:void(0)" style="color: #26dad2;"><i class="fa fa-check text-info"></i> <?=getStudentName($row_b[0])?></a></li>
                      <?php } }else{?>
                        <strong><span class='label label-rouded label-danger'><span class="fa fa-exclamation"></span> No Birthdays Found!</span></strong>
                      <?php }?>
                    </ul>
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
    <div class="modal fade" id="update_modal_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><span style='color:green'>Update Post </span></h5>
          </div>
          <div class="modal-body">
                <input type="hidden" id="announce_id" name="">
                <div class="row">
                    <div class="form-group col-md-12">
                        <textarea style="height: 100px;" id="u_text" class="form-control" rows="5" placeholder="What do you want to post? or Anounce"></textarea>
                    </div>
                </div>
          </div>
          <div class="modal-footer">
            <button id='u_submit' onclick="updatePostNow()" class="btn btn-success"> <span class="fa fa-edit"></span> Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>


<!-- <script src="https://code.responsivevoice.org/responsivevoice.js"></script> -->
<script type="text/javascript">
    $(document).ready( function(){
        getAllPost();
        greetMe('<?=$greetings?>');
        startTime();
    });
    function updatePostNow(){
        var u_id = $("#announce_id").val();
        var u_text = $("#u_text").val();
        if(u_text == ""){
            swal("Error!", "Unable to post no text found!", "error");
        }else{
            $.post("ajax/updatePost.php",{
                text:u_text,
                id:u_id
            },function(data,status){
            closeModal('update_modal_post');
            //alert(data);
                if(data == 1){
                    swal("Good!", "Your post had successfully posted!", "success");
                }else{
                    swal("Error!", "Unable to update post!", "error");
                }
                getAllPost();
            });
        }
    }
    function updatePost(id,text){
        $("#announce_id").val(id);
        $("#u_text").html(text);
    }
    function getAllPost(){
        $.post("ajax/getAllPost.php",{
        },function(data,status){
            // alert(data);
            $("#post-id").html(data);
        });
    }
    function deletePost(id){
        swal({
            title: "Are you sure to delete Post?",
            text: "You will not be able to recover this post !!",
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
                $.post("ajax/deleteClassData.php",{
                    id:id,
                    field:"announce_id",
                    table:"tbl_announcement"
                },function (data,status){
                    if(data == 1){
                        deleteComment(id);
                        success_delete();
                    }else if(data == 2){
                        swal("Oops!", "Unable to delete class post !", "warning");
                    }else{
                        error_delete();
                    }
                    getAllPost();
                });
            }
            else {
                error_delete();
            }
        });
    }
    function postNow(){
        var text = $("#exampleTextarea").val();
        if ( $.trim( text ) == '' ){
            swal("Error!", "Unable to post no text found!", "error");
        }else{
            $.post("ajax/addNewPost.php",{
                text:text
            },function(data,status){
                if(data == 1){
                    swal("Good!", "You had successfully posted!", "success");
                }else{
                    swal("Error!", "Unable to add post!", "error");
                }
                getAllPost();
            });
        }
        $("#exampleTextarea").val("");
    }
    function greetMe(text){
        if(text == ""){
        }else{
            var msg = new SpeechSynthesisUtterance();
            var voice = window.speechSynthesis.getVoices();
            msg.voice = voice["Microsoft David Desktop - English (United States)"];
            // Set the text.
            msg.text = text;
            
            // Set the attributes.
            msg.volume = parseFloat(1);
            msg.rate = parseFloat(1);
            msg.pitch = parseFloat(1);
            
            
            // If a voice has been selected, find the voice and set the
            // utterance instance's voice attribute.
            
            // Queue this utterance.
            var tts = window.speechSynthesis;
            tts.speak(msg);
            // responsiveVoice.speak(text);
            swal(text);
        }
    }
    function deleteComment(id){
      $.post("ajax/deleteClassData.php",{
          id:id,
          field:"announce_id",
          table:"tbl_response"
      },function (data,status){
      });
    }

function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>