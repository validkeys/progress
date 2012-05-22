<?php echo $javascript->link(array('master','jquery.scrollTo-min'), false) ?>
<div id="content-container" class="cssgradients">
	<?php echo $html->image('beta.jpeg',array('id'	=> 'beta-logo')) ?>
	<div class="logo"></div>
	 <h1 id="main-heading">FastFwd</h1>
	<div id="dialog-modal" title="Add A Step" style="display: none">
		<input type="text" name="data[Step][title]" id="new-step" class="add-new-field" />
		<a href="#" id="new-step-save" class="save-link">Save</a>
	</div>
	<div id="dialog-modal-milestone" title="Add A Milestone" style="display: none">
		<input type="text" name="data[Milestone][title]" id="new-milestone" class="add-new-field" />
		<a href="#" id="new-milestone-save" class="save-link">Save</a>
	</div>
	<div id="dialog-modal-roadmap" title="Add A Roadmap" style="display: none">
		<input type="text" name="data[Roadmap][title]" id="new-roadmap" class="add-new-field" />
		<a href="#" id="new-roadmap-save" class="save-link">Save</a>
	</div>
	
	<?php
		echo $html->link('Create New Roadmap',array(
			'controller'	=> 'roadmaps',
			'action'		=> 'add'	
		),array('class'	=> 'roadmap-add'));
	?>
	
	<?php foreach ($roadmaps as $roadmap): ?>
		<div class="roadmap" id="roadmap-<?php echo $roadmap['Roadmap']['id'] ?>">
			
			<h2><?php echo $roadmap['Roadmap']['title'] ?>
				<?php echo $html->link('Add Milestone',array(
					'controller'	=> 'milestones',
					'action'		=> 'add',
					'roadmap_id'	=> $roadmap['Roadmap']['id']
				),array('class'	=> 'add-milestone')) ?>
				<?php echo $html->link('Delete',array(
					'controller'	=> 'roadmaps',
					'action'		=> 'delete',
					$roadmap['Roadmap']['id']
				),array('class'	=> 'delete-roadmap')) ?>
				
				</h2>
				<?php echo (empty($roadmap['Milestone'])) ? $html->tag('div','',array('class'	=> 'empty-roadmap')) : '' ?>
			<?php foreach ($roadmap['Milestone'] as $milestone): ?>
				<div class="milestone progress-<?php echo $milestone['id'] ?>" style="width:<?php echo ((100 / count($roadmap['Milestone']) - 1) / 100) * 830 ?>px;" id="milestone-<?php echo $milestone['id'] ?>">
					
					<div class="progressbar progress-<?php echo $milestone['id'] ?>">
						</div>
					<h3 class="title"><?php echo $milestone['title'] ?>
						<a href="#" class="magnify" rel="milestone-<?php echo $milestone['id'] ?>">+</a>
						</h3>
					
					<?php foreach ($milestone['Step'] as $step): ?>
						<div id="step-<?php echo $step['id'] ?>" class="step <?php echo ($step['complete']) ? "complete" : "" ?>">
							<input class="pressly-check" type="checkbox" name="<?php echo 'step-' . $step['id'] ?>" <?php echo ($step['complete']) ? "checked='checked'" : "" ?>" value="" id="<?php echo "step-" . $step['id'] ?>">
							<?php echo $html->link('Del',array(
								'controller'		=> 'steps',
								'action'			=> 'delete',
								$step['id']
							),array('class'	=> 'step-delete')) ?>
							<label for="<?php echo "step-" . $step['id'] ?>"><?php echo $step['title'] ?></label>
						</div>						
					<?php endforeach ?>
					
					<div class="bottom" id="bottom-<?php echo $milestone['id'] ?>">
					<?php echo $html->link('Add', array(
						'controller'	=> 'steps',
						'action'		=> 'add',
						'milestone_id'	=> $milestone['id']
					),array(
						'class'	=> 'add-step'
					)) ?>
					<?php echo $html->link('Delete',array(
						'controller'	=> 'milestones',
						'action'		=> 'delete',
						$milestone['id']
					),array('class'	=> 'delete-milestone')) ?>
					<div style="clear:both" class="clear-bottom"></div>
					</div>
				</div>				
			<?php endforeach ?>
			<div style="clear:both" class="clear"></div>
		</div>		
	<?php endforeach ?>
</div>


