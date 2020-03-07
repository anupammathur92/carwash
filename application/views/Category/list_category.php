			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">List Category
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Category List</h1>
						</div>
<?php
$category_name = $this->input->get("category_name") ? $this->input->get("category_name") : "";
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
											<div class="row">
												<div class="row">
													<form method="GET" action="<?php echo base_url();?>Category/list_category">
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="">
																<label>Category Name:<input type="text" name="category_name" class="form-control input-sm" value="<?php echo $category_name; ?>" placeholder="" autocomplete="off" aria-controls="dynamic-table"></label>
															</div>
														</div>
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="dataTables_filter">
																<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
																<a href="<?php echo base_url();?>Category/list_category" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
															</div>
														</div>
													</form>
												</div>
											</div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
												<thead>
													<tr>
														<th>Category Name</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach($list_category as $category)
												{
													?>
													<tr>
														<td><?php echo $category["category_name"]; ?></td>
														<td>
															<div class="action-buttons">
																<a class="green" href="<?php echo base_url()."Category/edit_category/".$category["id"]; ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="blue" href="<?php echo base_url()."Category/subcategory/".$category["id"]; ?>">
																	<i class="ace-icon fa fa-book bigger-130"></i>
																</a>
																<a class="red" href="<?php echo base_url()."Category/delete_category/".$category["id"]; ?>">
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
                                   if (count($list_category)> 0) {
                                 ?>
          <div class="row">
            <div class="col-xs-6">
              <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">
                  <?php
                      $current = $this->uri->segment(3) + 1;
                      $to = $this->uri->segment(3) + $config["per_page"];
                      $to = ( $to < $config["total_rows"] ? $to : $config["total_rows"]);
                      $current = (isset($current) ? $current : 0 );
                      $to = (isset($to) ? $to : 0 );
                      echo "Showing " . $current . " to " . $to . " out of " . $config["total_rows"] . " Entries.";

                      $tot_pages = ceil($config["total_rows"]/$config["per_page"]);
                      if($this->uri->segment(3))
                          $page_no = (($this->uri->segment(3) + $config["per_page"])/$config["per_page"]);
                      else
                          $page_no = 1;
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
	            <div class=" col-lg-12 center pagination"><?php echo $this->pagination->create_links(); ?></div>
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