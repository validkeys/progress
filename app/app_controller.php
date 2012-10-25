<?php
class AppController extends Controller {
	
	// Holds an array of controller actions
	// requiring POST vs. GET
	var $helpers 		= array('Html','Javascript','Form','Session','Number','Time');
	var $components		= array('RequestHandler','Session');

	function beforeFilter(){
		if(!$this->Session->check('User') && $this->params['controller'] != 'users'){
			$this->redirect(array('controller'=>'users','action'=>'login'));
		}
	}
}
