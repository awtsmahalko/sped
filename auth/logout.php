<?php 
require_once '../core/config.php';

unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['user_type']);
unset($_SESSION['account_id']);
unset($_SESSION['error']);
session_destroy();
header("Location: ../index.php");