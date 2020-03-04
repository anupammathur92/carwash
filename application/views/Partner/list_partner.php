			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">List Partner
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Partner List</h1>
						</div>
<?php
$client_name = $this->input->get("client_name") ? $this->input->get("client_name") : "";
?>
						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-12">
										<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
											<div class="row">
												<form method="GET" action="<?php echo base_url();?>Partner/list_partner">
													<div class="col-xs-1">
														<label>Partner </label>
													</div>
													<div class="col-md-6">
														<select style="width:100%;" name="client_name" aria-controls="dynamic-table" class="form-control allClientList">
															<option value=""></option>
															<?php
																if(!empty($client_name))
																{
																	?>
																		<option value="<?php echo $list_client[0]["id"]; ?>" selected><?php echo $list_client[0]["client_name"]; ?></option>
																	<?php
																}
															?>
														</select>
													</div>
													<!-- <div class="col-xs-3">
														<label>From :<input type="search" name="from_date" id="from_date" class="form-control input-sm" value="<?php echo $from_date; ?>" autocomplete="off" aria-controls="dynamic-table">
														</label>
													</div>
													<div class="col-xs-3">
														<label>To :<input type="search" name="to_date" id="to_date" class="form-control input-sm" value="<?php echo $to_date; ?>" autocomplete="off" aria-controls="dynamic-table">
														</label>
													</div> -->
													<div class="col-xs-3">
														<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
														<a href="<?php echo base_url();?>Partner/list_partner" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
													</div>
												</form>
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
												foreach($list_partners as $partner)
												{
													?>
													<tr>
														<td><?php echo $partner["name"]; ?></td>
														<td><?php echo $partner["email"]; ?></td>
														<td><?php echo $partner["mobile_number"]; ?></td>
														<td>
															<div class="action-buttons">
																<a class="blue" href="javascript:void(0);" onclick="showClientDetails('<?php echo $partner["id"];?>');">
																	<i class="ace-icon fa fa-info bigger-130"></i>
																</a>
																<a class="green" href="<?php echo base_url()."Partner/edit_partner/".$partner["id"]; ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="red" href="<?php echo base_url()."Partner/delete_partner/".$partner["id"]; ?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
																<!-- <a class="blue" title="Print" target="_blank" href="javascript:void(0);" onclick="getCardDetails('<?php echo $client['id'];?>');">
																	<i class="ace-icon fa fa-print bigger-130"></i>
																</a> -->
																<!-- <a class="blue" title="Print" target="_blank" href="<?php echo base_url()."Client/print_monthly_card/".$client["id"]; ?>">
																	<i class="ace-icon fa fa-print bigger-130"></i>
																</a> -->
																<!-- <a class="blue" title="Inventory Details" href="<?php echo base_url()."Client/get_inventory_details?client_id=".$client["id"]."&from_date=".date("01-m-Y")."&to_date=".date("d-m-Y"); ?>">
																	<i class="ace-icon fa fa-building bigger-130"></i>
																</a> -->
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
                                   if (count($list_partners)> 0) {
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
<div class="modal fade" id="clientInventory" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"><?php echo $client["client_name"]." ( ".date("F , Y")." )"; ?></h4>
    </div>
    <div class="modal-body" id="clientInventoryDetailsBody"></div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="clientDetails" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Client Details</h4>
    </div>
    <div class="modal-body" id="clientDetailsBody"></div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="details" role="dialog">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"></h4>
    </div>
    <div class="modal-body" id="detailsBody"></div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" onclick="getMonthlyCard();">Generate Card</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
	var loader_img = "<img style='margin-left:370px;' height='100' width='100' src='<?php echo base_url();?>assests/images/loading.gif'>";
	function showClientDetails(client_id)
	{
		$.ajax({
			url : "<?php echo base_url();?>Client/get_client_details",
			type : "POST",
			data : { client_id : client_id },
			beforeSend : function(){
				$("#clientDetailsBody").html(loader_img);
				$("#clientDetails").modal("show");
			},
			success : function(response){
				$("#clientDetailsBody").html(response);
				//console.log(response);
			},
			error : function(){
				$("#clientDetailsBody").html("Some Error Has Occurred");
			}
		});
	}
	function showInventoryDetails(client_id)
	{
		$.ajax({
			url : "<?php echo base_url();?>Inventory/get_inventory_details_for_client",
			type : "POST",
			data : { client_id : client_id },
			beforeSend : function(){
				$("#clientInventoryDetailsBody").html(loader_img);
				$("#clientInventory").modal("show");
			},
			success : function(response){
				$("#clientInventoryDetailsBody").html(response);
				//console.log(response);
			},
			error : function(){
				$("#clientInventoryDetailsBody").html("Some Error Has Occurred");
			}
		});
	}
	function getMonthlyCard()
	{
		var client_id = $("input[name='client_id']").val();
		var month_year = $("input[name='month_year']").val();

		month_year = new Date(month_year);
		
		window.open('<?php echo base_url();?>Client/print_monthly_card/'+client_id+'/'+(month_year.getMonth()+1)+'/'+month_year.getFullYear(), '_blank');
	}
	function getCardDetails(client_id)
	{
		if(client_id)
		{
			$("#details .modal-title").html("Select Month-Year");
			$("#details .modal-body").html(loader_img);
			$("#details").modal("show");
			var modalBody = '<div class="row"><input type="hidden" name="client_id" value="'+client_id+'"><div class="col-xs-12 col-sm-7"><div class="col-lg-6 form-group"><label>Date</label><div class=""><input type="text" name="month_year" readonly=""></div></div></div></div></div></div>';

			$("#detailsBody").html(modalBody);
			//$(".ui-datepicker-calendar").css({"display:none"});
            $('input[name="month_year"]').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst){ 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
            
		}
		else
		{
			alert("Please select A Client");
		}
	}
</script>