<?php
if (!isset($classes)) {
	$classes[] = 'form-control ';
}
if (!isset($field_id)) {
	$field_id = $name;
}
?>
<label for="<?php echo $name; ?>>" class="col-sm-4 control-label"
			 for="address"><?php echo $label; ?></label>
<div class="col-sm-4">
	<textarea id="<?php echo $field_id; ?>" name="<?php echo $name; ?>"
						class="<?php echo implode(' ', $classes); ?>"><?php echo $value; ?></textarea>
</div>
