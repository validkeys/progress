<div class="steps form">
<?php echo $this->Form->create('Step');?>
	<fieldset>
		<legend><?php __('Edit Step'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('milestone_id');
		echo $this->Form->input('sort_order');
		echo $this->Form->input('complete');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Step.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Step.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Steps', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('controller' => 'milestones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('controller' => 'milestones', 'action' => 'add')); ?> </li>
	</ul>
</div>