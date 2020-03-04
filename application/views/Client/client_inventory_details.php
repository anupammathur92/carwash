<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="<?php echo base_url();?>">Home</a>
				</li>
				<li class="active">
					Client Inventory Details
				</li>
			</ul><!-- /.breadcrumb -->
		</div>
		<div class="page-content">
<?php
$client_id = $this->input->get("client_id");
$from_date = $this->input->get("from_date");
$to_date = $this->input->get("to_date");
?>
			<form class="form-horizontal" role="form" action="<?php echo base_url();?>Client/get_inventory_details" method="GET">
			<input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Name </label>
					<div class="col-sm-9">
						<input type="text" readonly value="<?php echo $client_data["client_name"]; ?>" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> From </label>
					<div class="col-sm-9">
						<input type="text" name="from_date" id="from_date" value="<?php if($from_date!="") echo date("d-m-Y",strtotime($from_date)); ?>" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> To </label>
					<div class="col-sm-9">
						<input type="text" name="to_date" id="to_date" value="<?php if($to_date!="") echo date("d-m-Y",strtotime($to_date)); ?>" class="col-xs-10 col-sm-5" />
					</div>
				</div>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button class="btn btn-info" type="submit">
							Search
						</button>
						&nbsp; &nbsp; &nbsp;
						<a class="btn" href="<?php echo base_url();?>Client/list_client">
							Back
						</a>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<table id="simple-table" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Date / Time</th>
										<th>IN Quantity</th>
										<th>OUT Quantity</th>
									</tr>
								</thead>
								<tbody>
	<?php
	if(count($list_inventory) > 0)
	{
		$in_quantity = 0;
		$out_quantity = 0;
		foreach($list_inventory as $inventory)
		{
			$in_quantity += $inventory["in_quantity"];

			$out_quantity +=$inventory["out_quantity"];

			?>
			<tr>
				<td><?php echo date("d-m-Y",strtotime($inventory["date_time"])); ?></td>
				<td><?php echo $inventory["in_quantity"]; ?></td>
				<td><?php echo $inventory["out_quantity"]; ?></td>
			</tr>	
			<?php
			}
		?>
			<tr>
				<td style="text-align:right;" colspan="2">Total OUT</td>
				<td><?php echo $out_quantity; ?></td>
			</tr>
			<tr>
				<td style="text-align:right;" colspan="2">Total IN</td>
				<td><?php echo $in_quantity; ?></td>
			</tr>
			<tr>
				<td style="text-align:right;" colspan="2">Net Total</td>
				<td><?php echo ($out_quantity - $in_quantity); ?></td>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
				<td colspan="3">No Inventory Found.</td>
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