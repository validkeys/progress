<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pressly Progress</title>
	<?php
		echo $html->css(array('bootstrap.min','master'));
		echo $html->css('le-frog/jquery-ui-1.8.20.custom.css');
		echo $javascript->link(array('jquery-1.7.2.min.js','jquery-ui-1.8.20.custom.min.js','modernizr','bootstrap.min'));
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="content-container" class="cssgradients">
		<div id="navbar">
		<div class="logo"></div>
		 <h1 id="main-heading">FastFwd</h1>

		<div id="roadmap-switcher">
			<div class="btn-group pull-left">
			  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
			    Change Roadmap
			    <span class="caret"></span>
			  </a>
			  <ul class="dropdown-menu">
			  	<li>
			  		<?php foreach ($roadmaps_list as $id => $title): ?>
			  			<?php echo $this->Html->link($title, array(
			  				'controller'	=> 'roadmaps',
			  				'action'		=> 'view',
			  				$id
			  			)) ?>
			  		<?php endforeach ?>
			  	</li>
			  </ul>
			</div>


		<?php
			echo $html->link('New',array(
				'controller'	=> 'roadmaps',
				'action'		=> 'add'	
			),array('id'	=> 'roadmap-add','class'=>'btn btn-inverse pull-right'));
		?>						
		</div>				
		</div>
		 
		<div id="dialog-modal" title="Add A User Story" style="display: none">
			<input type="text" name="data[UserStory][title]" id="new-step" class="add-new-field" />
			<a href="#" id="new-step-save" class="save-link">Save</a>
		</div>
		<div id="dialog-modal-milestone" title="Add A Milestone" style="display: none">
			<input type="text" name="data[Milestone][title]" id="new-milestone" class="add-new-field" />
			<input type="text" name="data[Milestone][due_date]" id="new-milestone-date" class="add-new-field" />
			<a href="#" id="new-milestone-save" class="save-link">Save</a>
		</div>
		<div id="dialog-modal-roadmap" title="Add A Roadmap" style="display: none">
			<input type="text" name="data[Roadmap][title]" id="new-roadmap" class="add-new-field" />
			<a href="#" id="new-roadmap-save" class="save-link">Save</a>
		</div>
	

		<?php echo $content_for_layout ?>
	</div>
</body>
</html>
