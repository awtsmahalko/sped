<?php
$branch_id = get_branch();
$company_id = $_SESSION['system']['company_id'];
?>
<?php if($menu_module_inventory_adjustment == "true"){ ?>
<div id="page-wrapper">
	<div class="row">
		<div class="btn-group btn-small" role="group">
            <button class="btn btn-default" onClick="window.location='index.php?page=inventory-adjustment'" style="font-size: 11px; padding: 5px; color: maroon;"><strong><span class="fa fa-angle-double-left"></span> Inventory Adjustment</strong></button>
            <button class="btn btn-default disabled" style="font-size: 11px; padding: 5px;">Add Inventory Adjustment</button>
		</div>
    </div>
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header animated flipInX" style="border: 5px solid #286090;border-top: none;border-bottom: none;border-right: none;padding: 5px;color: #286090;"><span class="fa fa-plus-circle"></span> Add Inventory Adjustment Entry</h3>
			<div style="color: red;">*NOTE: Putting a (-) negative sign before the inputted quantity on the selected Stock/Item would automatically make a <b>negative/subtracting</b> adjustment.</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4" style="padding: 10px;">
			<form action="" method="POST" id="from_inventory_adjustment_header">
				<div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px;">
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon"><strong>Inv. Adjustment #:</strong></span>
						<input type="text" class="form-control" id="in_number" name="in_number" readonly required>
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon"><strong>Warehouse:</strong></span>
						<select class="form-control select2" style="width: 100%;" name="warehouse_id" id="warehouse_id" required>
							<option value="">Please Choose:</option>
							<?php
								$fetch_warehouse = mysql_query("SELECT * FROM tbl_warehouse WHERE company_id='$company_id' AND branch_id='$branch_id'");
								while($warehouse_result = mysql_fetch_array($fetch_warehouse)){
							?>
							<option value="<?php echo $warehouse_result["warehouse_id"]; ?>"><?php echo $warehouse_result["warehouse_name"]; ?></option>
								<?php } ?>
						</select>
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon"><strong>Date:</strong></span>
						<input type="text" class="form-control" id="datepicker" name="date" required>
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon"><strong>Remarks:</strong></span>
						<textarea class="form-control" name="remarks"></textarea>
					</div>
					<div class="input-group" style="padding: 4px;">
						<span class="input-group-addon"><strong>Encoded By:</strong></span>
						<input type="text" class="form-control" name="encoded_by" value=<?php echo getUser($access); ?> readonly>
					</div>
					<div style="padding: 4px;">
						<button class="btn btn-sm btn-primary pull-right" id="btn_add_ia_header"><span class="fa fa-plus-circle"></span> Add Inventory Adjustment </button>
					</div>
				</div>
			</form>
		</div>
		
		<div class="col-sm-8" style="padding: 10px; display:none;" id="form_add_inventory_adjustment_details">
			<form action="" method="POST" id="form_add_inventory_adjustment_details2">
				<input type="hidden" class="form-control" id="warehouse_id_for_details" name="warehouse_id_for_details"  readonly>
				<input type="hidden" class="form-control" id="in_number_for_details" name="in_number_for_details" readonly>
				<div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px;">
					<!--<div class="col-sm-6" style="padding: 4px;">
						<div class="input-group">
							<span class="input-group-addon"><strong>Product Category:</strong></span>
							<select class="form-control" name="tag" onclick='getProduct()'>
								<option value="1">-- Select --</option>
								<option value="2">DOC</option>
								<option value="3">RTL</option>
							</select>
						</div>
					</div>-->
					<div class="col-sm-6" style="padding: 4px;">
						<div class="input-group">
							<!--<span class="input-group-addon"><strong>Product:</strong></span>
							<select class="form-control" name="product_id" id="product_id" required>
								<option value="">-- Select --</option>
								<?php
								//$fetch_prod_cat = mysql_query("SELECT * FROM `tbl_product_category` where (company_id=$company_id OR company_id='0') AND visibility_status='1' order by category asc");
								//while($prod_cat_row = mysql_fetch_array($fetch_prod_cat)){
									
								//$fetch_products = mysql_query("SELECT * from tbl_productmaster where (company_id='$company_id' OR company_id='0') AND (branch_id='$branch_id' OR branch_id='0') and product_categ_id = '$prod_cat_row[product_categ_id]' ORDER BY product ASC ");
								
								//while($products_row = mysql_fetch_array($fetch_products)){ ?>
									<option value="<?php //echo $products_row['product_id']; ?>"><?php echo $products_row['product']; ?></option>
								<?php //}} ?>
							</select>-->

							<span class="input-group-addon"><strong>Item: <span style="color:red;">*</span></strong></span>
							<select class="form-control select2" style="width: 100%;" name="product_id" required  id='product_id' onchange='getPackagingType()' />
								<option value="">-- Select --</option>
								<?php
									if($_SESSION['wdysolutions_program'] == 'wdysolutions_PIG'){ ?>
									<option value="0">Swine</option>
								<?php } ?>
								<?php 
								$fetch_prod_cat = mysql_query("SELECT * FROM `tbl_product_category` where ((company_id=$company_id) OR (company_id=0)) AND visibility_status='1' ORDER BY category ASC");
								while($prod_cat_row = mysql_fetch_array($fetch_prod_cat)){
								
								$fetch_products = mysql_query("SELECT * from tbl_productmaster where ((company_id='$company_id') OR (company_id=0)) and ((branch_id='$branch_id') OR (branch_id=0)) and product_categ_id = '$prod_cat_row[product_categ_id]' ORDER BY product ASC ");
								
								while($products_row = mysql_fetch_array($fetch_products)){ ?>
									<option value="<?php echo $products_row['product_id']; ?>"><?php echo $products_row['product']; ?></option>
								<?php }}?>
							</select>
						</div>
					</div>
					<div class="col-sm-6" style="padding: 4px;">
						<div class="input-group">
							<span class="input-group-addon"><strong>Packaging: <span style="color:red;">*</span></strong></span>
							<select class='form-control' required id='packaging_id'  name='packaging_id'  onchange="getCurrentQty()">
								<option> No Packaging Available</option>
							</select>
						</div>
					</div>

					<div class="col-sm-6" style="padding: 4px;">
						<div class="input-group">
							<span class="input-group-addon"><strong>Qty:</strong></span>
							<input type="number" step="0.001" class="form-control" name="qty" id="qty"  required>
						</div>
					</div>
			
					<div class="col-sm-6" style="padding: 4px;">
						<div class="input-group">
							<span class="input-group-addon"><strong>Remarks:</strong></span>
							<textarea class="form-control" name="remarks" id="remarks"></textarea>
						</div>
					</div>
					<div style="padding: 4px;float:right;margin-top: 20px;">
						<button class="btn btn-sm btn-primary" id="btn_add_item" style="float: right;margin-top: 20px;"><span class="fa fa-plus-circle"></span> Add Item </button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br>
	<div class="row" id="rs_details_container" style="display:none; padding: 10px;">
		<div class="col-sm-12" style="border: 1px solid #ccc; padding: 7px; border-radius: 3px;">
			<div class="btn-group pull-right" role="group" style="padding: 4px; margin-bottom: 10px;">
				<button type='button' class="btn btn-sm btn-success" id="btn_finish_ia" onclick='finish_inventory_adjustment()' data-toggle="tooltip" title="Finish IA"><span class="fa fa-check-circle"></span> Finish Inventory Adjustment </button>
				<button type="button" class="btn btn-sm btn-danger" id="btn_delete" onclick="deleteIA_details()" data-toggle="tooltip" title="Delete Checked"><span class="fa fa-trash"></span> Delete</button>
			</div>
			<br>
			<table id="dt_ia_details" class="table table-bordered table-striped" style="font-size:12px;">
				<thead>
					<tr>
						<th style=" width:10px;text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa;"><input type="checkbox" onchange="checkAll(this)" value="0"></th>
						<th style="text-align:center;background-color:#e3e3e3; border-bottom:1px solid #aaa; width:5px;">#</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">PRODUCT</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">PACKAGE</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">QUANTITY</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">COST</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">AMOUNT</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">REMARKS</th>
						<th style="text-align:left;background-color:#e3e3e3; border-bottom:1px solid #aaa;">STATUS</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php }else{ ?>
	<script> window.location = "index.php?page=restrict"; </script>
<?php } ?>
<script>

