<div class="milestones index">
	<h2><?php __('Milestones');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('roadmap_id');?></th>
			<th><?php echo $this->Paginator->sort('sort_order');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($milestones as $milestone):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $milestone['Milestone']['id']; ?>&nbsp;</td>
		<td><?php echo $milestone['Milestone']['title']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($milestone['Roadmap']['title'], array('controller' => 'roadmaps', 'action' => 'view', $milestone['Roadmap']['id'])); ?>
		</td>
		<td><?php echo $milestone['Milestone']['sort_order']; ?>&nbsp;</td>
		<td><?php echo $milestone['Milestone']['created']; ?>&nbsp;</td>
		<td><?php echo $milestone['Milestone']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $milestone['Milestone']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $milestone['Milestone']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $milestone['Milestone']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $milestone['Milestone']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roadmaps', true), array('controller' => 'roadmaps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Roadmap', true), array('controller' => 'roadmaps', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Steps', true), array('controller' => 'steps', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Step', true), array('controller' => 'steps', 'action' => 'add')); ?> </li>
	</ul>
</div>