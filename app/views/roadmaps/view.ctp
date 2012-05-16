<div class="roadmaps view">
<h2><?php  __('Roadmap');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $roadmap['Roadmap']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $roadmap['Roadmap']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $roadmap['Roadmap']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $roadmap['Roadmap']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Roadmap', true), array('action' => 'edit', $roadmap['Roadmap']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Roadmap', true), array('action' => 'delete', $roadmap['Roadmap']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $roadmap['Roadmap']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Roadmaps', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roadmap', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('controller' => 'milestones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('controller' => 'milestones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Milestones');?></h3>
	<?php if (!empty($roadmap['Milestone'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Roadmap Id'); ?></th>
		<th><?php __('Sort Order'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($roadmap['Milestone'] as $milestone):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $milestone['id'];?></td>
			<td><?php echo $milestone['title'];?></td>
			<td><?php echo $milestone['roadmap_id'];?></td>
			<td><?php echo $milestone['sort_order'];?></td>
			<td><?php echo $milestone['created'];?></td>
			<td><?php echo $milestone['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'milestones', 'action' => 'view', $milestone['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'milestones', 'action' => 'edit', $milestone['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'milestones', 'action' => 'delete', $milestone['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $milestone['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Milestone', true), array('controller' => 'milestones', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
