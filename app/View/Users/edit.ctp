<!-- app/View/Users/edit.ctp -->
<h1><i class="fa fa-user"></i> Edit User <small><?php echo $user['User']['username']; ?></small></h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li><a href="<?php echo $this->webroot; ?>users">Users</a></li>
	<li class="active"><?php echo $user['User']['username']; ?></li>
</ol>

<div class="row">
	<div class="col-md-4 col-md-push-8">
		<div class="newbtn">
			<a href="<?php echo $this->webroot; ?>users/add" class="btn btn-success btn-block">New User</a>
		</div>
		<form role="form">
			<div class="form-group">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search">
					<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
				</div>
			</div>
		</form>
	</div>
	<div class="users section col-md-8 col-md-pull-4">
		<?php echo $this->Form->create('User'); ?>
			<fieldset>
				<legend><?php echo __('Edit User'); ?></legend>
				<?php
				echo $this->Form->input('username', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Username',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('name', array(
					'label' => 'Name',
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Name',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('pwd', array(
					'label' => 'Change Password',
					'type' => 'password',
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Password',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('pwd2', array(
					'label' => 'Repeat Password',
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
				'label' => 'Save Changes',
				'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options);
		?>
	</div>
</div>

<?php
	// echo $this->Form->create('User');
	// echo $this->Form->input('username', array('label' => 'User Name', 'readonly' => true));
	// echo $this->Form->input('pwd', array('label' => 'Change Password', 'type' => 'password', 'autocomplete' => 'off'));
	// echo $this->Form->input('pwd2', array('label' => 'Repeat Password', 'type' => 'password', 'autocomplete' => 'off'));
	// echo $this->Form->input('name', array('label' => 'Display Name'));
	// if($this->Session->read('Auth.User.role') == "admin") {
	// 	echo $this->Form->input('role', array(
	// 		'options' => $role_names,
	// 		'empty' => true,
	// 		'label' => 'User Role',
	// 		'class' => 'chosen',
	// 		'div' => array('style' => 'width:220px;margin-bottom:2em;')
	// 	));
	// 	$selected = explode(",", $user['User']['teams']);
	// 	echo $this->Form->input('teams', array(
	// 		'options' => $team_names,
	// 		'selected' => $selected,
	// 		'empty' => true,
	// 		'label' => 'Teams',
	// 		'class' => 'chosen',
	// 		'multiple' => true,
	// 		'div' => array('style' => 'width:220px;margin-bottom:2em;')
	// 	));
	// }
	// $options = array(
	// 	'label' => 'Save',
	// 	'class' => 'btn btn-primary'
	// );
	// echo $this->Form->end($options);
?>