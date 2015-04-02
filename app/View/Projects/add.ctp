<!-- app/View/Projects/add.ctp -->
<?php
	$project_groups = array('0' => 'Add A New Project Group');
	if(!empty($projects) && is_array($projects)) {
		foreach($projects AS $key => $project) {
			if(!empty($project['Project']['group']) && isset($project['Project']['group'])) {
				$id = $project['Project']['group'];
				$project_groups[$id] = $project['Project']['group'];
			}
		}
	}
	$project_groups = array_unique($project_groups);

	$project_titles = array('0' => 'Add A New Project');
	foreach($projects AS $key => $project) {
		$id = $project['Project']['id'];
		$project_titles[$id] = $project['Project']['title'];
	}

	$user_names = array('0' => 'Add A New User');
	foreach($users AS $key => $user) {
		$id = $user['User']['id'];
		$user_names[$id] = $user['User']['name'];
	}
?>
<h1><i class="fa fa-archive"></i> Add a New Project</h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li><a href="<?php echo $this->webroot; ?>projects">Projects</a></li>
	<li class="active">Add Project</li>
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
	<div class="projects col-md-8 col-md-pull-4">
		<?php echo $this->Form->create('Project'); ?>
			<fieldset>
				<legend><?php echo __('Add Project'); ?></legend>
				<?php
				echo $this->Form->input('title', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Project Title',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('description', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Project Description',
					'div' => array( 'class' => 'form-group' )
				));
				?>
			</fieldset>
		<?php
			$options = array(
				'label' => 'Add Project',
				'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options);
		?>
	</div>
</div>