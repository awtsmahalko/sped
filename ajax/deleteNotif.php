<?php
include '../core/config.php';
$id = $_POST['id'];
mysql_query("DELETE FROM tbl_notification WHERE notif_id = $id");
?>