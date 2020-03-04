<?php
$tot_campers = 0;
foreach($bill_details as $detail)
{
	$tot_campers = $tot_campers + $detail["out_quantity"];
}
?>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right">Total Campers : </label>
	<div class="col-sm-9">
		<input type="text" name="total_campers" readonly value="<?php  echo $tot_campers; ?>" class="col-xs-10 col-sm-5"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right">Total Amount ( Fixed )</label>
	<div class="col-sm-9">
		<input type="number" name="total_amount_fixed" min="0" step="0.01" value="0" class="col-xs-10 col-sm-5"/>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right"></label>
	<div class="col-sm-9">
		<div class="radio">
			<label>
				<input name="extra_details" id="extra_details" value="1" type="checkbox" class="ace">
				<span class="lbl"> Extra Details</span>
			</label>
		</div>
	</div>
</div>
<div class="extra_details">
	<div class="form-group extra_details">
		<label class="col-sm-3 control-label no-padding-right">Per Camper Price (in Rs.) </label>
		<div class="col-sm-9">
			<input type="number" name="price" min="0" step="0.01" value="0" onchange="calculate_total_amount_extra();" class="col-xs-10 col-sm-5"/>
		</div>
	</div>
	<div class="form-group extra_details">
		<label class="col-sm-3 control-label no-padding-right">Extra Campers</label>
		<div class="col-sm-9">
			<input type="text" name="extra_campers" value="0" onchange="calculate_total_amount_extra();" class="col-xs-10 col-sm-5"/>
		</div>
	</div>
	<div class="form-group extra_details">
		<label class="col-sm-3 control-label no-padding-right">Total Amount (Extra)</label>
		<div class="col-sm-9">
			<input type="number" name="total_amount_extra" value="0" class="col-xs-10 col-sm-5"/>
		</div>
	</div>
</div>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" onclick="createBill();" type="button">Create Bill</button>
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
	.extra_details{
		display : none;
	}
</style>