			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Edit Bill
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Edit Bill</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<form action="<?php echo base_url();?>Billing/update_bill" method="POST" id="billForm" class="form-horizontal">
						<input type="hidden" name="update_id" value="<?php echo $bill_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Client </label>
								<div class="col-sm-9">
								<input type="text" readonly value="<?php echo $client_data["client_name"];?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">From Date</label>
								<div class="col-sm-9">
									<input type="text" readonly value="<?php echo date('d-m-Y',strtotime($bill_data["from_date"]));?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">To Date</label>
								<div class="col-sm-9">
									<input type="text" readonly value="<?php echo date('d-m-Y',strtotime($bill_data["to_date"]));?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Total Campers : </label>
								<div class="col-sm-9">
									<input type="text" readonly value="<?php  echo $bill_data["total_campers"]; ?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Total Amount ( Fixed )</label>
								<div class="col-sm-9">
									<input type="number" name="total_amount_fixed" min="0" step="0.01" value="<?php echo $bill_data["total_amount_fixed"]; ?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="extra_details" id="extra_details" <?php if($bill_data["extra_details"]){ echo "checked"; } ?> value="1" type="checkbox" class="ace">
											<span class="lbl"> Extra Details</span>
										</label>
									</div>
								</div>
							</div>
							<div class="extra_details">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Per Camper Price (in Rs.) </label>
									<div class="col-sm-9">
										<input type="number" name="price" step="0.01" min="0" value="<?php  echo $bill_data["price"]; ?>" onchange="calculate_total_amount_extra();" class="col-xs-10 col-sm-5"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Extra Campers</label>
									<div class="col-sm-9">
										<input type="text" name="extra_campers" value="<?php echo $bill_data["extra_campers"];?>" onchange="calculate_total_amount_extra();" class="col-xs-10 col-sm-5"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Total Amount (Extra)</label>
									<div class="col-sm-9">
										<input type="number" name="total_amount_extra" value="<?php echo $bill_data["total_amount_extra"];?>" class="col-xs-10 col-sm-5"/>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Update</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Billing/list_bill">Cancel</a>
								</div>
							</div>
							<span id="responseBody"></span>
						</form>
					</div>
				</div>
			</div>
<script type="text/javascript">
	$("#extra_details").on("change",function(){
		$(".extra_details").toggle();
		$("input[name='price']").val("0");
		$("input[name='extra_campers']").val("0");
		$("input[name='total_amount_extra']").val("0");
	});
	function calculate_total_amount_extra()
	{
		var price = $("input[name='price']").val();
		var extra_campers = $("input[name='extra_campers']").val();
		var total_amount_extra = 0;

		if($("#extra_details").is(":checked"))
		{
			price = parseFloat(price);
			extra_campers = parseFloat(extra_campers);

			if(price==="" || extra_campers==="")
			{
				alert("Please Fill All The Necessary Details in Proper Format.");
				$("input[name='price']").val("0");
				$("input[name='extra_campers']").val("0");
				$("input[name='total_amount_extra']").val("0");
			}
			else
			{
				total_amount_extra = price * extra_campers;
				$("input[name='total_amount_extra']").val(total_amount_extra);
			}
		}
	}
</script>
<style type="text/css">
<?php
if(!$bill_data["extra_details"])
{
	?>
		.extra_details{
			display : none;
		}
	<?php
}
?>

</style>