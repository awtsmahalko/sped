<?php 
require_once '../core/config.php';

if(isset($_SESSION['user_id'])){
	header("Location: ../index.php");
	exit;
}

if(isset($_POST['userlogin'])){
	$result = processLogin();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>BCSCEA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background: url(../images/sped.jpg) no-repeat center center fixed;-webkit-background-size: cover !important;-moz-background-size: cover !important; -o-background-size: cover !important;background-size: cover !important;">
			<div class="wrap-login100 p-l-80 p-r-80 p-t-20 p-b-20 animated zoomIn show">
				<form method='POST' class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						<center><img src='../images/customLogo.png' style="border-radius: 50%;"></center>
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="userlogin" placeholder="Username" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="userpassword" placeholder="Password" autocomplete="off">
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button style='margin-left:auto;margin-right:auto;' class="login100-form-btn" type="submit" name='submit'>
							Login
						</button>
					</div>
					<div class="flex-sb-m w-full p-b-48">
						<div style='margin-left:auto;margin-right:auto;'>
							<span style="text-align:center;font-size:12px;">
							<?php
								echo '<br>';
								if(isset($_SESSION['error'])){
									$message = $_SESSION['error'];
									if(!empty($message)){
										echo '<div id="warning" class="animated shake" style="color:#c62828; margin-top: 3px; margin-bottom: 3px;" class="isa_error">
												<i class="fa fa-times-circle"></i>
												'.$message.'
											</div>';
									}
								}
							?>
							</span>
						</div>
					</div>
				</form>
			</div>
			<div class="wrap-login100 p-l-80 p-r-80 p-t-20 p-b-20 animated zoomIn show" style="width: 60%;margin-left: 5%;    background: #000000b5">
				<center>
					<h5 style="color: white;">
						<strong>BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT"</strong>
					</h5>
				</center>
				<h5 style="color: green;margin-top: 15px;"><strong>VISION</strong></h5>
				<p style="margin-top: 5px; color: #fff"><i>We dream of Filipinos who passionately love their country and whose competencies and values enable them to realize their full potential and contribute meaningfully to building the nation.<br>As a learner-centered public institution, the Department of Education continously improves itself to better serve its stakeholders.</i>

				<h5 style="color: green;margin-top: 15px;"><strong>MISSION</strong></h5>
				<p style="margin-top: 5px; color: #fff"><i>To protect and promote the right of every Filipino to quality, equitable, culture-based and complete basic education where:<br>
					-Students learn in a child-friendly,gender sensitive,safe, and motivating environment.<br>
				-Teacher facilitate learning and constantly nurture every learner.</i>
				</p>

				<h5 style="color: green;margin-top: 15px;"><strong>CORE VALUES</strong></h5>
				<p style="margin-top: 5px; color: #fff"><i>
	               - Maka-Diyos<br>
	               - Makatao<br>
	               - Makabayan<br>
	               - Makakalikasan</i>
				</p>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>