<?php
include '../core/config.php';
$user_id = $_SESSION['account_id'];
$user_type = $_SESSION['user_type'];

$sql = mysql_query("SELECT * FROM `tbl_announcement` ORDER BY date_added DESC");
$count_post = mysql_num_rows($sql);
if($count_post > 0){
	$content = "";
	while ($row = mysql_fetch_array($sql)) {
		if($row['user_type'] == 0){
			$fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_principal WHERE p_id = '".$row['user_id']."'"));
		    $post_name = "$fetch_p[p_lname], $fetch_p[p_fname] $fetch_p[p_mname]";
		    $post_img = "$fetch_p[img]";
		    $post_d = "$fetch_p[p_position]";
		}else if($row['user_type'] == 1){
			$fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = '".$row['user_id']."'"));
		    $post_name = "$fetch_p[stu_lname], $fetch_p[stu_fname] $fetch_p[stu_mname]";
		    $post_img = "$fetch_p[img]";
		    $post_d = "Student - $fetch_p[stu_special]";
		}else if($row['user_type'] == 2){
			$fetch_p = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = '".$row['user_id']."'"));
		    $post_name = "$fetch_p[t_lname], $fetch_p[t_fname] $fetch_p[t_mname]";
		    $post_img = "$fetch_p[img]";
		    $post_d = "Teacher";
		}else{
		    $tbl = "#";
		}

		$count_comment = mysql_fetch_array(mysql_query("SELECT COUNT(announce_id) FROM tbl_response WHERE announce_id = $row[0]"));
		$user_id = $row['user_id'];
		$user_type = $row['user_type'];
		if(($user_id == $_SESSION['account_id']) && ($user_type == $_SESSION['user_type'])){
			$text = substr($row['text'], 5,-6);
			$button_show = "<span class='fa fa-times-circle' style='color:#948e8e;cursor:pointer;' onclick='deletePost($row[0])'></span>";
			//<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#update_modal_post' onclick=\"updatePost($row[0],'$text')\"><span class='fa fa-edit'></span></button>
		}else{
			$button_show = "";
		}
		$content .= "
		        <div class='col-sm-12'>
                    <div class='panel panel-white post panel-shadow'>
                        <div class='post-heading'>
                            <div class='pull-left image'>
                                <img src='pictures/".$post_img."' class='img-circle avatar' alt='user profile image'>
                            </div>
                            <div class='pull-left meta'>
                                <div class='title h5'>
                                    <a href='#'><b>".strtoupper($post_name)."</b></a>
                                    ($post_d)
                                </div>
                                <h6 class='text-muted time'>".date("F d, Y h:i A",strtotime($row['date_added']))."</h6>
                            </div>

                            <div class='pull-right meta'>
                                $button_show
                            </div>
                        </div> 
                        <div class='post-description'> 
                            <pre style='white-space: pre-wrap;word-wrap: break-word;'><p style='color:#2a2c2d'>".substr($row['text'], 5,-6)."</p></pre>
                            <div class='stats'>
                                <a href='index.php?page=".md5('comment')."&id=$row[0]' class='btn btn-default stat-item'>
                                    <i class='fa fa-comment'></i> $count_comment[0] Comments
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
	}
	echo $content;
}else{
	echo "No Post Found!";
}