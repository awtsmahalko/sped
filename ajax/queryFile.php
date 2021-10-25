<?php
include '../core/config.php';

$sql = $_POST['sql'];

$query = mysql_query($sql);
if($query){
	echo 1;
}else{
	echo 0;
}