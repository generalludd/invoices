<?php if(!$ajax):?>
<div class="form-horizontal">
	<div class="form-group">
		<h1 class="col-sm-offset-2"><?php echo lang('deactivate_heading');?></h1>
	</div>
</div>
<?php endif; ?>
<div class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-offset-2"><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></div>
	</div>
</div>

<?php echo form_open("auth/deactivate/".$user->id);?>
<div class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-offset-2">
  	<?php echo form_label("Yes", 'confirm', array('class'=>'form-label'));?>
    <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo form_label("No", 'confirm', array('class'=>'form-label'));?>
    <input type="radio" name="confirm" value="no" />
		</div>
	</div>
<?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>

<div class="form-group">
		<div class="col-sm-offset-2"><?php echo form_submit('submit', "Deactivate","class='btn btn-default edit'");?></div>
	</div>
</div>
<?php echo form_close();?>