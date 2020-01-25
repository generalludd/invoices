<?php if(!$ajax):?>
<h1><?php echo lang('create_group_heading');?></h1>
<?php endif; ?>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>
<div class="form-horizontal">

	<div class="form-group">
            <?php echo form_label("Group Name:", 'group_name',array("class"=>"col-sm-3 control-label"));?> <div class="col-sm-9">
            <?php echo form_input($group_name);?>
            </div>
	</div>

	<div class="form-group">
            <?php echo form_label("Description:", 'description',array("class"=>"col-sm-3 control-label"));?> <div class="col-sm-9">
            <?php echo form_input($description);?>
            </div>
	</div>
</div>
<div class="form-horizontal">
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9"><?php echo form_submit('submit', "Add Group","class='button new btn btn-default'");?></div>
	</div>
</div>
<?php echo form_close();?>