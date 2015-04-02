<!-- app/View/Users/add.ctp -->
<h1><i class="fa fa-user"></i> Add a New User</h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li><a href="<?php echo $this->webroot; ?>users">Users</a></li>
	<li class="active">Add User</li>
</ol>

<div class="row">
	<div class="col-md-4 col-md-push-8">
		<form role="form">
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
				</div>
			</div>
		</form>
	</div>
	<div class="users col-md-8 col-md-pull-4">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Add User'); ?></legend>
				<?php
				echo $this->Form->input('username', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Username',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('pwd', array(
					'label' => 'Password',
					'type' => 'password',
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Password',
					'div' => array( 'class' => 'form-group' )
				));
				// if($this->Session->read('Auth.User.role') == "admin") {
				// 	echo $this->Form->input('name');
				// 	echo $this->Form->input('role', array(
				// 		'options' => $role_names
				// 	));
				// }
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
</div>