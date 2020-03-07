			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Edit Sub Category
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Edit Sub Category
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Category/update_subcategory" method="POST">
						<input type="hidden" name="update_id" value="<?php echo $subcategory_data["id"]; ?>">
						<input type="hidden" name="parent_id" value="<?php echo $subcategory_data["parent_id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Sub Category Name </label>
								<div class="col-sm-9">
									<input type="text" name="category_name" placeholder="Sub Category Name" value="<?php if(isset($subcategory_data)){ echo $subcategory_data["category_name"]; } ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Min. Price </label>
								<div class="col-sm-9">
									<input type="text" name="min_price" placeholder="Min. Price" value="<?php if(isset($subcategory_data)){ echo $subcategory_data["min_price"]; } ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Max. Price </label>
								<div class="col-sm-9">
									<input type="text" name="max_price" placeholder="Max. Price" value="<?php if(isset($subcategory_data)){ echo $subcategory_data["max_price"]; } ?>" class="col-xs-10 col-sm-5" />
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