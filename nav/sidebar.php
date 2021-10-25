<div class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-devider"></li>


				<?php if($_SESSION['user_type'] == 2){
					$teacher_d = mysql_fetch_array(mysql_query("SELECT * FROM tbl_teacher WHERE t_id = ".$_SESSION['account_id']));
				?>
				<center>
					<img src="pictures/<?=$teacher_d['img']?>" alt="user" width="100px" height="100px" style="border-radius:50%" />
					<h4 style="color: #fff;"><?=ucfirst($teacher_d['t_lname']).", ".ucfirst($teacher_d['t_fname']);?></h4>
					<h5 style="color: #fff;"><i>Teacher</i></h5>
				</center>
				<li class="nav-label">Home</li>
				<li> <a href="index.php?page=<?= md5('dashboard');?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Main </span></a></li>
				</li>
				<br>
				<li class="nav-label">MASTER DATA</li>
				<li> <a href="index.php?page=<?= md5('student');?>" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Students Masterlist</span></a></li>
				<li> <a href="index.php?page=<?= md5('subject');?>" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Subject </span></a></li>
				<li> <a href="index.php?page=<?= md5('class');?>" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Class </span></a></li>
				<li> <a href="index.php?page=<?= md5('assessment');?>" aria-expanded="false"><i class="fa fa-th-list"></i><span class="hide-menu">Assessment </span></a></li>
				<!--<li> <a href="index.php?page=<?= md5('f-result');?>" aria-expanded="false"><i class="fa fa-edit"></i><span class="hide-menu">Results </span></a></li> -->
				<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-edit"></i><span class="hide-menu">Evaluation</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="index.php?page=<?= md5('f-eval-sub');?>"> By Subject</a></li>
						<li><a href="index.php?page=<?= md5('f-eval-quiz');?>"> By Quizzes</a></li>
					</ul>
				</li>
				<li> <a href="index.php?page=<?= md5('quiz-result');?>" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu"> Result</span></a></li>
				<?php } ?>


				<?php if($_SESSION['user_type'] == 0){
					$principal_d = mysql_fetch_array(mysql_query("SELECT * FROM tbl_principal WHERE p_id = ".$_SESSION['account_id']));
				?>
				<center>
					<img src="pictures/<?=$principal_d['img']?>" alt="user" width="100px" height="100px" style="border-radius:50%" />
					<h4 style="color: #fff;"><?=ucfirst($principal_d['p_lname']).", ".ucfirst($principal_d['p_fname']);?></h4>
					<h5 style="color: #fff;"><i><?="$principal_d[p_position]";?></i></h5>
				</center>
				<li class="nav-label">Home</li>
				<li> <a href="index.php?page=<?= md5('dashboard');?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Main </span></a></li>
				</li>
				<br>
				<li class="nav-label">MASTER DATA</li>
				<li> <a href="index.php?page=<?= md5('p-student');?>" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Students Masterlist</span></a></li>
				<li> <a href="index.php?page=<?= md5('teacher');?>" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Teacher </span></a></li>
				<li> <a href="index.php?page=<?= md5('class');?>" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Class </span></a></li>
				<li> <a href="index.php?page=<?= md5('assessment');?>" aria-expanded="false"><i class="fa fa-th-list"></i><span class="hide-menu">Assessment </span></a></li>
				<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-edit"></i><span class="hide-menu">Evaluation</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="index.php?page=<?= md5('f-eval-sub');?>"> By Subject</a></li>
						<li><a href="index.php?page=<?= md5('f-eval-quiz');?>"> By Quizzes</a></li>
					</ul>
				</li>
				<li> <a href="index.php?page=<?= md5('quiz-result');?>" aria-expanded="false"><i class="fa fa-file"></i><span class="hide-menu"> Result</span></a></li>
				<li> <a href="index.php?page=<?= md5('settings');?>" aria-expanded="false"><i class="fa fa-gears"></i><span class="hide-menu"> School Year</span></a></li>
				<?php } ?>


				<?php if($_SESSION['user_type'] == 1){
					$current_sy = getCurrentSY();
					$user_id = $_SESSION['account_id'];
					$fetch_t_id = mysql_fetch_array(mysql_query("SELECT t_id FROM tbl_student WHERE stu_id = $user_id"));
					// $fetch_class_id = mysql_fetch_array(mysql_query("SELECT c.class_id FROM `tbl_class_load` AS cl, tbl_class AS c WHERE cl.class_id = c.class_id AND cl.t_id = $fetch_t_id[0] AND cl.stu_id = $user_id ORDER BY c.class_year DESC LIMIT 1"));
					$fetch_class_id = mysql_fetch_array(mysql_query("SELECT c.class_id FROM `tbl_class_load` AS cl, tbl_class AS c WHERE cl.class_id = c.class_id AND cl.t_id = $fetch_t_id[0] AND cl.stu_id = $user_id AND c.class_year = $current_sy"));
					$student_d = getData("img,stu_lname,stu_fname,stu_special","tbl_student","stu_id = '$user_id'");
				?>
				<center>
					<img src="pictures/<?=$student_d[0]?>" alt="user" width="100px" height="100px" style="border-radius:50%" />
					<h4 style="color: #fff;"><?="$student_d[1], $student_d[2]";?></h4>
					<h5 style="color: #fff;"><i>Student (<?=$student_d[3]?>)</i></h5>
				</center>
				<?php
					if($fetch_class_id[0] > 0){
						$class_detail = getData("class_name,class_year","tbl_class","class_id = $fetch_class_id[0]");
				?>
				<li class="nav-label">Home</li>
				<li> <a href="index.php?page=<?= md5('dashboard');?>" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Main </span></a></li>
				</li>
				<br>
				<li class="nav-label"><?= "$class_detail[0] ($class_detail[1] - ".($class_detail[1] + 1).")"; ?></li>
				<?php
					$fetch_sub = mysql_query("SELECT class_id,s_id FROM `tbl_class_subject` WHERE class_id = $fetch_class_id[0]");
					while($row_sub = mysql_fetch_array($fetch_sub)){
						$sub_name = getData("sub_name","tbl_subject","sub_id = $row_sub[1]");
				?>
				<li> <a href="index.php?page=<?= md5('stu-subject')."&".md5('class_id')."=".$row_sub[0]."&".md5('s_id')."=".$row_sub[1];?>" aria-expanded="false"><i class="fa fa-folder"></i><span class="hide-menu"><?= $sub_name[0];?></span></a></li>
				<?php
					}
				}else{
				?>
					<li class="nav-label">No Class Found!</li>
				<?php
					}
				}
				?>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</div>