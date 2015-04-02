<h1>Edit Post</h1>
<?php
	echo $this->Form->create('User');
	echo $this->Form->input('username');
	echo $this->Form->input('password');
	echo $this->Form->input('realname');
	echo $this->Form->input('role', array(
		'options' => array(
			'admin' => 'Admin',
			'dev' => 'Web Developer',
			'graphics' => 'Graphic Designer',
			'client' => 'Client'
		)
	));
	$options = array(
		'label' => 'Save',
		'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options);
?>