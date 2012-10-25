<?php
class UserStory extends AppModel {
	var $name = 'UserStory';
	var $displayField = 'title';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Milestone' => array(
			'className' => 'Milestone',
			'foreignKey' => 'milestone_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache'	=> true
		)
	);

	var $hasMany = array(
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'user_story_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Task.sort_order ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
			'counterCache'	=> true
		)
	);
	
	function beforeSave(){
		
		if(!isset($this->data['UserStory']['sort-order']) && isset($this->data['UserStory']['milestone_id'])){
			$test = $this->find('first',array(
				'conditions'	=> array('UserStory.milestone_id'	=> $this->data['UserStory']['milestone_id']),
				'order'			=> 'UserStory.sort_order DESC'
			));
			
			if($test){
				$this->data['UserStory']['sort_order'] = $test['UserStory']['sort_order'] + 1;
			}else{
				$this->data['UserStory']['sort_order'] = 1;
			}
			
		}
		
		return $this->data;
		
	}
}
