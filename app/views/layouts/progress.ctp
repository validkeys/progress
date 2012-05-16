<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Pressly Progress</title>
	<?php
		echo $html->css('master');
		echo $html->css('ui-lightness/jquery-ui-1.8.20.custom.css');
		echo $javascript->link(array('jquery-1.7.2.min.js','jquery-ui-1.8.20.custom.min.js'));
		echo $scripts_for_layout;
	?>
</head>
<body>
	
	<?php echo $content_for_layout ?>

</body>
</html>
