<!-- app/View/Users/view.ctp -->
<h1><i class="fa fa-user"></i> User <small><?php echo $user['User']['username']; ?></small></h1>

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
	<div class="users col-md-8 col-md-pull-4">
		<div class="list-group">
			<div class="list-group-item">
				<p><strong>Username:</strong> <?php echo ($user['User']['username'] ? $user['User']['username'] : '(not set)'); ?></p>
				<p><strong>Name:</strong> <?php echo ($user['User']['name'] ? $user['User']['name'] : '(not set)'); ?></p>
				<div class="btnrow">
					<a href="<?php echo $this->webroot; ?>users/edit/<?php echo $user['User']['id']; ?>" class="btn btn-warning">Edit User</a>
					<a href="<?php echo $this->webroot; ?>users/delete/<?php echo $user['User']['id']; ?>" class="btn btn-danger">Delete User</a>
				</div>
			</div>
		</div>
	</div>
</div>