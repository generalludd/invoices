<h1><?php echo lang('change_password_heading');?></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

<div class="form-group">
            <?php echo form_label("Old Password", 'old_password',array("class"=>"col-sm-3 control-label"));?> 
            <div class="col-sm-9">
            <?php echo form_input($old_password);?>
            </div>
</div>

<div class="form-group">
	<label for="new_password" class"col-sm-3control-label"><?php echo sprintf("New Password (at least %s characters long):", $min_password_length);?></label>
	<div class="col-sm-9">
            <?php echo form_input($new_password);?>
            </div>
</div>

<div class="form-group">
            <?php echo form_label("Confirm New Password:", 'new_password_confirm',array("class"=>"col-sm-3 control-label"));?> 
            <div class="col-sm-9">
            <?php echo form_input($new_password_confirm);?>
            </div>
</div>

<?php echo form_input($user_id);?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
<?php echo form_submit('submit', "Change Password","class='button edit'");?></div>
</div>

<?php echo form_close();?>
