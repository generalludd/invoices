<?php
if (!isset($type)) {
	$type = 'text';
}
if (!isset($field_id)) {
	$field_id = $name;
}
$classes[] = 'form-control';

if(!isset($attributes)){
	$attributes = '';
}
?>
<div class="form-group row">

	<label class="col-sm-4 col-form-label"
				 for="<?php echo $name; ?>"><?php echo $label; ?></label>
	<div class="col-sm-8">
		<input type="<?php echo $type; ?>" class="<?php echo implode(' ' ,$classes);?>"
					 name="<?php echo $name; ?>" id="<?php echo $field_id; ?>" <?php echo $attributes; ?>
					 value="<?php echo $value; ?>"
					 <?php echo (isset($required) && $required == TRUE)?'required':'';?>
		/>
	</div>
</div>
