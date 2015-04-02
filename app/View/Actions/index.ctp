<h1><i class="fa fa-tachometer"></i> Activity Feed <small>All Projects</small></h1>

<ol class="breadcrumb">
	<li class="active">Dashboard</li>
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
		<?php if(!empty($projects) && is_array($projects)) { ?>
			<div class="list-group projects-list">
				<span class="list-group-item list-group-item-title noselect">
					<p class="list-group-item-text"><strong>My Assigned Projects</strong><span class="pull-right show-projects"><i class="fa fa-plus-square-o"></i></span></p>
				</span>
				<?php foreach($projects AS $project) { ?>
				<a href="<?php echo $this->webroot; ?>projects/view/<?php echo $project['Project']['id']; ?>" class="list-group-item">
					<p class="list-group-item-text"><?php echo $project['Project']['title']; ?></p>
				</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-8 col-md-pull-4">
		<div class="list-group activity-list">
			<?php if(!empty($actions) && is_array($actions)) { ?>
				<?php foreach ($actions as $action): ?>
					<?php
						if($action['Action']['status'] == "new") $status = "primary";
						elseif($action['Action']['status'] == "accepted") $status = "success";
						elseif($action['Action']['status'] == "inprogress") $status = "warning";
						elseif($action['Action']['status'] == "rejected") $status = "danger";
						elseif($action['Action']['status'] == "file") $status = "info";
						else $status = $action['Action']['status'];
					?>
					<a href="<?php echo $this->webroot; ?>tickets/view/<?php echo $action['Action']['ticket_id']; ?>" class="list-group-item">
						<p class="list-group-item-text"><span class="label label-status label-<? echo $status; ?>"><?php echo strtoupper($action['Action']['status']); ?></span> <i class="fa fa-ticket"></i> <strong><?php echo $action['User']['name']; ?></strong> <span class="action"><?php echo $action['Action']['action']; ?></span> <span class="label label-default">#<?php echo $action['Action']['ticket_id']; ?></span> <?php echo $action['Ticket']['title']; ?> <small>in <em class="text-muted"><?php echo $action['Project']['title']; ?></em></small></p>
					</a>
				<?php endforeach; ?>
			<?php } ?>
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