<?php
class UserStoriesController extends AppController {

	var $name = 'UserStories';

	function index() {
		$this->UserStory->recursive = 0;
		$this->set('user_stories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user story', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user_story', $this->UserStory->read(null, $id));
	}

	function add() {

		if (!empty($_POST) && isset($_POST['title']) && !empty($_POST['title'])) {
			
			$this->data['UserStory']['title'] = $_POST['title'];
			
			if(isset($this->passedArgs['milestone_id'])){
				$this->data['UserStory']['milestone_id'] = $this->passedArgs['milestone_id'];
			}
			
			
			$this->UserStory->create();
			if ($this->UserStory->save($this->data)) {
				if($this->RequestHandler->accepts('json')){
					$status = 'success';
					$this->UserStory->contain = array('Task');
					$notes = $this->UserStory->read(null, $this->UserStory->getLastInsertId());
					$notes['UserStory']['Task'] = $notes['Task'];
					$this->log($notes, LOG_DEBUG);
				}else{
					$this->Session->setFlash(__('The user story has been saved', true));
					$this->redirect(array('action' => 'index'));					
				}
			} else {
				if($this->RequestHandler->accepts('json')){
					$status = 'failure';
					$notes = $this->UserStory->invalidFields();
				}else{
					$this->Session->setFlash(__('The user story could not be saved. Please, try again.', true));	
				}
				
			}
		}
		$milestones = $this->UserStory->Milestone->find('list');
		$this->set(compact('milestones'));
		
		$this->set('status', 	$status);
		$this->set('notes', 	$notes);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user story', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UserStory->save($this->data)) {
				$this->Session->setFlash(__('The user story has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user story could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UserStory->read(null, $id);
		}
		$milestones = $this->UserStory->Milestone->find('list');
		$this->set(compact('milestones'));
	}

	function delete($id = null) {
		if (!$id) {
			if($this->RequestHandler->accepts('json')){
				$status = 'failure';
				$notes = 'no id sent';
			}else{
				$this->Session->setFlash(__('Invalid id for user story', true));
				$this->redirect(array('action'=>'index'));
				
			}
		}
		$this->UserStory->recursive = -1;
		$user_story = $this->UserStory->read(null, $id);
		
		if ($this->UserStory->delete($id)) {
			if($this->RequestHandler->accepts('json')){
				$status = 'success';
				$notes = $user_story;
			}else{
				$this->Session->setFlash(__('user story deleted', true));
				$this->redirect(array('action'=>'index'));				
			}
		}else{
			$status = 'failure';
			$notes = 'could not delete';
		}
		
		$this->set('status', $status);
		$this->set('notes', $notes);
		
		if(!$this->RequestHandler->accepts('json')){
			$this->Session->setFlash(__('user story was not deleted', true));
			$this->redirect(array('action' => 'index'));			
		}
	}
	
	function complete(){
		$status = 'failure';
		$action = '';
		
		if($this->RequestHandler->accepts('json')){
			if(!empty($_POST) && isset($_POST['id'])){
				$this->UserStory->id = $_POST['id'];
				$current = $this->UserStory->field('complete');
				$new = abs($current - 1);
				if($this->UserStory->saveField('complete', $new)){
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
		// $this->log($_POST, LOG_DEBUG);
		$status = 'failure';
		if(!empty($_POST) && isset($_POST['user_story'])){
			$order = 1;
			$data = array();
			foreach ($_POST['user_story'] as $key => $id) {
					$data[] = array(
						'id'			=> $id,
						'sort_order'	=> $order
					);
				$order++;
			}
			
			if($this->UserStory->saveAll($data)){
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
