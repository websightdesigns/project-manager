<?php
	App::uses('AuthComponent', 'Controller/Component');
	class User extends AppModel {

		// public $hasOne = 'Profile';

		public function beforeSave($options = array()) {

			// prepare the password
			if (isset($this->data[$this->alias]['pwd'])) {
				$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['pwd']);
			}

			// prepare the teams
			if(isset($this->data[$this->alias]['teams']) && is_array($this->data[$this->alias]['teams'])) {
				$teams = implode(',', $this->data[$this->alias]['teams']);
				$this->data[$this->alias]['teams'] = $teams;
			}

			return true;
		}

		public $validate = array(
			'username' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A username is required'
				)
			),
			'name' => array(
				'required' => array(
					'rule' => array('notEmpty'),
					'message' => 'A name is required'
				)
			),
			'role' => array(
				'valid' => array(
					'rule' => array('inList', array('admin', 'accountant', 'developer', 'manager', 'graphics', 'client')),
					'message' => 'Please enter a valid role',
					'allowEmpty' => false
				)
			),
			'teams' => array(
				'valid' => array(
					'rule' => array('multiple', array('min' => 1)),
					'message' => 'A user must belong to at least one team',
					'allowEmpty' => false
				)
			)
		);

		protected function comparePasswords() {
			return ($this->data[$this->alias]['pwd'] === $this->data[$this->alias]['pwd2']);
		}

		protected function confirmPassword($field = null){
			return (Security::hash($this->data[$this->alias]['oldpasswd'], null, true) === $this->data['User']['password']);
		}

	}
?>