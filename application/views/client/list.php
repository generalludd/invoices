<?php
if(isset($clients)):?>
<table class="table table-resposive">
	<thead>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Contacts</th>
	</tr>
	</thead>
	<tbody>
<?php foreach($clients as $client):?>
<tr>
	<td><a href="<?php echo base_url('client/view/'. $client->id);?>" title="View client details"><?php echo $client->client_name;?></a></td>
	<td><?php echo $client->email; ?></td>
	<td><?php echo $client->phone; ?></td>
	<td><?php $this->load->view('contact/list/mini',['contacts'=>$client->contacts]);?></td>
</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php endif;
