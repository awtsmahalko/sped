<?php
include 'core/config.php';
checkLoginStatus();
$page = (isset($_GET['page']) && $_GET['page'] !='') ? $_GET['page'] : '';
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <title>BCSC EA
            <?= date('Y');?>
        </title>
        <!-- Bootstrap Core CSS -->
        <script src="js/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/lib/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/lib/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>
        <script src="js/lib/datatables/datatables.min.js"></script>
        <script src="js/lib/select2/select2.full.min.js"></script>

        <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
        <link href="css/lib/select2/select2.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:** -->
        <!--[if lt IE 9]>
    <script src="https:**oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https:**oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
        <style>
            #myTable {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            }

            #myTable td,
            #myTable th {
                border: 1px solid #ddd;
                padding: 2px;
            }

            #myTable tr:hover {
                background-color: #ddd;
            }

            #myTable th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #5c4ac6;
                color: white;
            }
			::-webkit-scrollbar { 
				display: none; 
			}
            .select2-container--default .select2-selection--single {
                border-radius: 0px;
            }

            .select2-container .select2-selection--single {
                height: 35px;
            }
        </style>
    </head>

    <body class="fix-header fix-sidebar">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <!-- header header  -->
            <?php include 'nav/header.php';?>
            <!-- End header header -->
            <!-- Left Sidebar  -->
            <?php include 'nav/sidebar.php';?>
            <!-- End Left Sidebar  -->
            <!-- Page wrapper  -->
            <?php require_once 'routes/routes.php'; ?>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        <!-- All Jquery -->
        <script type='text/javascript'>
            $('.select2').select2();
            function success_delete() {
                swal("Deleted !!", "Hey, your record has been deleted !!", "success");
            }

            function error_delete() {
                swal("Cancelled !!", "Hey, your record is safe !!", "error");
            }
			function closeModal(text){
				$("#"+text).hide();
				$('.modal-backdrop').hide();
			}
            function deleteNotif(id) {
                $.post("ajax/deleteNotif.php",{
                    id:id
                },function(data,status){
                });
            }
        </script>
    </body>

    </html>