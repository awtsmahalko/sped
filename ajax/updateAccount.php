<?php
include '../core/config.php';

$username = clean($_POST['username']);
$password = clean($_POST['password']);

$query = mysql_query("UPDATE tbl_user SET username = '$username', password = '".md5($password)."' WHERE user_id = ".$_SESSION['user_id']);
if($query){
	echo 1;
}else{
	echo 0;
}