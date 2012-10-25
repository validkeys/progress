<?php

Warning: date(): It is not safe to rely on the system's timezone settings. You are *required* to use the date.timezone setting or the date_default_timezone_set() function. In case you used any of those methods and you are still getting this warning, you most likely misspelled the timezone identifier. We selected 'America/New_York' for 'EDT/-4.0/DST' instead in /Users/kyledavis/Sites/pressly-progress/cake/console/templates/default/classes/test.ctp on line 22
/* Task Test cases generated on: 2012-10-22 08:13:58 : 1350908038*/
App::import('Model', 'Task');

class TaskTestCase extends CakeTestCase {
	var $fixtures = array('app.task', 'app.user_story', 'app.milestone', 'app.roadmap');

	function startTest() {
		$this->Task =& ClassRegistry::init('Task');
	}

	function endTest() {
		unset($this->Task);
		ClassRegistry::flush();
	}

}
