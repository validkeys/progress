<?php
class TasksController extends AppController {

	var $name = 'Tasks';

	function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid task', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('task', $this->Task->read(null, $id));
	}

	function add() {
		$status = 'success';
		$notes 	= 'success';

		if (!empty($this->data)) {
			$this->Task->create();
			if ($this->Task->save($this->data)) {
				if(!$this->RequestHandler->accepts('json')) $this->Session->setFlash(__('The task has been saved', true));
				if(!$this->RequestHandler->accepts('json')) $this->redirect(array('action' => 'index'));
				$this->data = $this->Task->read(null, $this->Task->getLastInsertId());
			} else {
				if(!$this->RequestHandler->accepts('json')) $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
			}
		}

		$this->set('status', 	$status);
		$this->set('notes', 	$notes);

	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid task', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Task->save($this->data)) {
				$this->Session->setFlash(__('The task has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}
		$userStories = $this->Task->UserStory->find('list');
		$this->set(compact('userStories'));
	}

	function complete(){
		$status = 'failure';
		$action = '';

		if($this->RequestHandler->accepts('json')){
			if(!empty($this->data)){
				$this->log($this->data, LOG_DEBUG);
				$this->Task->id = $this->data['Task']['id'];
				$current = $this->Task->field('complete');
				$new = abs($current - 1);
				if($this->Task->saveField('complete', $new)){
					$status = 'success';
					$action = ($current == 1) ? 'uncomplete' : 'complete';
				}else{
					$this->log($this->Task->invalidFields(), LOG_DEBUG);
				}
			}
		}
		
		$data = array(
			'status'	=> $status,
			'action'	=> $action
		);
		
		$this->set('data', $data);

	}	

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for task', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Task->delete($id)) {
			$this->Session->setFlash(__('Task deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Task was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
