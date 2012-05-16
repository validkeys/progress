<div class="milestones view">
<h2><?php  __('Milestone');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Roadmap'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($milestone['Roadmap']['title'], array('controller' => 'roadmaps', 'action' => 'view', $milestone['Roadmap']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sort Order'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['sort_order']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Milestone', true), array('action' => 'edit', $milestone['Milestone']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Milestone', true), array('action' => 'delete', $milestone['Milestone']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $milestone['Milestone']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roadmaps', true), array('controller' => 'roadmaps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roadmap', true), array('controller' => 'roadmaps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps', true), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step', true), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Steps');?></h3>
	<?php if (!empty($milestone['Step'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Milestone Id'); ?></th>
		<th><?php __('Sort Order'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Complete'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($milestone['Step'] as $step):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $step['id'];?></td>
			<td><?php echo $step['title'];?></td>
			<td><?php echo $step['milestone_id'];?></td>
			<td><?php echo $step['sort_order'];?></td>
			<td><?php echo $step['created'];?></td>
			<td><?php echo $step['modified'];?></td>
			<td><?php echo $step['complete'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'steps', 'action' => 'view', $step['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'steps', 'action' => 'edit', $step['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'steps', 'action' => 'delete', $step['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $step['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Step', true), array('controller' => 'steps', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
