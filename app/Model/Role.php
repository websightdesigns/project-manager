<?php
	App::uses('AuthComponent', 'Controller/Component');

	class Role extends AppModel {

		public $validate = array(
			'name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A role name is required'
				)
			)
		);

	}
?>