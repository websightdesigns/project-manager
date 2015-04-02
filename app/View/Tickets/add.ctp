<!-- app/View/Tickets/add.ctp -->
<?php
	$project_titles = array('0' => 'Add A New Project');
	foreach($projects AS $key => $project) {
		$id = $project['Project']['id'];
		$project_titles[$id] = $project['Project']['title'];
	}
	$milestone_titles = array('0' => 'Add A New Milestone');
	foreach($milestones AS $key => $milestone) {
		$id = $milestone['Milestone']['id'];
		$milestone_titles[$id] = $milestone['Milestone']['title'];
	}
	$user_names = array('0' => 'Add A New User');
	foreach($users AS $key => $user) {
		$id = $user['User']['id'];
		$user_names[$id] = $user['User']['name'];
	}
?>
<h1><i class="fa fa-archive"></i> Add a New Ticket</h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li><a href="<?php echo $this->webroot; ?>tickets">Tickets</a></li>
	<li class="active">Add Ticket</li>
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
	<div class="tickets col-md-8 col-md-pull-4">
		<?php echo $this->Form->create('Ticket'); ?>
		<fieldset>
			<legend><?php echo __('Add Ticket'); ?></legend>
			<?php
				echo $this->Form->input('title', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Ticket Title',
					'div' => array( 'class' => 'form-group' )
				));
				echo $this->Form->input('description', array(
					'empty' => true,
					'class' => 'form-control',
					'placeholder' => 'Ticket Description',
					'div' => array( 'class' => 'form-group' )
				));
			?>
			<div class="row">
				<div class="col-md-6">
					<?php
						echo $this->Form->input('project_id', array(
							'empty' => true,
							'label' => 'Project',
							'options' => $project_titles,
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
						echo $this->Form->input('project_title', array(
							'empty' => true,
							'class' => 'form-control',
							'placeholder' => 'Project Title',
							'div' => array( 'id' => 'TicketProjectTitleGroup', 'class' => 'form-group' )
						));
						echo $this->Form->input('assigned_to', array(
							'empty' => true,
							'label' => 'Assigned to',
							'options' => $user_names,
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
						echo $this->Form->input('priority', array(
							'empty' => true,
							'label' => 'Priority',
							'options' => array(
								'low' => 'Low',
								'medium' => 'Medium',
								'high' => 'High',
								'critical' => 'Critical'
							),
							'default' => 'medium',
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
					?>
				</div>
				<div class="col-md-6">
					<?php
						echo $this->Form->input('milestone_id', array(
							'empty' => true,
							'label' => 'Milestone',
							'options' => $milestone_titles,
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
						echo $this->Form->input('milestone_title', array(
							'empty' => true,
							'class' => 'form-control',
							'placeholder' => 'Milestone Title',
							'div' => array( 'id' => 'TicketMilestoneTitleGroup', 'class' => 'form-group' )
						));
						echo $this->Form->input('status', array(
							'empty' => true,
							'label' => 'Status',
							'options' => array(
								'new' => 'New',
								'accepted' => 'Accepted',
								'inprogress' => 'In Progress',
								'complete' => 'Complete',
								'rejected' => 'Rejected',
								'qa' => 'QA',
								'internalqa' => 'Internal QA',
								'production' => 'Ready For Production'
							),
							'default' => 'new',
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
						echo $this->Form->input('ticket_type', array(
							'empty' => true,
							'label' => 'Type',
							'options' => array(
								'enhancement' => 'Enhancement',
								'feature' => 'Feature',
								'task' => 'Task',
								'bug' => 'Bug'
							),
							'default' => 'task',
							'class' => 'chosen col-lg-4',
							'div' => array( 'class' => 'form-group' )
						));
					?>
				</div>
			</div>
		</fieldset>
		<?php
			$options = array(
				'label' => 'Add Ticket',
				'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options);
		?>
	</div>
</div>