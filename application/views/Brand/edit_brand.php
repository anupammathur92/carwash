			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Update Brand</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Edit Brand</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Brand/update_brand">
							<input type="hidden" name="update_id" value="<?php echo $brand_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" name="name" id="form-field-1" value="<?php if(isset($brand_data)){ echo $brand_data['name']; }?>" placeholder="Name" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Model Name </label>
								<div class="col-sm-9">
									<input type="text" name="model" id="form-field-2" placeholder="Model Name" value="<?php if(isset($brand_data)){ echo $brand_data['model']; }?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Update</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url();?>Brand/list_brand">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>