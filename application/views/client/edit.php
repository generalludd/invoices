<?php
if (!isset($action)) {
	$action = 'view';
}

$client_rate = get_value($client, 'rate', NULL);
if($client_rate == NULL || $client_rate === 0){
	$client_rate = floatval( $this->globals->get('base_rate', $this->ion_auth->get_user_id()));
}
?>
<form name="edit-client" action="<?php print base_url('client/' . $action); ?>"
			method="POST">
	<input type="hidden" name="id" id="id"
				 value="<?php echo get_value($client, "id"); ?>"/>
	<input type="hidden" name="user_id" value="<?php echo get_value($client, 'user_id', $this->ion_auth->get_user_id());?>"/>
	<?php $this->load->view('elements/input', [
		'type'=>'text',
		'label' => 'Client Name',
		'name' => 'client_name',
		'value' => get_value($client,'client_name'),
	]); ?>
	<?php $this->load->view('elements/input', [
		'type'=>'number',
		'label' => 'Rate',
		'name' => 'rate',
		'attributes' => 'step=".01"',
		'value' => $client_rate,
	]); ?>
	<?php $this->load->view('elements/input', [
		'type'=>'text',
		'label' => 'Address',
		'name' => 'address',
		'value' => get_value($client, 'address'),
	]); ?>
	<?php $this->load->view('elements/input', [
		'type'=>'text',
		'label' => 'City',
		'name' => 'city',
		'value' => get_value($client,'city'),
	]); ?>
	<?php $this->load->view('elements/input', [
		'type'=>'text',
		'label' => 'State/Province',
		'name' => 'state',
		'classes'=>['state'],
		'value' => get_value($client,'state'),
	]); ?>
	<?php $this->load->view('elements/input', [
		'type'=>'text',
		'label' => 'Postal Code',
		'name' => 'postal_code',
		'classes'=>['postal-code'],
		'value' => get_value($client,'postal_code'),
	]); ?>

	<?php $this->load->view('elements/input',[
		'type'=>'text',
		'label'=>'Country',
		'name'=>'country',
		'value'=>get_value($client, 'country','USA'),
]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'url',
		'label'=>'URL',
		'name'=>'url',
		'value'=>get_value($client,'url'),
	]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'email',
		'label'=>'Email',
		'name'=>'email',
		'value'=>get_value($client,'email'),
	]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'tel',
		'label'=>'Phone',
		'name'=>'phone',
		'value'=>get_value($client, 'phone'),
	]);?>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" value="<?php echo ucfirst($action); ?>"
						 class="form-control insert btn-default"/>
		</div>
	</div>

</form>
