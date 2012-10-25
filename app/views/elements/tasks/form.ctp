<div class="tasks form">
<?php echo $this->Form->create('Task', array(
	'url'	=> array(
		'controller'	=> 'tasks',
		'action'		=> ($edit_mode) ? 'edit' : 'add'
		)
));?>
	<?php
		echo ($edit_mode) ? $this->Form->input('id') : '';
		echo $this->Form->input('title',array('label'=>false,'div'=>false,'id'=>false,'class'=>'task-title-element'));
		echo (!isset($complete)) ? $this->Form->input('complete') : '';
		echo (isset($user_story_id)) ? $this->Form->hidden('user_story_id', array('value'=>$user_story_id)) : $this->Form->input('user_story_id');
		// echo $this->Form->input('sort_order');
	?>
<?php echo $this->Form->end(array(
	'label'	=> __('Submit', true),
	'class'	=> 'btn btn-small',
	'div'	=> false
));?>
</div>
