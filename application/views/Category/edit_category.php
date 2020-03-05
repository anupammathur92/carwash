			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Edit Category
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Edit Category
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Category/update_category" method="POST">
						<input type="hidden" name="update_id" value="<?php echo $category_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Category Name </label>
								<div class="col-sm-9">
									<input type="text" name="category_name" placeholder="Category Name" value="<?php if(isset($category_data)){ echo $category_data["category_name"]; } ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Update</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Category/list_category">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>