			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Bill List</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Bill List</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>Client Name</th>
													<th>From Date</th>
													<th>To Date</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											foreach($list_bills as $bill)
											{
												$client_data = $this->Client_model->get_client_by_id($bill["client_id"]);
												?>
												<tr>
													<td><?php echo $client_data["client_name"];?></td>
													<td><?php echo date("d-m-Y",strtotime($bill["from_date"])); ?></td>
													<td><?php echo date("d-m-Y",strtotime($bill["to_date"])); ?></td>
													<td>
														<div class="action-buttons">
															<a class="blue" href="javascript:void(0);" onclick="showBillDetails('<?php echo $bill["id"];?>');">
																<i class="ace-icon fa fa-info bigger-130"></i>
															</a>
															<a class="green" href="<?php echo base_url();?>Billing/edit_bill/<?php echo $bill['id'];?>">
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>
															<a class="red" href="<?php echo base_url();?>Billing/delete_bill/<?php echo $bill['id'];?>">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a>
															<a class="blue" target="_blank" href="<?php echo base_url();?>Billing/get_bill/<?php echo $bill['id'];?>">
																<i class="ace-icon fa fa-print bigger-130"></i>
															</a>
														</div>
													</td>
												</tr>
												<?php
												}
											?>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<div class="modal fade" id="billDetails" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">Bill Details</h4>
	    </div>
	    <div class="modal-body" id="billDetailsBody"></div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
function showBillDetails(billId)
{
	var loader_img = "<img style='margin-left:370px;' height='100' width='100' src='<?php echo base_url();?>assests/images/loading.gif'>";

	$.ajax({
		url : '<?php echo base_url();?>Billing/show_bill_details',
		type : 'POST',
		data : { bill_id : billId },
		beforeSend : function(){
			$("#billDetailsBody").html(loader_img);
			$("#billDetails").modal("show");
		},
		success : function(response){
			$("#billDetailsBody").html(response);
		},
		error : function(){
			$("#billDetailsBody").html("Some Error Has Occurred");
		}
	});
}
</script>