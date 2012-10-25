<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array();


	function login(){
		$this->layout = 'login';

		if(!empty($this->data)){
			if($this->data['User']['username'] == 'pressly@nulayer.com' && $this->data['User']['password'] == 'nulayer'){
				$this->Session->write('User', $this->data['User']);
				$this->redirect('/');
			}
		}
	}

}
?>