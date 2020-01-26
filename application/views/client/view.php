<?php
$buttons[] = [
	'text' => 'Edit',
	'href' => base_url('client/edit/' . $client->id),
	'class' => 'btn btn-default edit dialog',
];
$buttons[] = [
	'text' => 'Add contact',
	'href' => base_url('contact/create/' . $client->id),
	'class' => 'btn btn-default create dialog',
	'style' => 'new',

];
print create_toolbar($buttons);
?>
<div class="container">
	<div class="row">
		<div class="col-sm">
			<?php $this->load->view('client/view',['client'=>$client]);?>
		</div>
		<div id="contacts-view" class="col-sm">
			<?php foreach ($client->contacts as $contact): ?>
				<?php $this->load->view('contact/view', ['contact' => $contact]); ?>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col">
			<fieldset>
				<legend>Invoices</legend>
				<?php $invoice_buttons[] = [
					'text'=>'New Invoice',
					'style' => 'new',
					'class'=>'btn btn-default',
					'href'=>base_url('invoice/create/'. $client->id),
				]; ?>
				<?php print create_toolbar($invoice_buttons);?>
			</fieldset>
		</div>
		<div class="col">
			<fieldset>
				<legend>Uninvoiced Work</legend>
			</fieldset>
		</div>
	</div>
</div>
