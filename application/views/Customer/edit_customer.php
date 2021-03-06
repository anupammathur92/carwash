			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Update Customer</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Edit Customer</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Customer/update_customer">
							<input type="hidden" name="update_id" value="<?php echo $customer_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" name="name" id="form-field-1" value="<?php if(isset($customer_data)){ echo $customer_data['name']; }?>" placeholder="Name" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
								<div class="col-sm-9">
									<input type="text" name="email" placeholder="Email" value="<?php if(isset($customer_data)){ echo $customer_data['email']; }?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile Number </label>
								<div class="col-sm-9">
									<input type="text" name="mobile_number" id="form-field-1" placeholder="Mobile Name" value="<?php if(isset($customer_data)){ echo $customer_data['mobile_number']; }?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Password </label>
								<div class="col-sm-9">
									<input type="password" name="password" placeholder="Password" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Confirm Password </label>
								<div class="col-sm-9">
									<input type="password" name="confirm_password" placeholder="Confirm Password" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="is_active" value="1" type="checkbox" class="ace" <?php if(isset($customer_data) && $customer_data["is_active"]==1){ echo "checked"; } ?>>
											<span class="lbl"> Is Active</span>
										</label>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Update</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url();?>Customer/list_customer">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>