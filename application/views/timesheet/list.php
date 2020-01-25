<?php
defined('BASEPATH') or exit ('No direct script access allowed');
$total_time = 0;

$buttons [] = [
	"text" => "New Entry",
	"href" => base_url("timesheet/create?ajax=1"),
	"style" => "new",
	"class" => "btn btn-default create dialog",
];
$buttons [] = [
	"text" => "Search",
	"href" => base_url("timesheet/search?ajax=1"),
	"class" => "btn btn-default create dialog",
	"style" => "refine",
];
if ($this->input->get("is_search")) {
	$buttons [] = [
		"text" => "Export",
		"href" => $_SERVER ['REQUEST_URI'] . "&export=true",
		"style" => "export",
		"class" => "btn btn-default export",
	];
}
$current_client = 0;
?>
<?php echo create_button_bar($buttons); ?>
<div class='table-responsive'>
	<table class='table'>
		<tbody>
		<?php $current_day = FALSE; ?>
		<?php foreach ($entries as $entry): ?>
		<?php if($entry->client_id != $current_client):?>
			<?php $current_client = $entry->client_id;?>
		<tr>
			<td colspan="8">
				<?php echo $entry->client->client_name;?>
			</td>
		</tr>
		<?php endif;?>
			<tr>
				<td>
					<?php $inline_buttons = []; ?>
					<?php $inline_buttons[] = [
						"text" => "Edit",
						"class" => "btn-sm edit dialog insert",
						"href" => base_url("timesheet/edit/$entry->id?ajax=1"),
						"style" => "edit",
					]; ?>
					<?php $inline_buttons[] = [
						"text" => "Next  <i class='fa fa-arrow-down'></i>",
						"class" => "btn-sm next",
						"href" => base_url("timesheet/next/$entry->id"),
						"title" => "Next time entry starting at $entry->end_time",
						"style" => "btn",
					]; ?>

					<?php echo create_button_bar($inline_buttons); ?>
				</td>
				<td class='day'>
					<?php if ($current_day != $entry->day): ?>
						<?php echo format_date($entry->day, 'standard'); ?>
						<?php $current_day = $entry->day; ?>
					<?php endif; ?>
				</td>
				<td>
					<?php echo date('g:i a', strtotime("$entry->day $entry->start_time")); ?>
				</td>
				<td>
					<?php echo date('g:i a', strtotime("$entry->day $entry->end_time")); ?>
				</td>
				<td>
					<?php

					$time_passed = (strtotime($entry->day . $entry->end_time) - strtotime($entry->day . $entry->start_time)) / 3600;
					$total_time += $time_passed;
					echo round($time_passed, 2);;
					?>
				</td>
				<td>
					<?php echo $entry->var_value; ?>
				</td>
				<td style="max-width: 50em;">
					<?php echo $entry->details; ?>
				</td>
				<td>
					<?php echo isset($entry->invoice_id)? internal_link('invoice/view/' . $entry->invoice_id, 'View this invoice','Invoice: ' . $entry->invoice_id):'Not invoiced';?>
				</td>

			</tr>

		<?php endforeach; ?>
		</tbody>
		<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th colspan=2>Total Time</th>
			<th>
				<?php echo round($total_time, 2); ?>
			</th>
			<th colspan="3">
		</tr>
		</tfoot>
	</table>
</div>
