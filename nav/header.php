<?php $my_notif = mysql_query("SELECT * FROM tbl_notification WHERE user_type = ".$_SESSION['user_type']." AND user_id = ".$_SESSION['account_id']); ?>
<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- Logo -->
        <div class="navbar-header">
            <a class="navbar-brand" style="margin-left:5px;padding: 2px;">
                <!-- Logo icon -->
                <!--End Logo icon -->
                <!-- Logo text -->
                <img src="images/customLogo.png" alt="user" style="width: 60px;height: 60px;border-radius: 50%;" />
                <span style='color: #fff;font-weight: bold;font-size: 26px;'>BACOLOD CITY SPED CENTER (EVALUATION AND ASSESMENT)</span>
            </a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse">
            <!-- toggle and nav items -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted  " href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                <!-- Messages -->
                <!-- End Messages -->
            </ul>
            <!-- User profile and search -->
            <ul class="navbar-nav my-lg-0">

                <!-- Comment -->
                <li class="nav-item dropdown">
                    <?php if(mysql_num_rows($my_notif) > 0){?>
                    <a class="nav-link dropdown-toggle text-muted text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" style="font-size: 20px;"></i>
                        <span class="label label-rouded label-danger pull-right"> <?=mysql_num_rows($my_notif)?></span>
						
					</a>
                    <?php } ?>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated zoomIn">
                        <ul>
                            <li>
                                <div class="drop-title">Notifications</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <!-- Message -->
                                    <?php while($row_notif = mysql_fetch_array($my_notif)){?>
                                        <a href="index.php?page=<?=$row_notif['link']?>" onclick="deleteNotif(<?=$row_notif[0]?>)">
                                            <div class="btn btn-danger btn-circle m-r-10"><i class="fa fa-link"></i></div>
                                            <div class="mail-contnet">
                                                <h5 style="color:#6610f2;"><?=$row_notif['title']?></h5> <span class="mail-desc" style="color:green;"><i><?=$row_notif['message']?></i></span> <span class="time"><?= date("F d, Y H:i A",strtotime($row_notif['date_added']))?></span>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- End Comment -->
                <?php
                if($_SESSION['user_type'] == 0){
                    $prof_link = "index.php?page=".md5('prof-p');
                }else if($_SESSION['user_type'] == 1){
                    $prof_link = "index.php?page=".md5('prof-s');
                }else if($_SESSION['user_type'] == 2){
                    $prof_link = "index.php?page=".md5('prof-t');
                }else{
                    $prof_link = "#";
                }
                ?>
                <!-- Profile -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="pictures/<?=$_SESSION['img']?>" alt="user" style="width: 40px;height: 40px;border-radius: 50%;" /></a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown-user">
                            <li><a href="<?=$prof_link?>"><i class="ti-user"></i> Profile</a></li>
                            <li><a href="index.php?page=<?=md5('account')?>"><i class="ti-settings"></i> Account</a></li>
                            <li><a href="auth/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>