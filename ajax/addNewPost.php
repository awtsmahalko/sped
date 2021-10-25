<?php
include '../core/config.php';
date_default_timezone_set("Asia/Manila");
$user_id = $_SESSION['account_id'];
$user_type = $_SESSION['user_type'];
$text = "<pre>".clean($_POST['text'])."</pre>";
$date_added = date("Y-m-d H:i:s");
$query = mysql_query("INSERT INTO `tbl_announcement`(`announce_id`, `user_id`, `user_type`, `text`, `date_added`) VALUES (NULL,'$user_id','$user_type','$text','$date_added')");
if($query){
	echo 1;
}else{
	echo 0;
}