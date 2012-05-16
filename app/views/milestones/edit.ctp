<div class="milestones form">
<?php echo $this->Form->create('Milestone');?>
	<fieldset>
		<legend><?php __('Edit Milestone'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('roadmap_id');
		echo $this->Form->input('sort_order');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Milestone.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Milestone.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Roadmaps', true), array('controller' => 'roadmaps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roadmap', true), array('controller' => 'roadmaps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps', true), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step', true), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>