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
		foreach ($milestone['UserStory'] as $userStory):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $userStory['id'];?></td>
			<td><?php echo $userStory['title'];?></td>
			<td><?php echo $userStory['milestone_id'];?></td>
			<td><?php echo $userStory['sort_order'];?></td>
			<td><?php echo $userStory['created'];?></td>
			<td><?php echo $userStory['modified'];?></td>
			<td><?php echo $userStory['complete'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'steps', 'action' => 'view', $userStory['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'steps', 'action' => 'edit', $userStory['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'steps', 'action' => 'delete', $userStory['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $userStory['id'])); ?>
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
