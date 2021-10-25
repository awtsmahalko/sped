<?php
include '../core/config.php';
date_default_timezone_set("Asia/Manila");
$user_id = $_SESSION['account_id'];
$user_type = $_SESSION['user_type'];
$comment = "<pre>".clean($_POST['comment'])."</pre>";
$announce_id = $_POST['announce_id'];
$date_added = date("Y-m-d H:i:s");
$query = mysql_query("INSERT INTO `tbl_response`(`response_id`, `announce_id`, `user_id`, `user_type`, `comment`, `date_added`) VALUES (NULL,'$announce_id','$user_id','$user_type','$comment','$date_added')");
if($query){
	echo 1;
}else{
	echo 0;
}