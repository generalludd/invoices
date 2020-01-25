<?php if(!$ajax):?>
<h1><?php echo lang('create_user_heading');?></h1>
<?php endif;?>
<div class="form-group"><?php echo lang('create_user_subheading');?></div>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user",array('class'=>'form-horizontal'));?>

<div class="form-group">
            <?php echo form_label("First Name:", 'first_name', array("class"=>"col-sm-3 control-label"));?> 
 <div class="col-sm-9">
            <?php echo form_input($first_name);?>
            </div>
</div>

<div class="form-group">
            <?php echo form_label("Last Name:", 'last_name',array("class"=>"col-sm-3 control-label"));?>  <div class="col-sm-9">
            <?php echo form_input($last_name);?>
            </div>
</div>
<div class="form-group">
            <?php echo form_label("Email:", 'email', array("class"=>"col-sm-3 control-label"));?>  <div class="col-sm-9">
            <?php echo form_input($email);?>
      </div>
</div>
<div class="form-group">
            <?php echo form_label("Password:", 'password', array("class"=>"col-sm-3 control-label"));?>  <div class="col-sm-9">
            <?php echo form_input($password);?>
      </div>
</div>
<div class="form-group">
            <?php echo form_label("Confirm Password:", 'password_confirm', array("class"=>"col-sm-3 control-label"));?>  <div class="col-sm-9">
            <?php echo form_input($password_confirm);?>
      </div>
</div>

<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
<?php echo form_submit('submit', "Create User","class='button new btn btn-default'");?></div>
</div>
<?php echo form_close();?>
