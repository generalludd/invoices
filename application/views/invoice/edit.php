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
		'required'=>TRUE,
]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'date',
		'name' => 'date_sent',
		'label' => 'Date Sent',
		'value'=> get_value($invoice, 'date_sent'),
		'required'=>FALSE,
	]);?>
	<?php $this->load->view('elements/input',[
		'type'=>'date',
		'name' => 'date_paid',
		'label' => 'Date Paid',
		'value'=> get_value($invoice, 'date_paid'),
		'required'=>FALSE,

	]);?>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" value="<?php echo ucfirst($action);?>" class="form-control insert btn-default" />
		</div>
	</div>
</form>
