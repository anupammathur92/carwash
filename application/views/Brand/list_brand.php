			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">List Brand
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Brand List</h1>
						</div>
<?php
$brand_name = $this->input->get("brand_name") ? $this->input->get("brand_name") : "";
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
											<div class="row">
												<div class="row">
													<form method="GET" action="<?php echo base_url();?>Brand/list_brand">
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="">
																<label>Brand Name:<input type="text" name="brand_name" class="form-control input-sm" value="<?php echo $brand_name; ?>" placeholder="" autocomplete="off" aria-controls="dynamic-table"></label>
															</div>
														</div>
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="dataTables_filter">
																<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
																<a href="<?php echo base_url();?>Brand/list_brand" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
															</div>
														</div>
													</form>
												</div>
											</div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
												<thead>
													<tr>
														<th>Name</th>
														<th>Model</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach($list_brands as $brand)
												{
													?>
													<tr>
														<td><?php echo $brand["name"]; ?></td>
														<td><?php echo $brand["model"]; ?></td>
														<td>
															<div class="action-buttons">
																<a class="green" href="<?php echo base_url()."Brand/edit_brand/".$brand["id"]; ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="red" href="<?php echo base_url()."Brand/delete_brand/".$brand["id"]; ?>">
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
                                   if (count($list_brands)> 0) {
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