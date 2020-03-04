<table class="table" cellspacing="1" cellpadding="1">
		<tr>
			<td style="text-align:right;" colspan="4">Mob: 9460173414<br>
								9079266462
			</td>
		</tr>
		<tr>
			<td colspan="4">SHIV-GANGA PURE WATER IND.</td>
		</tr>
		<tr>
			<td colspan="4">BEHIND AHINSA CIRCLE, NEAR RAILWAY STATION, BARAN (RAJ.) 325205</td>
		</tr>
		<tr>
			<td colspan="2"><label>M/s  </label><strong><?php echo $client_data["client_name"];?></strong></td>
			<td colspan="2">
				<table style="border:0px;">
					<!-- <tr>
						<td style="border:0px;">Bill No.</td>
						<td style="border:0px;"></td>
					</tr> -->
					<tr>
						<td style="border:0px;text-align:left;">From</td>
						<td style="border:0px;text-align:right;"><?php echo date("d-m-Y",strtotime($bill_data["from_date"]));?></td>
					</tr>
					<tr>
						<td style="border:0px;text-align:left;">To</td>
						<td style="border:0px;text-align:right;"><?php echo date("d-m-Y",strtotime($bill_data["to_date"]));?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>Particulars</th>
			<th>Qty.</th>
			<th>Rate</th>
			<th>Amount</th>
		</tr>
		<tr>
			<td><?php echo $client_data["client_name"];?></td>
			<td><?php echo $bill_data["total_campers"];?></td>
			<td><?php echo $bill_data["price"];?></td>
			<td><?php echo $bill_data["total_campers"]*$bill_data["price"];?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right;">For : SHIV GANGA PURE WATER IND.</td>
		</tr>
</table>
<style type="text/css">
	table,table th, table td {
		border-collapse: collapse;
		border-spacing: 0;
		border : 0.5px solid black;
		text-align:center;
	}

</style>