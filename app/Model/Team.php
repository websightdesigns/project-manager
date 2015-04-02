<?php
	App::uses('AuthComponent', 'Controller/Component');

	class Team extends AppModel {

		public $validate = array(
			'name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A team name is required'
				)
			)
		);

	}
?>