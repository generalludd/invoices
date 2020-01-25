<?php
if(isset($contacts)):?>
	<ul class="list-group">

<?php foreach($contacts as $contact):?>
	<li class="list-group-item">
	<a href="<?php echo base_url('contact/view/' . $contact->id);?>" class="btn btn-info edit dialog" title="View this contact's record">
	<?php print $contact->first_name . ' ' . $contact->last_name;?></a>
	</li>
<?php endforeach;?>
	</ul>

<?php endif;
