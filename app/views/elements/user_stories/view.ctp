<div id="user_story-<?php echo $story['id'] ?>" class="step <?php echo ($story['complete']) ? 'complete' : '' ?>">
	<input 
		class="pressly-check user-story-check" 
		type="checkbox" 
		name="<?php echo 'user_story-' . $story['id'] ?>" <?php echo ($story['complete']) ? "checked='checked'" : '' ?> value="" id="<?php echo 'user_story-' . $story['id'] ?>">
	<?php echo $html->link('Del',array(
		'controller'		=> 'user_stories',
		'action'			=> 'delete',
		$story['id']
	),array('class'	=> 'step-delete')) ?>
	<label for="<?php echo "user_story-" . $story['id'] ?>"><?php echo $story['title'] ?></label>
	<div class="task-link"><a href="#" class="task-open"><?php echo $story['task_count'] . ' tasks' ?></a></div>
	<div class="tasks-wrapper" style="display: none;">
		<div class="tasks-inner">
		<?php foreach ($story['Task'] as $task): ?>
			<?php
				echo $this->element('tasks/toggle_form', array('task'=>$task));
			?>
		<?php endforeach ?>
		</div>
		<div class="clear bottom-task"></div>
		<div class="add-task-form" style="display: none;">
			<?php echo $this->element('tasks/form',array('edit_mode'=>false,'user_story_id'=>$story['id'],'complete'=>false)) ?>
			<div class="clear"></div>
		</div>
		<a href="#" class="add-task-link">+ Add Task</a>
	</div>
	<div class="clear"></div>
</div>			