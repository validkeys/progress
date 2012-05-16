<?php
class RoadmapsController extends AppController {

	var $name = 'Roadmaps';
	
	
	function progress(){
		$this->layout = 'progress';
		
		$roadmaps = $this->Roadmap->find('all',array(
			'contain'	=> array(
				'Milestone'	=> array('Step')
			),
			'order'	=> 'Roadmap.created ASC'
		));
	
		// Re-org the steps array
		$steps = array();
		
		// Find the grid
		
		$num = 0;
		foreach ($roadmaps as $r) {
			
			$total_rows 	= 0;
			$total_columns 	= 0;
			
			if(count($r['Milestone']) > $total_columns){
				$total_columns = count($r['Milestone']);
			}
			foreach ($r['Milestone'] as $m) {
				if(count($m['Step']) > $total_rows){
					$total_rows = count($m['Step']);
				}
			}
			$roadmaps[$num]['Roadmap']['total_rows'] = $total_rows;
			$roadmaps[$num]['Roadmap']['total_columns'] = $total_columns;
			$num++;
		}

		$num = 0;
		foreach ($roadmaps as $roadmap) {
			
			$step_test = array();
			
			for ($i=1; $i < $roadmap['Roadmap']['total_rows'] + 1; $i++) { 
				for ($r=1; $r < $roadmap['Roadmap']['total_columns'] + 1; $r++) { 
					$step_test[$i][$r] = array();
				}
			}

			$cell_num = 1;
			$ms_count = count($roadmap['Milestone']);
			
			$largest_number_of_steps = 0;
			foreach ($roadmap['Milestone'] as $milestone) {
				$row_num = 1;
				if(!empty($milestone['Step'])){
					foreach ($milestone['Step'] as $step) {
							$step_test[$row_num][$cell_num] = $step;
							$row_num++;
					}					
				}else{
					$step_test[$row_num][$cell_num] = array();
					$row_num++;
				}
				$cell_num++;
			}
			$roadmaps[$num]['Roadmap']['step_test'] = $step_test;
			$num++;
		}
		

		
		
		
		// $mynum = 0;
		// foreach ($roadmaps as $rm) {
		// 	$steps[$rm['Roadmap']['id']] = array();
		// 	$milestone_number  = 1;
		// 	foreach ($rm['Milestone'] as $m) {
		// 		$num = 1;
		// 		// $steps[$rm['Roadmap']['id']][$num]["milestone-".$milestone_number] = array();
		// 		if(!empty($m['Step'])){
		// 			foreach ($m['Step'] as $step) {
		// 				$steps[$rm['Roadmap']['id']][$num]["milestone-".$milestone_number] = $step;
		// 				$num++;
		// 			}					
		// 		}else{
		// 			$steps[$rm['Roadmap']['id']][$num]["milestone-".$milestone_number] = array();
		// 			$num++;					
		// 		}
		// 		$milestone_number++;
		// 	}
		// 	$roadmaps[$mynum]['Roadmap']['step_table'] = $steps[$rm['Roadmap']['id']];
		// 	$mynum++;
		// }
		// debug($steps); die();
		// $this->set('steps', $steps);
		
		$this->set('roadmaps', $roadmaps);
	}

	function index() {
		$this->Roadmap->recursive = 0;
		$this->set('roadmaps', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid roadmap', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('roadmap', $this->Roadmap->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Roadmap->create();
			if ($this->Roadmap->save($this->data)) {
				$this->Session->setFlash(__('The roadmap has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The roadmap could not be saved. Please, try again.', true));
			}
		}
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
		if ($this->Roadmap->delete($id)) {
			$this->Session->setFlash(__('Roadmap deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Roadmap was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
