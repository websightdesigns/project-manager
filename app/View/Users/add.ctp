<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php echo $this->Form->input('username');
		echo $this->Form->input('pwd', array(
			'label' => 'Password',
			'type' => 'password'
		));
		if($this->Session->read('Auth.User.role') == "admin") {
			echo $this->Form->input('name');
			echo $this->Form->input('role', array(
				'options' => $role_names
			));
		}
	?>
	</fieldset>
	<?php
		$options = array(
			'label' => 'Add User',
			'class' => 'btn btn-primary'
		);
		echo $this->Form->end($options);
	?>
</div>