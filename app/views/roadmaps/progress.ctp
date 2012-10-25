<?php echo $javascript->link(array('master','jquery.scrollTo-min'), false) ?>

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
						<?php foreach ($milestone['UserStory'] as $story): ?>
							<div id="user_story-<?php echo $story['id'] ?>" class="step <?php echo ($story['complete']) ? 'complete' : '' ?>">
								<input 
									class="pressly-check" 
									type="checkbox" 
									name="<?php echo 'user_story-' . $story['id'] ?>" <?php echo ($story['complete']) ? "checked='checked'" : '' ?> value="" id="<?php echo 'user_story-' . $story['id'] ?>">
								<?php echo $html->link('Del',array(
									'controller'		=> 'user_stories',
									'action'			=> 'delete',
									$story['id']
								),array('class'	=> 'step-delete')) ?>
								<label for="<?php echo "user_story-" . $story['id'] ?>"><?php echo $story['title'] ?></label>
							</div>						
						<?php endforeach ?>
					<?php }else{ ?>
						<div class="emptyMilestone">Beer me some stories</div>
					<?php } ?>	
					<div class="bottom" id="bottom-<?php echo $milestone['id'] ?>">
					<?php echo $html->link('Add', array(
						'controller'	=> 'user_stories',
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


