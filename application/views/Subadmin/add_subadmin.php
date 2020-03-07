			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Add Subadmin
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Add Subadmin
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Subadmin/add_subadmin" method="POST">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Subadmin Name </label>
								<div class="col-sm-9">
									<input type="text" name="name" placeholder="Subadmin Name" value="<?php echo set_value('name'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Email </label>
								<div class="col-sm-9">
									<input type="text" name="email" placeholder="Email" value="<?php echo set_value('email'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Mobile Number </label>
								<div class="col-sm-9">
									<input type="text" name="mobile_number" placeholder="Mobile Number" value="<?php echo set_value('mobile_number'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Password </label>
								<div class="col-sm-9">
									<input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Confirm Password </label>
								<div class="col-sm-9">
									<input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('password'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="is_active" value="1" type="checkbox" class="ace">
											<span class="lbl"> Is Active</span>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="allow_partner" value="1" type="checkbox" class="ace">
											<span class="lbl">Partner</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="allow_customer" value="1" type="checkbox" class="ace">
											<span class="lbl">Customer</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="allow_brand" value="1" type="checkbox" class="ace">
											<span class="lbl">Brand</span>
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="allow_category" value="1" type="checkbox" class="ace">
											<span class="lbl">Category</span>
										</label>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Add</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Subadmin/list_subadmin">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>