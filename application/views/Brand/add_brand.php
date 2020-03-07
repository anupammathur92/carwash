			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Add Brand
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Add Brand
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Brand/add_brand" method="POST">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Brand Name </label>
								<div class="col-sm-9">
									<input type="text" name="name" placeholder="Brand Name" value="<?php echo set_value('name'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Model Name </label>
								<div class="col-sm-9">
									<input type="text" name="model" placeholder="Model Name" value="<?php echo set_value('model'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Add</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Brand/list_brand">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>