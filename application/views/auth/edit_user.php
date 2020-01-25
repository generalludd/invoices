<?php if(!$ajax): ?>
<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>
<?php endif;?>
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string(),array("class"=>"form-horizontal"));?>

<div class="form-group">
            <?php echo form_label("First Name:", 'first_name',array("class"=>"col-sm-3 control-label"));?>  
            <div class="col-sm-9">

            <?php echo form_input($first_name);?>
            </div>
</div>

<div class="form-group">
            <?php echo form_label("Last Name:", 'last_name',array("class"=>"col-sm-3 control-label"));?>  
            <div class="col-sm-9">

            <?php echo form_input($last_name);?>
            </div>
</div>

<div class="form-group">
            <?php echo form_label("Password:", 'password',array("class"=>"col-sm-3 control-label"));?>  
            <div class="col-sm-9">

            <?php echo form_input($password);?>
            </div>
</div>

<div class="form-group">
            <?php echo form_label("Confirm Password:", 'password_confirm',array("class"=>"col-sm-3 control-label"));?> 
            <div class="col-sm-9">

            <?php echo form_input($password_confirm);?>
            </div>
</div>

<?php if ($this->ion_auth->is_admin()): ?>
<div class="form-group">
	<label class="col-sm-3 control-label">Groups</label>
<?php foreach ($groups as $group):?>
<div class="checkbox  col-sm-offset-3">
		<label class="checkbox">
              <?php
		$gID = $group ['id'];
		$checked = null;
		$item = null;
		foreach ( $currentGroups as $grp ) {
			if ($gID == $grp->id) {
				$checked = ' checked="checked"';
				break;
			}
		}
		?>
              <input type="checkbox" name="groups[]" value=" <?php echo $group['id'];?>" <?php echo $checked;?>>
              <?php echo $group['name'];?>
              </label>
	</div>
<?php endforeach?>

      <?php endif ?>
</div>
<?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9"><?php echo form_submit('submit', "Save User","class='btn btn-default'");?></div>
</div>
<?php echo form_close();?>
