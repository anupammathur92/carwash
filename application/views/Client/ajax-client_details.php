<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
	<thead>
		<tr>
			<th>Client Name</th>
			<th>Client Address</th>
			<th>Client Contact No.</th>
			<th>Client Code</th>
			<th>Remarks</th>
			<th>Start Date</th>
			<th>Security Amount</th>
			<th>Security Amount Returned</th>
		</tr>
	</thead>
	<tbody>
		<td><?php echo $client_data["client_name"]; ?></td>
		<td><?php echo $client_data["client_address"]; ?></td>
		<td><?php echo $client_data["client_contact_no"]; ?></td>
		<td><?php echo $client_data["client_code"]; ?></td>
		<td><?php echo nl2br($client_data["remarks"]); ?></td>
		<td><?php if(!empty($client_data["start_date"])){ echo date("d-m-Y",strtotime($client_data["start_date"])); } ?></td>
		<td><?php echo $client_data["security_amount"]; ?></td>
		<td><?php if($client_data["security_returned"]){ echo "Yes";}else { echo "No"; } ?></td>
	</tbody>
</table>