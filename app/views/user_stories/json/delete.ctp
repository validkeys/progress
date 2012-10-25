<?php
	echo $javascript->object(array(
		'status'	=> (isset($status)) ? $status : '',
		'notes'		=> (isset($notes)) ? $notes : ''
	));
?>