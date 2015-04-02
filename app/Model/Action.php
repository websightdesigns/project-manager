<?php
	class Action extends AppModel {

		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id'
			),
			'Ticket' => array(
				'className' => 'Ticket',
				'foreignKey' => 'ticket_id'
			),
			'Project' => array(
				'className' => 'Project',
				'foreignKey' => 'project_id'
			)
		);

		public $validate = array(
			'status' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A status is required'
				)
			),
			'action' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A action is required'
				)
			),
			'ticket_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A user ID is required'
				)
			),
			'project_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A user ID is required'
				)
			),
			'user_id' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A user ID is required'
				)
			)
		);

	}
?>