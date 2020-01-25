<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

$buttons [] = array (
		"text" => "Create User",
		"class" => array (
				"button create dialog btn-xs" 
		),
		"style" => "new",
		"href" => site_url ( "auth/create_user" ) 
);
$buttons [] = array (
		"text" => "Create Group",
		"class" => array (
				"button create dialog btn-xs" 
		),
		"style" => "new",
		"href" => site_url ( "auth/create_group" ) 
);

if($show_inactive){
    $buttons [] = array(
        'text' => 'Show Active Only',
        'title' => 'Only show the active users (default)',
        'class'=>array('btn-xs button btn btn-default'),
        'href'=>site_url('auth/'),
    );
}else{

$buttons [] = array(
        'text' => 'Include Inactive',
    'title'=>'Include all inactive users',
    'class'=>array('btn-xs button btn btn-default'),
    'href'=>site_url('auth/?show_inactive=TRUE'),
);
}
?>
<?php echo create_button_bar($buttons); ?>
<table class="table table-striped table-hover table bordered table-condensed table-responsive">
	<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Groups</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	<?php foreach ($users as $user):?>
    <?php if($user->active):?>
        <?php $row_class = 'active'; ?>
        <?php else:?>
       <?php $row_class = 'inactive';?>
    <?php endif;?>
    <tr class='<?php echo $row_class;?>'>
		<td><?php echo $user->first_name;?></td>
		<td><?php echo $user->last_name;?></td>
		<td><?php echo $user->email;?></td>
		<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name, "class='edit dialog'") ;?><br />
                <?php endforeach?>
			</td>
		<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, "Active","class='edit dialog' id='deactivate-user_$user->id'") : anchor("auth/activate/". $user->id, "Inactive","class='activate-user' id='activate-user_$user->id'");?></td>
		<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit', "class='edit dialog'") ;?></td>
	</tr>
	<?php endforeach;?>
</table>
