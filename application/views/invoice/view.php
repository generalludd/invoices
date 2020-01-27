<?php

?>
<div class="container">
	<div class="row">
		<div class="invoice-info col-sm">
			<fieldset>
				<legend>Invoice Details</legend>
				<?php print create_button([
					'text' => 'Edit',
					'href' => base_url('invoice/edit/' . $invoice->id),
					'class' => 'btn btn-default dialog edit',
					'style' => 'edit',
				]); ?>
				<div class="label">Date Created</div>
				<div
					class="value"><?php echo date('m/d/Y', strtotime($invoice->date_created)); ?>
				</div>
			</fieldset>

		</div>
		<div class="client-info col-sm">
			<?php $this->load->view('client/block', ['client' => $invoice->client]); ?>
		</div>
	</div>
	<div class="row">
		<div class="line-items col-sm">
			<fieldset>
				<legend>Work Log</legend>
				<div class="invoiced-work-entries work-log">
				<?php $this->load->view('timesheet/table', [
					'time_entries' => $invoice->time_entries,
					'invoice_id' => $invoice->id,
					'action' => 'remove',
					'rate' => $invoice->client->rate,
				]); ?>
				</div>
			</fieldset>
		</div>
		<div class="line-items col-sm">
			<fieldset>
				<legend>Available Time Entries</legend>
				<div class="available-work-entries work-log">
				<?php $this->load->view('timesheet/table', [
					'time_entries' => $free_entries,
					'invoice_id' => $invoice->id,
					'action' => 'add',
					'rate' => $invoice->client->rate,
				]); ?>
				</div>
			</fieldset>
		</div>
	</div>
</div>

