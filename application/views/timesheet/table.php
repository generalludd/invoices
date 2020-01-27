<?php
$total_time = 0;
?>
<table class="table">
	<thead>
	<tr>
		<th>Date
		</th>
		<th>Time Spent</th>
		<th>Cost</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($time_entries as $time_entry): ?>
		<?php $lapsed_time = get_lapsed_time($time_entry); ?>
		<tr>
			<td>
				<?php echo create_button([
					'text' => date('m/d/Y', strtotime($time_entry->day)),
					'class' => 'link dialog edit',
					'href' => base_url('timesheet/edit/' . $time_entry->id),
					'data-attributes'=>['redirect'=>'invoice/view/' . $invoice_id],
				]); ?></td>
			<td>
				<?php echo $lapsed_time->time; ?>
			</td>
			<td>
				<?php echo get_as_price($lapsed_time->seconds / 60 / 60 * $rate); ?>
			</td>
			<td>
				<?php echo create_button([
					'text' => ucfirst($action),
					'style' => 'new',
					'class' => 'btn btn-default inline',
					'href' => base_url('timesheet/invoice/' . $action . '/' . $time_entry->id . '/' . $invoice_id),
					'data-attributes'=>['redirect'=>'invoice/view/' . $invoice_id],

				]); ?>
			</td>
		</tr>
		<?php $total_time += $lapsed_time->seconds; ?>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
	<tr>
		<td>
		</td>
		<td>
			<?php echo gmdate('j\h i\m', $total_time); ?>
		</td>
		<td>
			<?php echo get_as_price($total_time / 3600 * $rate); ?>
		</td>
	</tr>
	</tfoot>
</table>
