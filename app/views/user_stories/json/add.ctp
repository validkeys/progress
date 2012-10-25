<?php
	echo $javascript->object(array(
		'status'	=> (isset($status)) ? $status : '',
		'notes'		=> (isset($notes)) ? $notes : '',
		'form'		=> $this->element('user_stories/view', array('story'=>$notes['UserStory']))
	));
?>