			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="<?php echo base_url();?>">Home</a>
							</li>
							<li class="active">Update Client</li>
						</ul><!-- /.breadcrumb -->
					</div>
					<div class="page-content">
						<div class="page-header">
							<h1>Edit Client</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							</div>
						</div>
						<?php echo validation_errors(); ?>
						<form class="form-horizontal" role="form" method="POST" action="<?php echo base_url();?>Client/update_client">
							<input type="hidden" name="update_id" value="<?php echo $client_data["id"]; ?>">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Name </label>
								<div class="col-sm-9">
									<input type="text" name="client_name" id="form-field-1" value="<?php if(isset($client_data)){ echo $client_data['client_name']; }?>" placeholder="Client Name" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Address </label>
								<div class="col-sm-9">
									<textarea style="resize:none;" class="col-xs-10 col-sm-5" id="form-field-8" name="client_address" placeholder="Default Text"><?php if(isset($client_data)){ echo $client_data['client_address']; }?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact No. </label>
								<div class="col-sm-9">
									<input type="text" name="client_contact_no" id="form-field-1" placeholder="Client Name" value="<?php if(isset($client_data)){ echo $client_data['client_contact_no']; }?>" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Client Code </label>
								<div class="col-sm-9">
									<input type="text" name="client_code" placeholder="Client Code" value="<?php if(isset($client_data)){ echo $client_data['client_code']; }?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Remarks </label>
								<div class="col-sm-9">
									<textarea class="col-xs-10 col-sm-5" name="remarks" placeholder="Remarks" cols="20" rows="5" style="resize:none;"><?php if(isset($client_data)){ echo $client_data['remarks']; }?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start Date </label>
								<div class="col-sm-9">
									<input type="text" name="start_date" id="start_date" placeholder="Start Date" class="col-xs-10 col-sm-5" value="<?php if(isset($client_data) && $client_data["start_date"]!=""){ echo date("d-m-Y",strtotime($client_data['start_date'])); }?>" readonly/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Security Amount </label>
								<div class="col-sm-9">
									<input type="text" name="security_amount" placeholder="Security Amount" value="<?php if(isset($client_data)){ echo $client_data['security_amount']; }?>" class="col-xs-10 col-sm-5"/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
								<div class="col-sm-9">
									<div class="radio">
										<label>
											<input name="security_returned" value="1" <?php if(isset($client_data) && $client_data["security_returned"]==1){ echo "checked"; }?> type="checkbox" class="ace">
											<span class="lbl"> Security Returned</span>
										</label>
									</div>
								</div>
							</div>
							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info" type="submit">Update</button>
									&nbsp; &nbsp; &nbsp;
									<a class="btn" href="<?php echo base_url();?>Client/list_client">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>