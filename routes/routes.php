<?php
	if($page == md5('dashboard')){
		require view.'dashboard.php';
	}else if($page == md5('comment')){
		require view.'comment.php';
	}else if($page == md5('teacher')){
		require view.'teacher.php';
	}else if($page == md5('account')){
		require view.'account.php';
	}else if($page == md5('subject')){
		require view.'subject.php';
	}else if($page == md5('student')){
		require view.'student.php';
	}else if($page == md5('p-student')){
		require view.'p_student.php';
	}else if($page == md5('class')){
		require view.'class.php';
	}else if($page == md5('class-load')){
		require view.'class_load.php';
	}else if($page == md5('class-subject')){
		require view.'class_subject.php';
	}else if($page == md5('class-quiz')){
		require view.'class_quiz.php';
	}else if($page == md5('assessment')){
		require view.'assessment.php';
	}else if($page == md5('stu-subject')){
		require view.'stu_subject.php';
	}else if($page == md5('stu-take-quiz')){
		require view.'stu_take_quiz.php';
	}else if($page == md5('stu-view-quiz')){
		require view.'stu_view_quiz.php';
	}else if($page == md5('f-result')){
		require view.'f_result.php';
	}else if($page == md5('f-eval-sub')){
		require view.'f_eval_sub.php';
	}else if($page == md5('f-eval-quiz')){
		require view.'f_eval_quiz.php';
	}else if($page == md5('prof-p')){
		require view.'prof_p.php';
	}else if($page == md5('prof-t')){
		require view.'prof_t.php';
	}else if($page == md5('prof-s')){
		require view.'prof_s.php';
	}else if($page == md5('quiz-result')){
		require view.'quiz_result.php';
	}else if($page == md5('settings')){
		require view.'settings.php';
	}else if($page == md5('stu-dashboard')){
		require view.'stu_dashboard.php';
	}else{
		if(!empty($page) or $page != $page){
			require view.'error/error.php';
		}else{
			require view.'dashboard.php';
		}
	}
	
 ?>
