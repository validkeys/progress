<div class="steps form">
<?php echo $this->Form->create('UserStory');?>
	<fieldset>
		<legend><?php __('Add UserStory'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('milestone_id');
		echo $this->Form->input('sort_order');
		echo $this->Form->input('complete');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>