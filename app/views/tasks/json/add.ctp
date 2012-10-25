<?php
	echo $javascript->object(array(
		'status'	=> (isset($status)) ? $status : '',
		'notes'		=> (isset($notes)) ? $notes : '',
		'form'		=> ($status == 'success') ? $this->element('tasks/toggle_form', array('task'=>$this->data['Task'])) : '',
		'data'		=> $this->data
	));
?>