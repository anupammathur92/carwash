			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">
								<a href="<?php echo base_url();?>Inventory/list_inventory">List Invetory</a>
							</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
<?php
$client_name = $this->input->get("client_name") ? $this->input->get("client_name") : "";
$from_date = $this->input->get("from_date") ? $this->input->get("from_date") : "";
$to_date = $this->input->get("to_date") ? $this->input->get("to_date") : "";

$client_data = $this->Client_model->get_client_by_id($client_name);
?>
						<div class="page-header">
							<h1>List Inventory</h1>
						</div>
						<div class="row">
							<div class="col-xs-12">
<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer">
	<div class="row">
		<form method="GET" action="<?php echo base_url();?>Inventory/list_inventory">
			<div class="col-xs-3">
				<label>Client 
					<select style="width:100%;" name="client_name" aria-controls="dynamic-table" class="form-control allClientList">
						<option value=""></option>
						<option value="<?php echo $client_data["id"];?>" selected><?php echo $client_data["client_name"];?></option>
					</select>
				</label>
			</div>
			<div class="col-xs-3">
				<label>From :<input type="search" name="from_date" id="from_date" class="form-control input-sm" value="<?php echo $from_date; ?>" autocomplete="off" aria-controls="dynamic-table">
				</label>
			</div>
			<div class="col-xs-3">
				<label>To :<input type="search" name="to_date" id="to_date" class="form-control input-sm" value="<?php echo $to_date; ?>" autocomplete="off" aria-controls="dynamic-table">
				</label>
			</div>
			<div class="col-xs-3">
				<input type="submit" class="btn btn-primary form-control input-sm" placeholder="" aria-controls="dynamic-table" value="Search">
				<a href="<?php echo base_url();?>Inventory/list_inventory" class="btn btn-default form-control input-sm" placeholder="" aria-controls="dynamic-table">Reset</a>
			</div>
		</form>
	</div>
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
	<thead>
		<tr role="row">
			<th tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">Client Name</th>
			<th tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">Date / Time</th>
			<th class="hidden-480" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending">In Quantity</th>
			<th tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label=": activate to sort column ascending">Out Quantity</th>
			<th class="hidden-480" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Action</th>
		</tr>
	</thead>
	<?php
	foreach($list_inventory as $inventory)
	{
		$client_data = $this->Client_model->get_client_by_id($inventory["client_id"]);
		?>
	<tbody>
		<tr role="row" class="odd">
			<td><?php echo $client_data["client_name"]; ?></td>
			<td><?php echo date("d-m-Y",strtotime($inventory["date_time"])); ?></td>
			<td><?php echo $inventory["in_quantity"]; ?></td>
			<td><?php echo $inventory["out_quantity"]; ?></td>
			<td>
				<div class="action-buttons">
					<?php
					if($inventory["is_billed"]==0)
					{
						?>
						<a class="green" href="<?php echo base_url()."Inventory/edit_inventory/".$inventory["id"]; ?>">
							<i class="ace-icon fa fa-pencil bigger-130"></i>
						</a>
						<a class="red" href="<?php echo base_url()."Inventory/delete_inventory/".$inventory["id"]; ?>">
							<i class="ace-icon fa fa-trash-o bigger-130"></i>
						</a>
						<?php
					}
					?>
					<!-- <a title="Add Inventory" class="blue" href="<?php echo base_url(); ?>Inventory/delete_inventory/<?php echo $inventory["id"]; ?>" id="175"><i class="menu-icon fa fa-pencil-square-o"></i>
					</a> -->

				</div>
			</td>
		</tr>
		</tbody>
		<?php
		}
		?>
		</table>
	</div>
				</div>
	     <?php
	    if(count($list_inventory)> 0)
	    {
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