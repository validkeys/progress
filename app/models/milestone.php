<?php
class Milestone extends AppModel {
	var $name = 'Milestone';
	var $displayField = 'title';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Roadmap' => array(
			'className' => 'Roadmap',
			'foreignKey' => 'roadmap_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache'	=> true
		)
	);

	var $hasMany = array(
		'UserStory' => array(
			'className' => 'UserStory',
			'foreignKey' => 'milestone_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'UserStory.sort_order ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	function beforeSave(){
		
		if(!isset($this->data['Milestone']['sort-order']) && isset($this->data['Milestone']['roadmap_id'])){
			$test = $this->find('first',array(
				'conditions'	=> array('Milestone.roadmap_id'	=> $this->data['Milestone']['roadmap_id']),
				'order'			=> 'Milestone.sort_order DESC'
			));
			
			if($test){
				$this->data['Milestone']['sort_order'] = $test['Milestone']['sort_order'] + 1;
			}else{
				$this->data['Mil']['sort_order'] = 1;
			}
			
		}
		
		return $this->data;
		
	}
	

}
