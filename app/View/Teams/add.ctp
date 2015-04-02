<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
		<?php echo $this->Form->input('username');
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