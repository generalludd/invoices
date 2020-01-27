<?php
?>

<form name="timesheet-search" id="timesheet-search" method="get"
			action="<?php echo site_url("timesheet/search"); ?>"
			class="form-dialog form-horizontal"
>
	<input class="form-control" type="hidden" name="is_search" value=1/>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="start_day">Start
			Day</label>
		<div class="col-sm-8">
			<input class="form-control" type="date" name="start_day" id="start_day"
						 style="width: auto;" value="<?php echo date('Y-m-d'); ?>"/>

		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap" for="end_day">End Day</label>
		<div class="col-sm-8">

			<input class="form-control" type="date" name="end_day" id="end_day"
						 style="width: auto;" value="<?php echo date('Y-m-d'); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label no-wrap">Client:</label>
		<div class="col-sm-8">
			<?php echo form_dropdown('client_id', $clients, $this->input->get('client_id'), "class='form-control'"); ?>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label no-wrap"
						 for="category">Category</label>
			<div class="col-sm-8">
				<?php echo form_dropdown("category", $categories, $this->input->get("category"), 'class="form-control"'); ?>
			</div>
		</div>
		<div class="form-group">

			<?php if (!empty($users)): ?>
				<label class="col-sm-4 control-label no-wrap" for="User">User</label>
				<div class="col-sm-8">
					<?php echo form_dropdown("user_id", $users, $user_id, 'class="form-control"'); ?>

				</div>
			<?php else: ?>
				<input type="hidden" name="user_id" value="<?php echo $user_id; ?>"/>
			<?php endif; ?>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<input type="submit" value="Search"
							 class="form-control search btn-default"/>
			</div>
		</div>

</form>
