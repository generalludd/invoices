<?php
?>
<form name="edit-client" action="<?php print base_url('contact/' . $action); ?>"
			method="POST">
	<input type="hidden" name="id" id="id"
				 value="<?php echo get_value($contact, "id"); ?>"/>
	<input type="hidden" name="user_id"
				 value="<?php echo get_value($contact, 'user_id', $this->ion_auth->get_user_id()); ?>"/>
	<?php $this->load->view('elements/input', [
		'type' => 'text',
		'label' => 'First Name',
		'name' => 'first_name',
		'value' => get_value($contact, 'first_name'),
		'required' => TRUE,

	]); ?>
	<?php $this->load->view('elements/input', [
		'type' => 'text',
		'label' => 'Last Name',
		'name' => 'last_name',
		'value' => get_value($contact, 'last_name'),
		'required' => TRUE,
	]); ?>
	<?php $this->load->view('elements/input', [
		'type' => 'email',
		'label' => 'Email',
		'name' => 'email',
		'value' => get_value($contact, 'email'),
	]); ?>
	<?php $this->load->view('elements/input', [
		'type' => 'tel',
		'label' => 'Phone',
		'name' => 'phone',
		'value' => get_value($contact, 'phone'),
	]); ?>
	<?php if ($action == 'update'): ?>
		<?php foreach ($clients as $client): ?>
			<input type="hidden" name="client_id[]" value="<?php echo $client->id; ?>"/>
			<?php $this->load->view('elements/input', [
				'type' => 'text',
				'label' => 'Role at ' . $client->client_name,
				'name' => 'role[]',
				'field_id' => 'role-' . $client->id,
				'value' => get_value($client, 'role'),
			]); ?>
		<?php endforeach; ?>
	<?php else: ?>
		<input type="hidden" name="client_id" value="<?php echo $client->id; ?>"/>
		<?php $this->load->view('elements/input', [
			'type' => 'text',
			'label' => 'Role at ' . $client->client_name,
			'name' => 'role',
			'value' => get_value($client, 'role'),
		]); ?>
	<?php endif; ?>

	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" value="<?php echo ucfirst($action); ?>"
						 class="form-control insert btn-default"/>
		</div>
	</div>
</form>
