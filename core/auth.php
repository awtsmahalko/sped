<?php
function checkLoginStatus(){
	if (!isset($_SESSION['user_id'])){
		header("Location: auth/login.php");
		exit;
	}

}

function clean($str) {
        $str = @trim($str);
        if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
        }
        return mysql_real_escape_string($str);
}

function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

function processLogin(){

		$userlogin = clean($_POST['userlogin']);

		if(passwordHashing == true)
		{
			$userpassword =  md5($_POST['userpassword']);
		}else
		{
			$userpassword = clean($_POST['userpassword']);
		}

	$query = "SELECT * FROM ";
	$query .= table;
	$query .=" WHERE username = '$userlogin' AND password = '$userpassword'";

	$result = mysql_query($query) or die (mysql_error());

	if(mysql_num_rows($result) == 1){
		$row = mysql_fetch_assoc($result);
		if($row['user_status'] == 1){
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $_POST['userpassword'];
			$_SESSION['user_type'] = $row['user_type'];
			$_SESSION['account_id'] = $row['account_id'];
			if($row['user_type'] == 1){
				$tbl = "tbl_student";
				$my_f = "stu_id";
				$lname = "stu_fname";
				$gender = "stu_gender";
			}else if($row['user_type'] == 2){
				$tbl = "tbl_teacher";
				$my_f = "t_id";
				$lname = "t_lname";
				$gender = "t_gender";
			}else{
				$tbl = "tbl_principal";
				$my_f = "p_id";
				$lname = "p_lname";
				$gender = "p_gender";
			}
			$img = mysql_fetch_array(mysql_query("SELECT img,$lname,$gender FROM $tbl WHERE $my_f = ".$row['account_id']));
			$_SESSION['img'] = $img[0];
			$_SESSION['lname'] = ucfirst(strtolower($img[1]));
			$_SESSION['pre'] = ($img[2] == 1)?"Mr.":"Ms.";
			header("Location:../index.php?q=1");
			exit;
		}else{
			$_SESSION['error']  = "Sorry account was deactivated!";
			header("Location:../auth/login.php");
			exit;
		}
	}else {
		$_SESSION['error']  = error_message;
		header("Location:../auth/login.php");
		exit;
	}

}
