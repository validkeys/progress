<div class="roadmaps form">
<?php echo $this->Form->create('Roadmap');?>
	<fieldset>
		<legend><?php __('Edit Roadmap'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Roadmap.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Roadmap.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Roadmaps', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('controller' => 'milestones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('controller' => 'milestones', 'action' => 'add')); ?> </li>
	</ul>
</div>