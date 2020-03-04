<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
	<thead>
		<tr>
			<th>Client Name</th>
			<th>From Date</th>
			<th>To Date</th>
			<th>Total Campers</th>
			<th>Price (in Rs.)</th>
			<th>Total (in Rs.)</th>
		</tr>
	</thead>
	<tbody>
		<td><?php echo $client_data["client_name"]; ?></td>
		<td><?php echo $bill_data["from_date"]; ?></td>
		<td><?php echo $bill_data["to_date"]; ?></td>
		<td><?php echo $bill_data["total_campers"]; ?></td>
		<td><?php echo number_format($bill_data["price"],2,".",","); ?></td>
		<td><?php echo number_format(($bill_data["total_campers"]*$bill_data["price"]),2,".",","); ?></td>
	</tbody>
</table>