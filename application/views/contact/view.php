<?php
$buttons[] = [
	'text' => 'Edit',
	'href' => base_url('contact/edit/' . $contact->id),
	'class' => 'btn btn-default edit dialog',
];
print create_toolbar($buttons);
?>
<fieldset>
	<legend><?php echo format_name($contact); ?></legend>
	<div class="attribute email">
		<?php echo $contact->email; ?>
	</div>
	<div class="attribute phone">
		<?php echo $contact->phone; ?>
	</div>
	<?php if (isset($contact->clients)): ?>
		<?php foreach ($contact->clients as $client): ?>
			<div class="attribute role">
				Role
				at <?php echo internal_link('/client/view/' . $client->id, 'View ' . $client->client_name, $client->client_name); ?>
				: <?php echo $client->role; ?>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		Role: <?php echo $contact->role; ?>
	<?php endif; ?>
</fieldset>
