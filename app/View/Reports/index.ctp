<div class="container marketing">
	<div class="row">
		<div class="span8">
			<div class="page-header">
				<h1>Users <small>All Users</small></h1>
				<a href="<?php echo $this->webroot; ?>users/add" class="newbtn btn btn-success">New User</a>
			</div>
			<form class="form">
				<select id="viewfilter" data-placeholder="Select Filters..." class="chosen statusviewer" multiple tabindex="2" autofocus>
					<option value=""></option>
					<option value="admin" selected="selected">Admins</option>
					<option value="dev" selected="selected">Web Developers</option>
					<option value="graphics" selected="selected">Graphic Designers</option>
					<option value="client" selected="selected">Clients</option>
				</select>
			</form>
			<div class="users">
				<?php foreach ($users as $user): ?>
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src="<?php echo $this->webroot; ?>img/user.png">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $user['User']['username']; ?></h4>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="span4">
			<div class="selectproject">
				<select id="projectfilter" data-placeholder="Choose a Project..." class="chosen" style="width:386px;" tabindex="3">
					<option value="">All Projects</option>
					<option value="Automotive Sales, Inc.">Automotive Sales, Inc.</option>
					<option value="Denver Arts District">Denver Arts District</option>
					<option value="Western Dental">Western Dental</option>
					<option value="Cisco Networks">Cisco Networks</option>
				</select>
			</div>
			<div class="search">
				<input type="text" class="input span4 search-input search-query" placeholder="Search">
			</div>
		</div>
	</div>
</div>