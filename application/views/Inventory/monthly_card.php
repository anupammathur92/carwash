<?php 
	//echo "<pre>"; print_r($list_inventory); echo "</pre>";
	$list_inventory = array_column($list_inventory,"tot_out_quantity","day_of_month");
	//echo "<pre>"; print_r($list_inventory); echo "</pre>";
?>
<style type="text/css">
	table,table th, table td {
		border-collapse: collapse;
		border-spacing: 0;
		border : 0.5px solid black;
		text-align:center;
	}

</style>
<table style="border:1px solid black" cellspacing="0" cellpadding="1">
	<tr>
		<td colspan="3">RO Technology + U.V. Tested + Softner</td>
		<td colspan="3">Mob : 94601-73414 (Vinod) <br> 90792-66462</td>
	<tr>
	<tr>
		<th colspan="6">SHIV GANGA</th>
	<tr>
	<tr>
		<th colspan="6">Pure Water Industries</th>
	<tr>
	<tr>
		<th colspan="6">Behind Ahinsa Circle Near Railway Station,Baran (Raj.)</th>
	<tr>
	<tr>
		<th colspan="6">MONTHLY CUSTOMER CARD</th>
	<tr>
	<tr>
		<th>Customer Name</th>
		<td colspan="5"><?php echo $client_data["client_name"]; ?></td>
	</tr>
	<tr>
		<th>Customer Address</th>
		<td colspan="5"><?php echo $client_data["client_address"]; ?></td>
	</tr>
	<tr>
		<th>Mobile</th>
		<td colspan="2"><?php echo $client_data["client_contact_no"]; ?></td>
		<th>Month</th>
		<td colspan="2"><?php echo date("F, Y"); ?></td>
	</tr>
	<tr>
		<th>Date</th>
		<th>Remarks</th>
		<th>Signature</th>
		<th>Date</th>
		<th>Remark</th>
		<th>Signature</th>
	</tr>
	<?php
	for($i=1;$i<=17;$i++)
	{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php if(isset($list_inventory[$i])){ echo $list_inventory[$i]; } else { echo "0"; } ;?></td>
			<td></td>
			<?php
				if($i<=14)
				{
					?>
					<td><?php echo $i+17; ?></td>
					<td><?php if(isset($list_inventory[$i+17])){ echo $list_inventory[$i+17]; } else { echo "0"; } ;?></td>
					<td></td>
					<?php
				}
				elseif($i==15)
				{
					?>
					<td><?php echo "<b>Total</b> "; ?></td>
					<td><?php echo array_sum($list_inventory); ?></td>
					<td></td>
					<?php
				}
			?>
		</tr>
		<?php
	}
	?>
</table>