<div class="milestones form">
<?php echo $this->Form->create('Milestone');?>
	<fieldset>
		<legend><?php __('Add Milestone'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('roadmap_id');
		echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
