<?php
class StepsController extends AppController {

	var $name = 'Steps';

	function index() {
		$this->Step->recursive = 0;
		$this->set('steps', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid step', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('step', $this->Step->read(null, $id));
	}

	function add() {

		if (!empty($_POST) && isset($_POST['title']) && !empty($_POST['title'])) {
			
			$this->data['Step']['title'] = $_POST['title'];
			
			if(isset($this->passedArgs['milestone_id'])){
				$this->data['Step']['milestone_id'] = $this->passedArgs['milestone_id'];
			}
			
			
			$this->Step->create();
			if ($this->Step->save($this->data)) {
				if($this->RequestHandler->accepts('json')){
					$status = 'success';
					$this->Step->recursive = -1;
					$notes = $this->Step->read(null, $this->Step->getLastInsertId());
				}else{
					$this->Session->setFlash(__('The step has been saved', true));
					$this->redirect(array('action' => 'index'));					
				}
			} else {
				if($this->RequestHandler->accepts('json')){
					$status = 'failure';
					$notes = $this->Step->invalidFields();
				}else{
					$this->Session->setFlash(__('The step could not be saved. Please, try again.', true));	
				}
				
			}
		}
		$milestones = $this->Step->Milestone->find('list');
		$this->set(compact('milestones'));
		
		$this->set('status', 	$status);
		$this->set('notes', 	$notes);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid step', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Step->save($this->data)) {
				$this->Session->setFlash(__('The step has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The step could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Step->read(null, $id);
		}
		$milestones = $this->Step->Milestone->find('list');
		$this->set(compact('milestones'));
	}

	function delete($id = null) {
		if (!$id) {
			if($this->RequestHandler->accepts('json')){
				$status = 'failure';
				$notes = 'no id sent';
			}else{
				$this->Session->setFlash(__('Invalid id for step', true));
				$this->redirect(array('action'=>'index'));
				
			}
		}
		$this->Step->recursive = -1;
		$step = $this->Step->read(null, $id);
		
		if ($this->Step->delete($id)) {
			if($this->RequestHandler->accepts('json')){
				$status = 'success';
				$notes = $step;
			}else{
				$this->Session->setFlash(__('Step deleted', true));
				$this->redirect(array('action'=>'index'));				
			}
		}else{
			$status = 'failure';
			$notes = 'could not delete';
		}
		
		$this->set('status', $status);
		$this->set('notes', $notes);
		
		if(!$this->RequestHandler->accepts('json')){
			$this->Session->setFlash(__('Step was not deleted', true));
			$this->redirect(array('action' => 'index'));			
		}
	}
	
	function complete(){
		$status = 'failure';
		$action = '';
		
		if($this->RequestHandler->accepts('json')){
			if(!empty($_POST) && isset($_POST['id'])){
				$this->Step->id = $_POST['id'];
				$current = $this->Step->field('complete');
				$new = abs($current - 1);
				if($this->Step->saveField('complete', $new)){
					$status = 'success';
					$action = ($current == 1) ? 'uncomplete' : 'complete';
				}
			}
		}
		
		$data = array(
			'status'	=> $status,
			'action'	=> $action
		);
		
		$this->set('data', $data);

	}
	
	function sort(){
		$this->log($_POST['step'], LOG_DEBUG);
		$status = 'failure';
		if(!empty($_POST) && isset($_POST['step'])){
			$order = 1;
			$data = array();
			foreach ($_POST['step'] as $key => $id) {
					$data[] = array(
						'id'			=> $id,
						'sort_order'	=> $order
					);
				$order++;
			}
			
			if($this->Step->saveAll($data)){
				$status = 'success';
			}
		}else{
			$this->log('No post data', LOG_DEBUG);
		}
		
		$data = array(
			'status'	=> $status
		);
		
		$this->set('data', $data);
		
	}
	
}
