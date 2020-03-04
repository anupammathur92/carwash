			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Add Client
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Add Client
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Client/add_client" method="POST">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Client Name </label>
								<div class="col-sm-9">
									<input type="text" name="client_name" placeholder="Client Name" value="<?php echo set_value('client_name'); ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Client Address </label>
								<div class="col-sm-9">
									<textarea style="resize:none;" name="client_address" class="col-xs-10 col-sm-5" placeholder="Client Address"><?php echo set_value('client_address'); ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Contact No. </label>
								<div class="col-sm-9">
									<input type="text" name="client_contact_no" placeholder="Client Name" value="<?php echo set_value('client_contact_no'); ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Client Code </label>
								<div class="col-sm-9">
									<input type="text" name="client_code" placeholder="Client Code" value="<?php echo set_value('client_code'); ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Start Date </label>
								<div class="col-sm-9">
									<input type="text" name="start_date" id="start_date" placeholder="Start Date" class="col-xs-10 col-sm-5" value="<?php echo date("d-m-Y");?>" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Remarks </label>
								<div class="col-sm-9">
									<textarea class="col-xs-10 col-sm-5" name="remarks" placeholder="Remarks" cols="20" rows="5" style="resize:none;"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Security Amount </label>
								<div class="col-sm-9">
									<input type="text" name="security_amount" placeholder="Security Amount" value="<?php echo set_value('security_amount'); ?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="security_returned" value="1" type="checkbox" class="ace">
											<span class="lbl"> Security Returned</span>
										</label>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Add</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Client/list_client">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>