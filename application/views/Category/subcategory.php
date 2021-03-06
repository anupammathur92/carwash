			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Add Sub Category
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Add Sub Category
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" action="<?php echo base_url();?>Category/add_subcategory" method="POST">
							<input type="hidden" name="parent_id" value="<?php if(isset($parent_category_data)){ echo $parent_category_data["id"]; }?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Sub Category Name </label>
								<div class="col-sm-9">
									<input type="text" name="category_name" placeholder="Sub Category Name" value="<?php echo set_value('category_name'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Min. Price </label>
								<div class="col-sm-9">
									<input type="text" name="min_price" placeholder="Min. Price" value="<?php echo set_value('min_price'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right">Max. Price </label>
								<div class="col-sm-9">
									<input type="text" name="max_price" placeholder="Max. Price" value="<?php echo set_value('max_price'); ?>" class="col-xs-10 col-sm-5" autocomplete="off" />
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Add</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url(); ?>Category/list_category">Cancel</a>
								</div>
							</div>
						</form>
					</div>
<div class="page-content">
						<div class="page-header">
							<h1>Sub Category List</h1>
						</div>
<?php
$subcategory_name = $this->input->get("subcategory_name") ? $this->input->get("subcategory_name") : "";
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
											<div class="row">
												<form method="GET" action="<?php echo base_url();?>Category/subcategory/<?php echo $parent_category_data["id"]; ?>">
													<div class="col-xs-6">
														<div id="dynamic-table_filter" class="">
															<label>Subcatgory Name:<input type="text" name="subcategory_name" class="form-control input-sm" value="<?php echo $subcategory_name; ?>" placeholder="" aria-controls="dynamic-table"></label>
														</div>
													</div>
													<div class="col-xs-6">
														<div id="dynamic-table_filter" class="dataTables_filter">
															<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
															<a href="<?php echo base_url();?>Category/subcategory/<?php echo $parent_category_data["id"]; ?>" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
														</div>
													</div>
												</form>
											</div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
												<thead>
													<tr>
														<th>Subcategory Name</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach($list_subcategory as $subcategory)
												{
													?>
													<tr>
														<td><?php echo $subcategory["category_name"]; ?></td>
														<td>
															<div class="action-buttons">
																<a class="green" href="<?php echo base_url()."Category/edit_subcategory/".$subcategory["id"]; ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="red" href="<?php echo base_url()."Category/delete_subcategory/".$subcategory["id"]; ?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
														</td>
													</tr>	
													<?php
													}
												?>
												</tbody>
											</table>
										</div>
									</div><!-- /.span -->
                                 <?php
                                   if (count($list_subcategory)> 0) {
                                 ?>
          <div class="row">
            <div class="col-xs-6">
              <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
                  <?php
                      /*$current = $this->uri->segment(3) + 1;
                      $to = $this->uri->segment(3) + $config["per_page"];
                      $to = ( $to < $config["total_rows"] ? $to : $config["total_rows"]);
                      $current = (isset($current) ? $current : 0 );
                      $to = (isset($to) ? $to : 0 );
                      echo "Showing " . $current . " to " . $to . " out of " . $config["total_rows"] . " Entries.";

                      $tot_pages = ceil($config["total_rows"]/$config["per_page"]);
                      if($this->uri->segment(3))
                          $page_no = (($this->uri->segment(3) + $config["per_page"])/$config["per_page"]);
                      else
                          $page_no = 1;*/
                  ?>
              </div>
            </div>
            <!-- <div class="col-xs-6" style="text-align:right;">
              <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
              <?php
               if($config["total_rows"] > $config["per_page"])
                {
                  ?>
                    Showing Page : <input style="width:8%;" type="number" onChange="jumpToPage(this.value);" name="page_no" max="<?php echo $tot_pages; ?>" min="1" value="<?php echo $page_no; ?>"> of <?php echo $tot_pages; ?>
              <?php
              }
              ?>
              </div>
            </div> -->
          </div>
	        <div class="row pag">
	            <div class=" col-lg-12 center pagination"><?php //echo $this->pagination->create_links(); ?></div>
	        </div>
	        <?php 
            }
            else
            {
				?>
               	<div class="row">No Record Found</div>
                <?php  
            }
			?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>