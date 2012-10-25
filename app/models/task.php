<?php
class Task extends AppModel {
	var $name = 'Task';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_story_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'exists' => array(
				'rule' => array('user_story_exists'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'UserStory' => array(
			'className' => 'UserStory',
			'foreignKey' => 'user_story_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache'=>true
		)
	);

	public function user_story_exists($data){
		$this->UserStory->id = $data['user_story_id'];
		return $this->UserStory->exists();
	}
}
