<?php
class Step extends AppModel {
	var $name = 'Step';
	var $displayField = 'title';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Milestone' => array(
			'className' => 'Milestone',
			'foreignKey' => 'milestone_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave(){
		
		if(!isset($this->data['Step']['sort-order']) && isset($this->data['Step']['milestone_id'])){
			$test = $this->find('first',array(
				'conditions'	=> array('Step.milestone_id'	=> $this->data['Step']['milestone_id']),
				'order'			=> 'Step.sort_order DESC'
			));
			
			if($test){
				$this->data['Step']['sort_order'] = $test['Step']['sort_order'] + 1;
			}else{
				$this->data['Step']['sort_order'] = 1;
			}
			
		}
		
		return $this->data;
		
	}
}
