<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
	<thead>
		<tr>
			<th>Date / Time</th>
			<th>In Quantity</th>
			<th>Out Quantity</th>
		</tr>
	</thead>
	<tbody>
	<?php
	if(count($list_inventory) > 0)
	{
		$in_quantity = 0;
		$out_quantity = 0;
		foreach($list_inventory as $inventory)
		{
			$in_quantity += $inventory["in_quantity"];

			$out_quantity +=$inventory["out_quantity"];
			?>
				<tr>
					<td><?php echo date("d-m-Y",strtotime($inventory["date_time"]));?></td>
					<td><?php echo $inventory["in_quantity"];?></td>
					<td><?php echo $inventory["out_quantity"];?></td>
				</tr>		
			<?php
		}
		?>
		<tr>
			<td style="text-align:right;" colspan="2">Total OUT</td>
			<td><?php echo $out_quantity; ?></td>
		</tr>
		<tr>
			<td style="text-align:right;" colspan="2">Total IN</td>
			<td><?php echo $in_quantity; ?></td>
		</tr>
		<tr>
			<td style="text-align:right;" colspan="2">Net Total</td>
			<td><?php echo ($out_quantity - $in_quantity); ?></td>
		</tr>
		<?php
	}
	else
	{
		?>
		<tr>
			<td colspan="3">No Inventory Found.</td>
		</tr>
		<?php
	}
	?>
	</tbody>
</table>
<div class="clr"></div>