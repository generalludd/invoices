<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// alert alert-s.php Chris Dart Mar 6, 2015 12:37:04 PM chrisdart@cerebratorium.com
if (! isset ( $message )) {
	$message = FALSE;
}
// MESSAGE Area
if ($this->session->flashdata ( "warning" ) || $message) :
	?>
<div class="alert alert-warning" id="warning">
<?php $message = $message?$message:$this->session->flashdata("warning");?>
<?php echo $this->session->flashdata("warning");?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata("success")):?>
<div class="alert alert-success" id="success">
<?php echo $this->session->flashdata("success");?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata("info")):?>
<div class="alert alert-info" id="info">
<?php echo $this->session->flashdata("info");?>
</div>
<?php endif; ?>
<?php if($this->session->flashdata("danger")):?>
<div class="alert alert-danger" id="danger">
<?php echo $this->session->flashdata("danger");?>
</div>

<?php endif;