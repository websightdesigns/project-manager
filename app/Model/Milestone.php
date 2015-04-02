<?php
	App::uses('AuthComponent', 'Controller/Component');
	class Milestone extends AppModel {

		public $belongsTo = array(
			'User' => array(
				'className' => 'User',
				'foreignKey' => 'user_id'
			),
			'Project' => array(
				'className' => 'Project',
				'foreignKey' => 'project_id'
			)
		);

		public $hasMany = array(
			'Ticket' => array(
				'className' => 'Ticket',
				'foreignKey' => 'id'
			)
		);

		public $validate = array(
			'username' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A username is required'
				)
			),
			'password' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A password is required'
				)
			),
			'role' => array(
				'valid' => array(
					'rule' => array('inList', array('admin', 'dev', 'graphics', 'client')),
					'message' => 'Please enter a valid role',
					'allowEmpty' => false
				)
			)
		);

	}
?>