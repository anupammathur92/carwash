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
							<h1>Client Inventory</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<table id="simple-table" class="table  table-bordered table-hover">
											<thead>
												<tr>
													<th>Date / Time</th>
													<th>Quantity</th>
													<th>In / Out</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<?php
											foreach($client_inventory as $inventory)
											{
												?>
												<tr>
													<td><?php echo date("d-m-Y",strtotime($inventory["date_time"])); ?></td>
													<td><?php echo $inventory["quantity"]; ?></td>
													<td><?php echo $inventory["in_out"]; ?></td>
													<td>
														<div class="action-buttons">
															<a class="green" href="<?php echo base_url()."Client/edit_inventory/".$inventory["id"]; ?>">
																<i class="ace-icon fa fa-pencil bigger-130"></i>
															</a>
															<a title="Add Inventory" class="blue" href="<?php echo base_url(); ?>Client/delete_inventory/<?php echo $inventory["id"]; ?>" id="175"><i class="menu-icon fa fa-pencil-square-o"></i>
															</a>
															<!-- <a title="List Inventory" class="blue" href="<?php echo base_url(); ?>Client/list_inventory/<?php echo $inventory["id"]; ?>" id="175"><i class="menu-icon fa fa-pencil-square-o"></i>
															</a>
															<a class="red" href="<?php echo base_url()."Client/delete_client/".$inventory["id"]; ?>">
																<i class="ace-icon fa fa-trash-o bigger-130"></i>
															</a> -->
														</div>
													</td>
												</tr>	
												<?php
												}
											?>
											</tbody>
										</table>
									</div><!-- /.span -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>