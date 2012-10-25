<div class="steps index">
	<h2><?php __('Steps');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('milestone_id');?></th>
			<th><?php echo $this->Paginator->sort('sort_order');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th><?php echo $this->Paginator->sort('complete');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($steps as $step):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $step['Step']['id']; ?>&nbsp;</td>
		<td><?php echo $step['Step']['title']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($step['Milestone']['title'], array('controller' => 'milestones', 'action' => 'view', $step['Milestone']['id'])); ?>
		</td>
		<td><?php echo $step['Step']['sort_order']; ?>&nbsp;</td>
		<td><?php echo $step['Step']['created']; ?>&nbsp;</td>
		<td><?php echo $step['Step']['modified']; ?>&nbsp;</td>
		<td><?php echo $step['Step']['complete']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $step['Step']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $step['Step']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $step['Step']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $step['Step']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Step', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Milestones', true), array('controller' => 'milestones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Milestone', true), array('controller' => 'milestones', 'action' => 'add')); ?> </li>
	</ul>
</div>