<?php
?>
<form name="timesheet-edit" id="timesheet-edit" method="post" action="<?php echo site_url("timesheet/$action");?>"
	class="form-dialog form-horizontal"
>
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $user->id;?>" />
	<input type="hidden" name="id" id="id" value="<?php echo get_value($entry,"id");?>" />
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Date:</label>
		<div class="col-sm-8">
			<input type="date" name="day" id="day" value="<?php echo get_value($entry,"day",date('Y-m-d'));?>" required />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Start Time: <a href="#" class="insert-time start_time">(now)</a></label>
		<div class="col-sm-8">
			<input type="time" name="start_time" id="start_time" value="<?php echo get_value($entry,"start_time",date('H:i').":00");?>" required />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">End Time: <a href="#" class="insert-time end_time">(now)</a></label>
		<div class="col-sm-8">
			<input type="time" name="end_time" id="end_time" value="<?php echo get_value($entry,"end_time");?>" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Client:</label>
		<div class="col-sm-8">
			<?php echo form_dropdown('client_id',$clients ,get_value($entry,'client_id'),"required=required class='form-control'");?>
		</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Category:</label>
		<div class="col-sm-8">
<?php echo form_dropdown('category',$categories,get_value($entry,'category'),"required=required class='form-control'");?>
</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Description:</label>
		<div class="col-sm-8">
			<textarea name="details" class="form-control details"><?php echo get_value($entry,'details');?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type="submit" value="<?php echo ucfirst($action);?>" class="form-control insert btn-default" />
<?php if($action == "update"):?>
&nbsp;<a href="<?php echo site_url("timesheet/delete");?>" class="delete delete-entry redirect" id="delete_<?php echo $entry->id;?>">Delete</a>
<?php endif; ?>
</div>
	</div>
</form>
