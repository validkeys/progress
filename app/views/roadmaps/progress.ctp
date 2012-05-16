<?php echo $javascript->link('master', false) ?>
<div id="content-container">
	 <h1>Pressly Progress</h1>
	<div id="dialog-modal" title="Add A Step" style="display: none">
		<input type="text" name="data[Step][title]" id="new-step" class="add-new-field" />
		<a href="#" id="new-step-save" class="save-link">Save</a>
	</div>
	<div id="dialog-modal-milestone" title="Add A Milestone" style="display: none">
		<input type="text" name="data[Milestone][title]" id="new-milestone" class="add-new-field" />
		<a href="#" id="new-milestone-save" class="save-link">Save</a>
	</div>

	<?php foreach ($roadmaps as $roadmap): ?>
		<div class="roadmap" id="roadmap-<?php echo $roadmap['Roadmap']['id'] ?>">

			<h2><?php echo $roadmap['Roadmap']['title'] ?>
				<?php echo $html->link('Add Milestone',array(
					'controller'	=> 'milestones',
					'action'		=> 'add',
					'roadmap_id'	=> $roadmap['Roadmap']['id'].'.json'
				),array('class'	=> 'add-milestone')) ?>
				
				</h2>

			<?php foreach ($roadmap['Milestone'] as $milestone): ?>
				<div class="milestone progress-<?php echo $milestone['id'] ?>" style="width:<?php echo (100 / count($roadmap['Milestone'])) - 2 ?>%;" id="milestone-<?php echo $milestone['id'] ?>">
					<div class="progressbar progress-<?php echo $milestone['id'] ?>">
						</div>
					<h3 class="title"><?php echo $milestone['title'] ?>
						<?php echo $html->link('Delete',array(
							'controller'	=> 'milestones',
							'action'		=> 'delete',
							$milestone['id']
						),array('class'	=> 'delete-milestone')) ?>
						</h3>
					
					<?php foreach ($milestone['Step'] as $step): ?>
						<div id="step_<?php echo $step['id'] ?>" class="step <?php echo ($step['complete']) ? "complete" : "" ?>">
							<input class="pressly-check" type="checkbox" name="<?php echo 'step-' . $step['id'] ?>" <?php echo ($step['complete']) ? "checked='checked'" : "" ?>" value="" id="<?php echo "step-" . $step['id'] ?>"><label for="<?php echo "step-" . $step['id'] ?>"><?php echo $step['title'] ?></label>
						</div>						
					<?php endforeach ?>
					<?php echo $html->link('+ Add', array(
						'controller'	=> 'steps',
						'action'		=> 'add',
						'milestone_id'	=> $milestone['id']
					),array(
						'class'	=> 'add-step'
					)) ?>
				</div>				
			<?php endforeach ?>
			<div style="clear:both" class="clear"></div>
		</div>		
	<?php endforeach ?>
</div>


