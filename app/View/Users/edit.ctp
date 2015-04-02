<h1>Edit User <small><?php echo $user['User']['name']; ?></small></h1>
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('username', array('label' => 'User Name', 'readonly' => true));
	echo $this->Form->input('pwd', array('label' => 'Change Password', 'type' => 'password', 'autocomplete' => 'off'));
	echo $this->Form->input('pwd2', array('label' => 'Repeat Password', 'type' => 'password', 'autocomplete' => 'off'));
	echo $this->Form->input('name', array('label' => 'Display Name'));
	if($this->Session->read('Auth.User.role') == "admin") {
		echo $this->Form->input('role', array(
			'options' => $role_names,
			'empty' => true,
			'label' => 'User Role',
			'class' => 'chosen',
			'div' => array('style' => 'width:220px;margin-bottom:2em;')
		));
		$selected = explode(",", $user['User']['teams']);
		echo $this->Form->input('teams', array(
			'options' => $team_names,
			'selected' => $selected,
			'empty' => true,
			'label' => 'Teams',
			'class' => 'chosen',
			'multiple' => true,
			'div' => array('style' => 'width:220px;margin-bottom:2em;')
		));
	}
	$options = array(
		'label' => 'Save',
		'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options);
?>