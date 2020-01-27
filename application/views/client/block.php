<?php
?>
<fieldset>
	<legend>
		<?php print internal_link('client/view/' . $client->id, get_value($client, 'client_name')); ?>
	</legend>
	<div class="attribute rate">
		Rate: <?php echo get_as_price($client->rate);?>
	</div>
	<?php if ($address = get_value($client, "address", FALSE)): ?>
		<div class='attribute address'><?php echo $address; ?></div>
		<div class='attribute region'>
			<?php if (isset($client->city)): ?>
				<?php echo $client->city; ?>,
			<?php endif; ?>
			<?php if (isset($client->state)): ?>
				<?php echo $client->state; ?>
			<?php endif; ?>
			<?php if (isset($client->postal_code)): ?>
				<?php echo $client->postal_code; ?>
			<?php endif; ?>
		</div>
		<div class="attribute country">
			<?php if (isset($client->country)): ?>
				<?php echo $client->country; ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php if ($url = get_value($client, "url", FALSE)): ?>
		<div class="attribute url">
			<a href='<?php echo $url; ?>'
				 target='_blank'><?php echo $url; ?></a>
		</div>
	<?php endif; ?>
	<?php if ($phone = get_value($client, "phone", FALSE)): ?>
		<div class="attribute phone">
			<label for="phone">Phone: </label>
			<?php echo $phone; ?>
		</div>
	<?php endif; ?>
	<?php if ($email = get_value($client, "email", FALSE)): ?>
		<div class="attribute email">
			<label for="email">Email: </label>
			<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
		</div>
	<?php endif; ?>

</fieldset>
