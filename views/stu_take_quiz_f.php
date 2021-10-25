<?php
$user_id = $_SESSION['account_id'];
$cq_id = $_GET['cq_id'];
$item = $_GET['item_no'];
($item == 1)? $prev = "disabled":$prev = "";
$last_item = countLastItemNo($cq_id);
($last_item <= $item)?$next = "disabled":$next = "";

$get_item_data = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_class_quiz_detail` WHERE cq_id = $cq_id AND item_no = $item"));
$get_stu_item_data = mysql_fetch_array(mysql_query("SELECT * FROM `tbl_stu_quiz_detail` WHERE cqd_id = $get_item_data[0] AND stu_id = $user_id"));
if($get_stu_item_data['status'] == 1){
	if($get_stu_item_data['answer'] == 'A'){
		$choice_a_color = "green";
		$choice_b_color = "grey";
		$border_a_color = "green";
		$border_b_color = "grey";
	}else{
		$choice_a_color = "grey";
		$choice_b_color = "green";
		$border_a_color = "grey";
		$border_b_color = "green";
	}
}else{
$choice_a_color = "black";
$choice_b_color = "black";
$border_a_color = "hsl(89, 43%, 51%)";
$border_b_color = "hsl(89, 43%, 51%)";
}
function countLastItemNo($id){
	$count = mysql_fetch_array(mysql_query("SELECT count(cq_id) FROM `tbl_class_quiz_detail` WHERE cq_id = '$id'"));
	return $count[0];
}
$stu_data = mysql_fetch_array(mysql_query("SELECT * FROM tbl_student WHERE stu_id = $user_id"));
?>
        <div class="page-wrapper">
            <!-- Bread crumb -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary">Dashboard</h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Bread crumb -->
            <!-- Container fluid  -->
            <div class="container-fluid">
				<video controls="" autoplay="" name="media">
					<source src="https://translate.google.com/translate_tts?ie=UTF-8&amp;tl=tl&amp;client=tw-ob&amp;q=kamusta%20kana?" type="audio/mpeg">
				</video>
                <div class="row">
					<div class="col-lg-12">
                        <div class="card bg-dark"  style='font-size:25px'>
							<div class="row">
								<div class="col-md-8">
									<span>Name: <?= $stu_data['stu_fname']." ".$stu_data['stu_mname']." ".$stu_data['stu_lname']?></span>
								</div>
								<div class="col-md-4">
									<span>Status: <?= $stu_data['stu_special'] ?></span>
								</div>
							</div>
							<div class="row">
								<div class="col-md-8">
									<span>Quiz 1</span>
								</div>
								<div class="col-md-4">
									<span>Item <?= $item." of ".$last_item; ?></span>
								</div>
							</div>
							<hr style='background:white'>
							<div class="row">
								<div class="col-12">
									<div class="row" id='answer-sheet'>
										<div class="col-md-3"></div>
										<div class="col-md-6">
											<div class="card">
												<center><span style="color:green;font-size:18px;margin-top:none;"><strong><?= $get_item_data['quest'];?></strong></span></center>
												<hr>
												<div class="row">
													<div onclick="checkAnswer('A')" class="col-md-6" style='color:<?= $choice_a_color;?>;cursor:pointer;border-style: solid;border-color: <?= $border_a_color;?>;'>
														<center><span style="font-size:150px;margin-top:none;">A</span></center>
														<center><span style="font-size:18px;margin-top:none;"><?= $get_item_data['item_1'];?></span></center>
													</div>
													<div onclick="checkAnswer('B')" class="col-md-6" style='color:<?= $choice_b_color;?>;cursor:pointer;border-style: solid;border-color: <?= $border_b_color;?>;'>
														<center><span style="font-size:150px;margin-top:none;">B</span></center>
														<center><span style="font-size:18px;margin-top:none;"><?= $get_item_data['item_2'];?></span></center>
													</div>
												</div>
												<center>
													<button type="button" onclick='window.location="index.php?page=<?= md5('stu-take-quiz')?>&cq_id=<?= $cq_id?>&item_no=<?= ($item - 1); ?>"' class="btn btn-sm btn-primary" <?= $prev; ?>><span class='icon-arrow-left'></span> PREV</button>
													<button type="button" onclick='window.location="index.php?page=<?= md5('stu-take-quiz')?>&cq_id=<?= $cq_id?>&item_no=<?= ($item + 1); ?>"' class="btn btn-sm btn-primary" <?= $next; ?>>NEXT <span class='icon-arrow-right'></span></button>
												</center>
											</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
	<footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
            <!-- End footer -->
        </div>
<!-- <script src="https://code.responsivevoice.org/responsivevoice.js"></script> -->
<script>
$(document).ready( function(){
	// responsiveVoice.cancel();
	// speakWords();
	//speakMe('sdfsd');
});
function checkAnswer(ans){
	// speakMe("Your answer is "+ans);
	responsiveVoice.speak("Your answer is "+ans);
	var cqd_id = "<?= $get_item_data[0] ?>";
	var cq_id = "<?= $cq_id ?>";
	var item = "<?= ($item + 1) ?>";
	var last_item = "<?= $last_item ?>";
	$.post("ajax/stu_checkItemAnswer.php",{
		cqd_id:cqd_id,
		cq_id:cq_id,
		last_item:last_item,
		ans:ans,
		item:item
	}, function (data,status){
		//alert(data);
		if(data == 0){
			//location.reload();
		}else{
			setTimeout(function(){
				window.location = "index.php?page="+data;
			}, 1000);
		}
	});
}
document.onkeypress = function(evt) {
    evt = evt || window.event;
    var charCode = evt.keyCode || evt.which;
    var charStr = String.fromCharCode(charCode);
    if(charStr == 'A' || charStr =='a' || charStr =='1'){
		checkAnswer('A');
	}else if(charStr == 'B' || charStr =='b' || charStr =='2'){
		checkAnswer('B');
	}else if(charStr == '3'){
		location.reload();
	}else if(charStr == '4'){
		responsiveVoice.pause();
	}else if(charStr == '5'){
		responsiveVoice.resume();
	}else{
	}
};
function speakWords(){
	var cq_id = "<?= $cq_id?>";
	var item = "<?= $item?>";
	$.post("ajax/stu_getTextToSpeech.php",{
		cq_id:cq_id,
		item:item
	}, function(data,status){
		//speakMe(data);
		//alert(data);
		responsiveVoice.speak(data);
	});
}
function speakMe(text){
	text = encodeURIComponent(text);
	var url = "https://translate.google.com/translate_tts?ie=UTF-8&amp;tl=tl&amp;client=tw-ob&amp;q="+text;
	$('audio').attr('src', url).get(0).play();
}
</script>