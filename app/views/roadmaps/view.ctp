<?php echo $javascript->link(array('master','jquery.scrollTo-min'), false) ?>

<h1 class="roadmap-heading"><?php echo $roadmap['Roadmap']['title'] ?></h1>
<div class="roadmap-actions">
	<?php echo $html->link('+ Add Milestone',array(
		'controller'	=> 'milestones',
		'action'		=> 'add',
		'roadmap_id'	=> $roadmap['Roadmap']['id'],
		'class'			=> 'btn'
	),array('class'	=> 'add-milestone btn btn-inverse')) ?>

</div>



<div class="roadmap" id="roadmap-<?php echo $roadmap['Roadmap']['id'] ?>" data-story-complete-url="<?php echo $this->webroot ?>user_stories/complete.json" data-task-complete-url="<?php echo $this->webroot ?>tasks/complete.json" data-webroot="<?php echo $this->webroot ?>">
		
	<?php echo (empty($roadmap['Milestone'])) ? $html->tag('div','',array('class'	=> 'empty-roadmap')) : '' ?>

	<?php
		foreach ($roadmap['Milestone'] as $milestone):
			echo $this->element('milestones/view', array('milestone'=>$milestone));
		endforeach;
	?>
	<div style="clear:both" class="clear"></div>
</div>