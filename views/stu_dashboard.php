<?php
$dir = 'signs';
$files1 = scandir($dir);
?>
<div class="page-wrapper">
	<!-- Bread crumb -->
	<div class="row page-titles">
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Master Data</a></li>
				<li class="breadcrumb-item active">Class</li>
			</ol>
		</div>
	</div>
	<!-- End Bread crumb -->
	<!-- Container fluid  -->
	<div class="container-fluid">
		<div class="row">
			<!-- Start Page Content -->
	 		<?php
				foreach ($files1 as $key => $value) {
				$display = (($value == ".") || ($value == ".."))?"display:none;":"";
			?> 
			<div class="col-md-4" style="float: left;<?=$display?>">
				<div class="card animated flipInX">
					<img src='<?="$dir/$value";?>' style="height: 250px;object-fit: contain;">
				</div>
			</div>
			<?php } ?>
			<!-- End PAge Content -->
		</div>
	</div>
	<!-- End Container fluid  -->
	<!-- footer -->
	<footer class="footer"> © 2018 All rights reserved. BACOLOD CITY SPED CENTER EVALUATION AND ASSESSMENT</footer>
	<!-- End footer -->
</div>
