<?php
include '../core/config.php';
$id = $_POST['id'];
$text = "<pre>".$_POST['text']."</pre>";
$query = mysql_query("UPDATE `tbl_announcement` SET `text` = '$text' WHERE announce_id = $id");
if($query){
	echo 1;
}else{
	echo 0;
}