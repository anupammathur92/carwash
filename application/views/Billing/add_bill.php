			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Add Bill
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Add Bill</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<form action="<?php echo base_url();?>Billing/add_bill" method="POST" id="billForm" class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Client </label>
								<div class="col-sm-9">
									<select class="col-xs-10 col-sm-5 allClientList" name="client_name" aria-controls="dynamic-table" onchange="changeResponse();">
										<option value=""></option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">From Date</label>
								<div class="col-sm-9">
									<input id="from_date" name="from_date" type="text" readonly value="<?php echo date('d-m-Y');?>" class="col-xs-10 col-sm-5" onchange="changeResponse();"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">To Date</label>
								<div class="col-sm-9">
									<input id="to_date" name="to_date" type="text" readonly value="<?php echo date('d-m-Y');?>" class="col-xs-10 col-sm-5" onchange="changeResponse();"/>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" onclick="getBillDetails();" type="button">Get Bill Details</button>
									&nbsp; &nbsp; &nbsp;
									<!-- <a class="btn" href="<?php echo base_url(); ?>Client/list_client">Reset</a> -->
								</div>
							</div>
							<span id="responseBody"></span>
						</form>
					</div>
				</div>
			</div>
<script type="text/javascript">
	function changeResponse()
	{
		$("#responseBody").html("");
	}
	function getBillDetails()
	{
		var client_id = $("select[name='client_name']").val();
		var from_date = $("input[name='from_date']").val();
		var to_date = $("input[name='to_date']").val();

		if(client_id!="" && from_date!="" && to_date!="")
		{
			$.ajax({
				url : "<?php echo base_url();?>Billing/get_bill_details",
				type : "POST",
				data : { client_id : client_id , from_date : from_date , to_date : to_date },
				beforeSend : function(){
					//console.log("hello");
				},
				success : function(response){
					//console.log(response);
					$("#responseBody").html(response);
				},
				error : function(){
					//console.log("Error Has Occurred");
					alert("Error Has Occurred");
				}
			});
		}
		else
		{
			alert("Please Fill all fields.");
		}
	}
	function createBill()
	{
		var tot_campers = $("input[name='total_campers']").val();
		var price = $("input[name='price']").val();

		if(tot_campers!="" && price!="")
			$("#billForm").submit();
		else
			alert("Please Fill All Fields");

	}
</script>