			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li>
								<a href="#">Forms</a>
							</li>
							<li class="active">Form Elements</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Add Inventory
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Client/add_client" method="POST">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Name </label>
								<div class="col-sm-9">
									<input type="text" name="client_name" placeholder="Client Name" value="<?php echo set_value('client_name'); ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Address </label>
								<div class="col-sm-9">
									<textarea style="resize:none;" name="client_address" class="col-xs-10 col-sm-5" placeholder="Default Text"><?php echo set_value('client_address'); ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact No. </label>
								<div class="col-sm-9">
									<input type="text" name="client_contact_no" placeholder="Client Name" value="<?php echo set_value('client_contact_no'); ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">
										Submit
									</button>
									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset">
										Reset
									</button>
								</div>
							</div>

						</form>

					</div>
				</div>
			</div>