function getPackagingType(){
	var product_id = $("#product_id").val();
	$.ajax({
		url:"ajax/getPackageType.php",
		type:"POST",
		data:{
			product_id:product_id
		},
		success: function(data){
			$("#packaging_id").html(data);
		}
	});
}

function finish_inventory_adjustment(){
	var warehouse_id = $("#warehouse_id_for_details").val();
	var inv_adj_num = $("#in_number_for_details").val();
	var count_id = $('input[name="textboxs[]"]').map(function() {
		return this.value;
	}).get();

	if(count_id == ''){
		alert('Please Add an Item.');
	}else{
		$("#btn_finish_ia").prop('disabled', true);
		$("#btn_finish_ia").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
		$.ajax({
			type:"POST",
			url:"ajax/finishInventoryAdjustment.php",
			data:{
				warehouse_id:warehouse_id,
				inv_adj_num:inv_adj_num
			},
			success: function(data){
				if(data == 1){
					alert("Successfully finished Inventory Adjustment!");
					window.location = 'index.php?page=inventory-adjustment';
				}else{
					//alert(data);
					alertMe("Aw snap!","Please check your chart of accounts or check your entry carefully. Thank you!","danger");
				}
				$("#btn_finish_ia").prop('disabled', false);
				$("#btn_finish_ia").html("<span class='fa fa-plus-circle'></span> Finish Inventory Adjustment");
			}
		});
	}
}



