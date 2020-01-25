<div class="login center-block">
	<h2><?php echo APP_NAME;?></h2>
	<p><?php echo lang('login_subheading');?></p>
<?php if($message): ?>
<div class="alert alert-warning"><?php echo $message;?></div>
<?php endif; ?>
<?php echo form_open("auth/login");?>
  <p>
    <?php echo form_input($identity,'',"class='form-control input-lg' placeholder='email address'");?>
  </p>

	<p>
    <?php echo form_input($password,'',"class='form-control input-lg' placeholder='password'");?>
  </p>

	<p><?php echo form_submit('submit', "Login", "class='btn btn-default'");?></p>

<?php echo form_close();?>

<p>
		<a style="font-weight: bold;" href="forgot_password">Forgot your password?</a>
	</p>
</div>