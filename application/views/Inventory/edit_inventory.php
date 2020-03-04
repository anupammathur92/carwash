			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Edit Inventory</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Edit Inventory
							</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Inventory/update_inventory" method="POST">
							<input type="hidden" name="update_id" value="<?php echo $inventory_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Name </label>
								<div class="col-sm-9">
									<input type="text" readonly value="<?php echo $client_data["client_name"]; ?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div> 
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Date / Time</label>
								<div class="col-sm-9">
								<input class="date-picker" value="<?php echo date('d-m-Y',strtotime($inventory_data["date_time"])); ?>" id="date_time" name="date_time" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> In Quantity </label>
								<div class="col-sm-9">
									<input type="number" name="in_quantity" value="<?php echo $inventory_data["in_quantity"]; ?>" step="1" min="0" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Out Quantity </label>
								<div class="col-sm-9">
									<input type="number" name="out_quantity" value="<?php echo $inventory_data["out_quantity"]; ?>" step="1" min="0" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										Edit
									</button>
									&nbsp; &nbsp; &nbsp;
									<a href="<?php echo base_url();?>Inventory/list_inventory" class="btn" type="reset">Reset</a>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>