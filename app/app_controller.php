<?php
class AppController extends Controller {
	
	// Holds an array of controller actions
	// requiring POST vs. GET
	var $helpers 		= array('Html','Javascript','Form','Session','Number');
	var $components		= array('RequestHandler','Session');
}