function deleteIA_details(){
	var count_checked = $("input[name='checkbox']:checked").length;
	if(count_checked > 0){
		var checkedValues = $('input:checkbox:checked').map(function() {
			return this.value;
		}).get();
		
		id = [];
		var retVal = confirm("Are you sure to delete?");
		if( retVal == true ){
			$("#btn_delete").prop('disabled', true);
			$("#btn_delete").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");
			$.post("ajax/deleteIADetails.php", {
				id: checkedValues
				},
				function (data, status) {
					if(data == 1){
						success_delete();
						var table = $('#dt_ia_details').DataTable();
						table.destroy();
						getIA_details();
					}else{
						failed_query();
					}
					$("#btn_delete").prop('disabled', false);
					$("#btn_delete").html("<span class='fa fa-trash-o'></span> Delete");
				}
			);
			return true;
		}
	} else alertMe("Aw Snap!","No selected Inventory Adjustment Entry!","warning");	
}

$("#from_inventory_adjustment_header").submit(function(e){
	// $("#btn_add_ia_header").prop('disabled',false);
	// $("#btn_add_ia_header").html("<span class='fa fa-spin fa-spinner'></span> Saving ...");

	var in_number = $("#in_number").val();

	if(in_number ==   ""){
		alert("Fill out Fields --- Please Refresh Page. ");
		//$("#btn_add_ia_header").prop('disabled',true);
		//$("#btn_add_ia_header").html("<span class='fa fa-plus-circle'></span> Add Inventory Adjustment");
	}else{
		$("#btn_add_ia_header").prop('disabled',true);
		$("#btn_add_ia_header").html("<span class='fa fa-spin fa-spinner'></span> Loading...");


		e.preventDefault();
		$.ajax({
			type:"POST",
			url:"ajax/addInventoryAdjustment.php",
			data: $("#from_inventory_adjustment_header").serialize(),
			success: function(data){
				if(data == 1){
					success_add();
					getLocations();
				}else{
					failed_query();
				}
				$("#btn_add_ia_header").prop('disabled',true);
				$("#btn_add_ia_header").html("<span class='fa fa-plus-circle'></span> Add Inventory Adjustment");
			}
		});
		
		$("#form_add_inventory_adjustment_details").fadeIn();
		$("#warehouse_id").prop('disabled',true);
		$("#datepicker").prop('disabled',true);
		$("remarks").prop('disabled',true);
		// $("#btn_add_ia_header").prop('disabled',true);
		// $("#btn_add_ia_header").html("<span class='fa fa-plus-circle'></span> Add Inventory Adjustment");
	}	
	
		
	
});

$("#form_add_inventory_adjustment_details2").submit(function(e){
	$("#btn_add_item").prop('disabled', true);
	$("#btn_add_item").html("<span class='fa fa-spin fa-spinner'></span> Loading ...");

	e.preventDefault();
	$.ajax({
		type:"POST",
		url:"ajax/addInventoryAdjustmentDetails.php",
		data: $("#form_add_inventory_adjustment_details2").serialize(),
		success: function(data){
			if(data == 1){
				success_add();
				$("#form_add_inventory_adjustment_details2").each(function(){
				});
				$("#product_id").val("");
			//	$("#datepicker2").val("");
				$("#qty").val("");
				$("#remarks").val("");
				$("#dt_ia_details").DataTable().destroy();
				getIA_details();
			}else{
				alert(data);
				failed_query();
			}
			$("#btn_add_item").prop('disabled', false);
			$("#btn_add_item").html("<span class='fa fa-plus-circle'></span> Add Item");
		}
	});
	
	$("#rs_details_container").fadeIn();
	
});


function getIA_details(){
	var in_number = $("#in_number").val();
	var Pid = $("#product_id").val();
	var warehouse_id = $("#warehouse_id_for_details").val();

	$("#dt_ia_details").dataTable({
		"processing":true,
		"ajax":{
			"type":"POST",
			"url":"ajax/datatables/viewInventoryAdjustmentDetails.php",
			"dataSrc":"data",
			"data":{
				in_number:in_number
			}
		},
		"columns":[
		{
			"mRender":function(data,type,row){
				return "<input type='hidden' name='textboxs[]' id='inv_id' value="+row.id+"><input type='checkbox' id='check_id' name='checkbox' value="+row.id+">";
			}
		},
		{
			"data":"count"
		},
		{
			"data":"product_id"
		},
		{
			"data":"package"
		},
		{
			"data":"qty"
		},
		{
			"data":"cost"
		},
		{
			"data":"amount"
		},
		{
			"data":"remarks"
		},
		{
			"data":"status"
		}
		]
	});
}
function getIAnumForIA(){
	$.ajax({
		url:"ajax/generateIANumber.php",
		success:function(data){
			$("#in_number").val(data);
			$("#in_number_for_details").val(data);
		}
	});
}

function getLocations(){
	var in_number = $("#in_number").val();
	$.post("ajax/getIALocations.php", {
		id:in_number
	},
	function (data, status) {
		var o = JSON.parse(data);
		$("#warehouse_id_for_details").val(o.warehouse_id);
	}
	);
}

$(document).ready(function(){
	getIA_details();
	getIAnumForIA();
	getINNumber();
	
});

</script>