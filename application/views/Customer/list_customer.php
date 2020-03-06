			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">List Customer
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Customer List</h1>
						</div>
<?php
$customer_name = $this->input->get("customer_name") ? $this->input->get("customer_name") : "";
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
											<div class="row">
												<div class="row">
													<form method="GET" action="<?php echo base_url();?>Customer/list_customer">
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="">
																<label>Customer Name:<input type="text" name="customer_name" class="form-control input-sm" value="<?php echo $customer_name; ?>" placeholder="" aria-controls="dynamic-table"></label>
															</div>
														</div>
														<div class="col-xs-6">
															<div id="dynamic-table_filter" class="dataTables_filter">
																<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
																<a href="<?php echo base_url();?>Customer/list_customer" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
															</div>
														</div>
													</form>
												</div>
											</div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
												<thead>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Mobile Number</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												<?php
												foreach($list_customers as $customer)
												{
													?>
													<tr>
														<td><?php echo $customer["name"]; ?></td>
														<td><?php echo $customer["email"]; ?></td>
														<td><?php echo $customer["mobile_number"]; ?></td>
														<td>
															<div class="action-buttons">
																<a class="green" href="<?php echo base_url()."Customer/edit_customer/".$customer["id"]; ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="red" href="<?php echo base_url()."Customer/delete_customer/".$customer["id"]; ?>">
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
                                   if (count($list_customers)> 0) {
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