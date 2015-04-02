<?php
	class Project extends AppModel {

		public $validate = array(
			'title' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A project name is required'
				)
			)
		);

	}
?>