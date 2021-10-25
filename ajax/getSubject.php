<?php
include '../core/config.php';
	$account_id = $_SESSION['account_id'];
	if($_SESSION['user_type'] == 2){
		$inject = " AND t_id = $account_id";
	}else{
		$inject = "";
	}
	$id = $_POST['id'];

	$fetch = mysql_query("SELECT * FROM tbl_class_subject WHERE class_id = '$id'$inject") or die (mysql_error());
?>
<option value='0'>&mdash; Select Subject &mdash;</option>
<?php
while($row = mysql_fetch_array($fetch)){
	$sub = getData("sub_code,sub_name","tbl_subject","sub_id = ".$row['s_id']."$inject");
	$text = "[$sub[0]] - $sub[1]";
?>
<option value='<?= $row['s_id']; ?>'><?= strtoupper($text); ?></option>
<?php } ?>