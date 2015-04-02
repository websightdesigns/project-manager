<h1><i class="fa fa-archive"></i> Users <small>All Users</small></h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li class="active">Users</li>
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
		<div class="selectprojectgroup">
			<select id="projectgroupfilter" data-placeholder="Choose a Project Group..." class="chosen" style="width:386px;" tabindex="3">
				<option value="">All Groups</option>
				<?php
					foreach($projects AS $project) {
						$id = $project['Project']['id'];
						$projectgroups[$id] = $project['Project']['group'];
					}
					$projectgroups = array_unique($projectgroups);
					foreach($projectgroups AS $key => $group) {
						echo '<option value="' . $key . '">' . $group . '</option>';
					}
				?>
			</select>
		</div>
	</div>
	<div class="col-md-8 col-md-pull-4">
		<form class="form">
			<?php
				if(!empty($teams) && is_array($teams)) {
					foreach($teams AS $team) {
						$team_names[$team['Team']['id']] = $team['Team']['name'];
					}
					$selected = array('4', '5');
					echo $this->Form->input('teams', array(
						'options' => $team_names,
						'selected' => $selected,
						'empty' => true,
						'label' => '',
						'class' => 'chosen',
						'multiple' => true,
						'div' => array('style' => 'width:100%;margin-bottom:2em;')
					));
				}
			?>
		</form>
		<div class="list-group">
			<?php foreach ($users as $user): ?>
				<a href="<?php echo $this->webroot; ?>users/view/<?php echo $user['User']['id']; ?>" class="list-group-item">
					<p class="list-group-item-text"><i class="fa fa-user"></i> <?php echo $user['User']['username']; ?></p>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo $this->Paginator->numbers(array(
			'first' => 'First page',
			'before' => '<ul class="pagination">',
			'after' => '</ul></div>',
			'separator' => '',
			'tag' => 'li',
			'currentClass' => 'active',
			'currentTag' => 'a'
		)); ?>
	</div>
</div>