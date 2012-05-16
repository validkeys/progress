<?php
class Roadmap extends AppModel {
	var $name = 'Roadmap';
	var $displayField = 'title';
	var $actsAs = array('Containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Milestone' => array(
			'className' => 'Milestone',
			'foreignKey' => 'roadmap_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'Milestone.sort_order ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
