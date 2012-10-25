<div class="milestone progress-<?php echo $milestone['id'] ?>" id="milestone-<?php echo $milestone['id'] ?>">
	<div class="due-date">
		Due: <?php echo $this->Time->timeAgoInWords($milestone['due_date']) ?>
	</div>

	<div class="progressbar progress-<?php echo $milestone['id'] ?>">
		</div>
	<h3 class="title"><?php echo $milestone['title'] ?>
		<a href="#" class="magnify" rel="milestone-<?php echo $milestone['id'] ?>">+</a>
		</h3>
	<?php if(!empty($milestone['UserStory'])){ ?>
		<?php
			foreach ($milestone['UserStory'] as $story):
				echo $this->element('user_stories/view', array('story'=>$story));
			endforeach;
		?>
		<div class="clear"></div>
	<?php }else{ ?>
		<div class="emptyMilestone">Beer me some stories</div>
	<?php } ?>	
	<div class="bottom" id="bottom-<?php echo $milestone['id'] ?>">
		<?php echo $html->link('Add Story', array(
			'controller'	=> 'user_stories',
			'action'		=> 'add',
			'milestone_id'	=> $milestone['id']
		),array(
			'class'	=> 'btn add-step'
		)) ?>
		<?php echo $html->link('Delete Milestone',array(
			'controller'	=> 'milestones',
			'action'		=> 'delete',
			$milestone['id']
		),array('class'	=> 'btn btn-danger delete-milestone')) ?>
		<div class="clear"></div>
	</div>
</div>	