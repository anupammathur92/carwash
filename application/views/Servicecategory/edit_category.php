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
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Servicecategory/update_category" method="POST">
						<input type="hidden" name="update_id" value="<?php echo $category_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Category Name </label>
								<div class="col-sm-9">
									<input type="text" name="category_name" placeholder="Category Name" value="<?php if(isset($category_data)){ echo $category_data["category_name"]; } ?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right"> Parent Category </label>
								<div class="col-sm-9">
								<select class="col-xs-10 col-sm-5" name="parent_id">
								<option value="">Main Category</option>
								<?php
								foreach($parent_categories as $parent_category)
								{
									?>
									<option value="<?php echo $parent_category["id"]; ?>" <?php if(isset($category_data) && $category_data["parent_id"]==$parent_category["id"]){ echo "selected"; } ?> ><?php echo $parent_category["category_name"]; ?></option>
									<?php
								}
								?>
								</select>
									<!-- <input type="text" name="sub_category_name" placeholder="Parent Category" value="<?php echo set_value('sub_category_name'); ?>" class="col-xs-10 col-sm-5" /> -->
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Add</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Servicecategory/list_category">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>