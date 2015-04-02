<?php
	class Ticket extends AppModel {

		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id'
			),
			'Milestone' => array(
				'className' => 'Milestone',
				'foreignKey' => 'milestone_id'
			),
			'Project' => array(
				'className' => 'Project',
				'foreignKey' => 'project_id'
			)
		);

		public $hasMany = array(
			'Action' => array(
				'className' => 'Action',
				'foreignKey' => 'ticket_id'
			)
		);

		public $validate = array(
			'title' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A ticket title is required'
				)
			),
			'user_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A reported user ID is required'
				)
			),
			'assigned_to' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'An assigned user ID is required'
				)
			),
			'project_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'An assigned user ID is required'
				)
			),
			'priority' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A ticket priority is required'
				)
			),
			'ticket_type' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A ticket type is required'
				)
			)
		);

	}
?>