<?php
class RoadmapsController extends AppController {

	var $name = 'Roadmaps';

	
	
	function progress(){
		$this->layout = 'progress';
		
		$conditions = array();



		$roadmap = $this->Roadmap->find('first',array(
			'contain'	=> array(
				'Milestone'	=> array('UserStory'	=> array('Task'))
			),
			'conditions'	=> $conditions,
			'order'	=> 'Roadmap.created ASC'
		));
		
		// debug($roadmap); debug();

		// Re-org the steps array
		$steps = array();

		
		$this->set('roadmap', $roadmap);
	}

	function index() {
		$this->Roadmap->recursive = 0;
		$this->set('roadmaps', $this->paginate());
	}

	function view($id = null) {

		$this->layout = 'progress';
		$conditions = array();

		if($id){
			$conditions = array('Roadmap.id'	=> $id);
		}

		$roadmap = $this->Roadmap->find('first',array(
			'contain'	=> array(
				'Milestone'	=> array('UserStory'	=> array('Task'))
			),
			'conditions'	=> $conditions,
			'order'	=> 'Roadmap.created ASC'
		));
		

		$roadmaps_list = $this->Roadmap->find('list', array
			(
				'order'	=> array('Roadmap.title ASC')
			));

		$this->set('roadmaps_list', $roadmaps_list); //for the dropdown
		$this->set('roadmap', 		$roadmap);
	}

	function add() {
		$status = 'failure';
		$notes 	= 'failure';
		
		$this->log($_POST, LOG_DEBUG);
		if (!empty($_POST) && isset($_POST['title']) && !empty($_POST['title'])) {
			
			$this->data['Roadmap']['title'] = $_POST['title'];
			
			$this->Roadmap->create();
			if ($this->Roadmap->save($this->data)) {
				if($this->RequestHandler->accepts('json')){
					$status = 'success';
					$this->Roadmap->recursive = -1;
					$notes = $this->Roadmap->read(null, $this->Roadmap->getLastInsertId());
				}else{
					if($this->RequestHandler->accepts('json')){
						$notes = $this->Roadmap->invalidFields();
					}else{
						$this->Session->setFlash(__('The roadmap has been saved', true));
						$this->redirect(array('action' => 'index'));											
					}
				}
			} else {
				if($this->RequestHandler->accepts('json')){
					$notes = $this->Roadmap->invalidFields();
				}else{
					$this->Session->setFlash(__('The roadmap could not be saved. Please, try again.', true));	
				}
			}
		}
		
		$this->set(compact('notes','status'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid roadmap', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Roadmap->save($this->data)) {
				$this->Session->setFlash(__('The roadmap has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The roadmap could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Roadmap->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for roadmap', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Roadmap->recursive = -1;
		$roadmap = $this->Roadmap->read(null, $id);
		
		if ($this->Roadmap->delete($id)) {
			if($this->RequestHandler->accepts('json')){
				$status = 'success';
				$notes = $roadmap;
			}else{
				$this->Session->setFlash(__('Roadmap deleted', true));
				$this->redirect(array('action'=>'index'));				
			}
		}else{
			$status = 'failure';
			$notes = 'could not delete';
		}
		
		$this->set('status', $status);
		$this->set('notes', $notes);
		
		if(!$this->RequestHandler->accepts('json')){
			$this->Session->setFlash(__('Roadmap was not deleted', true));
			$this->redirect(array('action' => 'index'));			
		}
	}
}
