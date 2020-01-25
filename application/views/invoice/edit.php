<?php
?>
<form name="edit-invoice" action="<?php echo base_url('invoice/' . $action);?>" method="post">
	<input type="hidden" name="id" value="<?php echo get_value($invoice, 'id');?>"/>
	<input type="hidden" name="user_id" value="<?php echo get_value($invoice,'user_id',$this->ion_auth->get_user_id())?>"/>
	<input type="hidden" name="client_id" value="<?php echo $client->id;?>"/>
	<?php $this->load->view('elements/input',[
		'type'=>'date',
		'name' => 'date_created',
		'label' => 'Date Created',
		'value'=> get_value($invoice, 'date_created', date('Y-m-d')),
]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'date',
		'name' => 'date_sent',
		'label' => 'Date Sent',
		'value'=> get_value($invoice, 'date_sent'),
	]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'date',
		'name' => 'date_paid',
		'label' => 'Date Paid',
		'value'=> get_value($invoice, 'date_paid'),
	]);?>
	<ul class="list-group">

	<?php foreach($time_entries as $entry):?>
		<li class="list-group-item">
			<?php echo $entry->var_value ?>:
			<?php echo $entry->details . '<br/> Date: ' . date('m/d/Y',strtotime($entry->day));?>
			<?php $end =  intval(date('U', strtotime($entry->end_time)));?>
			<?php $start =  intval(date('U',strtotime($entry->start_time)));?>
			<?php echo '<br/>Time: '.  gmdate('H:i:s', ($end - $start));?>
		</li>

	<?php endforeach;?>
	</ul>

</form>
