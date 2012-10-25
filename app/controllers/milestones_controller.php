<?php
class MilestonesController extends AppController {

	var $name = 'Milestones';

	function index() {
		$this->Milestone->recursive = 0;
		$this->set('milestones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid milestone', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('milestone', $this->Milestone->read(null, $id));
	}

	function add() {
		$status = 'success';
		$notes 	= 'success';
		if (!empty($_POST) && isset($_POST['title']) && !empty($_POST['title'])) {
				
			$this->data['Milestone']['title'] = $_POST['title'];
			$this->data['Milestone']['due_date'] = $_POST['due_date'];
			$this->log($this->data, LOG_DEBUG);
				
				if(isset($this->passedArgs['roadmap_id'])){
					$this->data['Milestone']['roadmap_id'] = $this->passedArgs['roadmap_id'];
				}
			
			$this->Milestone->create();
			if ($this->Milestone->save($this->data)) {
				if($this->RequestHandler->accepts('json')){
					$status = 'success';
					$this->Milestone->recursive = -1;
					$notes = $this->Milestone->read(null, $this->Milestone->getLastInsertId());
				}else{
					$this->Session->setFlash(__('The milestone has been saved', true));
					$this->redirect(array('action' => 'index'));					
				}
			} else {
				if($this->RequestHandler->accepts('json')){
					$status = 'failure';
					$notes = $this->Milestone->invalidFields();
				}else{
					$this->Session->setFlash(__('The milestone could not be saved. Please, try again.', true));	
				}
				
			}
		}
		$roadmaps = $this->Milestone->Roadmap->find('list');
		$this->set(compact('roadmaps'));
		
		$this->set('status', 	$status);
		$this->set('notes', 	$notes);
		
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid milestone', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Milestone->save($this->data)) {
				$this->Session->setFlash(__('The milestone has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The milestone could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Milestone->read(null, $id);
		}
		$roadmaps = $this->Milestone->Roadmap->find('list');
		$this->set(compact('roadmaps'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for milestone', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Milestone->recursive = -1;
		$milestone = $this->Milestone->read(null, $id);
		
		if ($this->Milestone->delete($id)) {
			if($this->RequestHandler->accepts('json')){
				$status = 'success';
				$notes = $milestone;
			}else{
				$this->Session->setFlash(__('Milestone deleted', true));
				$this->redirect(array('action'=>'index'));				
			}
		}else{
			$status = 'failure';
			$notes = 'could not delete';
		}
		
		$this->set('status', $status);
		$this->set('notes', $notes);
		
		if(!$this->RequestHandler->accepts('json')){
			$this->Session->setFlash(__('Milestone was not deleted', true));
			$this->redirect(array('action' => 'index'));			
		}
	}
	
	function sort(){
		$this->log($_POST['milestone'], LOG_DEBUG);
		$status = 'failure';
		if(!empty($_POST) && isset($_POST['milestone'])){
			$order = 1;
			$data = array();
			foreach ($_POST['milestone'] as $key => $id) {
					$data[] = array(
						'id'			=> $id,
						'sort_order'	=> $order
					);
				$order++;
			}
			
			if($this->Milestone->saveAll($data)){
				$status = 'success';
			}
		}else{
			$this->log('No post data', LOG_DEBUG);
		}
		
		$data = array(
			'status'	=> $status
		);
		$this->log($data, LOG_DEBUG);
		$this->set('data', $data);
		
	}
}
