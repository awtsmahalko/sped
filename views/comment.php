<?php
$announce_id = $_GET['id'];
$row_post = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_announcement` WHERE announce_id = $announce_id"));
?>
<style type="text/css">

.detailBox {
    width:80%;
    border:1px solid #bbb;
    margin:50px;
}
.titleBox {
    background-color:#fdfdfd;
    padding:10px;
}
.titleBox label{
  color:#444;
  margin:0;
  display:inline-block;
}

.commentBox {
    padding:10px;
    border-top:1px dotted #bbb;
}
.commentBox .form-group:first-child, .actionBox .form-group:first-child {
    width:80%;
}
.commentBox .form-group:nth-child(2), .actionBox .form-group:nth-child(2) {
    width:18%;
}
.actionBox .form-group * {
    width:100%;
}
.taskDescription {
    margin-top:10px 0;
}
.commentList {
    padding:0;
    list-style:none;
/*    max-height:400px;
    overflow:auto;*/
}
.commentList li {
    margin:0;
    margin-top:10px;
}
.commentList li > div {
    display:table-cell;
}
.commenterImage {
    width:30px;
    margin-right:5px;
    height:100%;
    float:left;
}
.commenterImage img {
    width:100%;
    border-radius:50%;
}
.commentText p {
    margin:0;
}
.sub-text {
    color:#aaa;
    font-family:verdana;
    font-size:11px;
}
.actionBox {
    border-top:1px dotted #bbb;
    padding:10px;
}



.comment-box.first {
    border-top: none;
    padding-top: 10px;
}
.comment-box .avatar {
    float: left;
    overflow: hidden;
}
.comment-box .avatar .image-container {
    border-radius: 50%;
    margin-left: 5px;
    width: 50px;
    height: 50px;
/*    overflow: hidden;*/
    background-color: #f4f4f4;
}
.comment-box .payload {
    margin-left: 60px;
}
.comment-box.indent-1 .payload .textarea-container textarea, .comment-box .payload .textarea-container textarea.focus {
    height: 50px;
    cursor: text;
    border-bottom: none;
}
div {
    outline: none;
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
}
textarea {
    -webkit-appearance: textarea;
    background-color: white;
    -webkit-rtl-ordering: logical;
    flex-direction: column;
    resize: auto;
    width: 99%;
    cursor: text;
    white-space: pre-wrap;
    word-wrap: break-word;
    border-width: 1px;
    margin-bottom: unset;
    border-style: solid;
    border-image: initial;
    padding: 2px;
}
.comment-box .action {
    height: auto;
}
.comment-box .action {
    margin-top: unset;
    width: 99%;
    height: 40px;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-top-color: #eee;
}
a.cmnt-btn.size-30 {
    font-size: 12px;
    padding: 4px 15px;
}
a.cmnt-btn {
    color: #fff;
    background-color: #09f;
    padding: 9px 20px;
    border: 1px solid #09f;
    border-radius: 3px;
    font: 700 14px/20px Helvetica Neue,Arial,Helvetica,Geneva,sans-serif;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
    -webkit-appearance: none;
}
</style>

<input type="hidden" id="announce_id" value="<?=$announce_id?>">
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="detailBox" style="color: #333">
                <div class="titleBox" style="color: #333">
                  <strong>Posted on : <?=date("F d, Y h:i A",strtotime($row_post['date_added']))?></strong>
                </div>
                <div class="commentBox">
                    <pre style='white-space: pre-wrap;word-wrap: break-word;'><p class="taskDescription" style="color: #333"><?=substr($row_post['text'], 5,-6)?></p></pre>
                </div>
                <hr style="border:1px solid #d4cbcb;">
                <div class="comment-box first">
                    <div class="avatar">
                        <div class="image-container">
                            <a>
                                <img src="pictures/<?=$_SESSION['img']?>" style="width: 50px;height: 50px;border-radius: 50%;">
                            </a>
                        </div>
                    </div>
                    <div class="payload"><!---->
                         <div class="textarea-container">
                            <div>
                                <textarea placeholder="Write comments..." class="post-text-area focus" id="comment" ></textarea> <!---->
                            </div>
                        </div> <!----> 
                        <div class="action">
                            <div class="rhs" style="float: right;">
                                <a href="javascript:void(0);" class="cmnt-btn size-30 submit-comment" onclick="addComment()">Comment</a>
                            </div>
                        </div> <!---->
                    </div> 
                    <div class="clearfix"></div>
                </div>
                <div class="actionBox">
                    <ul class="commentList">
                        <?php
                        $get_all_coment = mysql_query("SELECT * FROM `tbl_response` WHERE announce_id = $announce_id ORDER BY date_added ASC");
                        while ($row_coment = mysql_fetch_array($get_all_coment)){
                            if($row_coment['user_type'] == 0){
                                $fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_principal WHERE p_id = '".$row_coment['user_id']."'"));
                                $post_img = "$fetch_p[img]";
                            }else if($row_coment['user_type'] == 1){
                                $fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = '".$row_coment['user_id']."'"));
                                $post_img = "$fetch_p[img]";
                            }else if($row_coment['user_type'] == 2){
                                $fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = '".$row_coment['user_id']."'"));
                                $post_img = "$fetch_p[img]";
                            }else{
                                $tbl = "#";
                            }
                                $user_id = $row_coment['user_id'];
                                $user_type = $row_coment['user_type'];
                                if(($user_id == $_SESSION['account_id']) && ($user_type == $_SESSION['user_type'])){
                                    $button_show = "<span class='fa fa-times-circle' style='color:#948e8e;cursor:pointer;' onclick='deleteComment($row_coment[0])'></span>";
                                }else{
                                    $button_show = "";
                                }
                            ?>
                        <li>
                            <div style="float: right;"><?=$button_show;?></div>
                            <div class="commenterImage">
                              <img src="pictures/<?=$post_img?>" style="height: 30px;width: 30px;">
                            </div>
                            <div class="commentText">
                                <pre style='white-space: pre-wrap;word-wrap: break-word;'><p style="color: #333"><?=substr($row_coment['comment'], 5,-6)?></p></pre>
                                <span class="date sub-text">on <?=date("F d, Y h:i A",strtotime($row_coment['date_added']))?></span>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
<!--                     <div class="form-inline">
                        <div class="form-group">
                            <input type="hidden" id="announce_id" value="<?=$announce_id?>">
                            <textarea class="form-control" id="comment" type="text" rows="5" placeholder="Your comments"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" onclick="addComment()">Add</button>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<link href="css/lib/sweetalert/sweetalert.css" rel="stylesheet">
<script src="js/lib/sweetalert/sweetalert.min.js"></script>

<script type="text/javascript">
function addComment(){
    var comment = $("#comment").val();
    var announce_id = $("#announce_id").val();
    if ( $.trim( comment ) == '' ){
        swal("Error!", "Unable to comment no text found!", "error");
    }else{
        $.post("ajax/addNewComment.php",{
            announce_id:announce_id,
            comment:comment
        },function(data,status){
            swal("Good!", "Added New Comment!", "success");
            setTimeout( function(){
                location.reload();
            }, 2000);
            // alert(data);
            ;
        });
    }
}
    function deleteCommentNow(id){
      $.post("ajax/deleteClassData.php",{
          id:id,
          field:"response_id",
          table:"tbl_response"
      },function (data,status){
        location.reload();
      });
    }
    function deleteComment(id){
        swal({
            title: "Are you sure to delete comment?",
            text: "You will not be able to recover this comment !!",
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
                deleteCommentNow(id);
            }
            else {
                error_delete();
            }
        });
    }
</script>