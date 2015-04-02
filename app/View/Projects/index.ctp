<h1><i class="fa fa-archive"></i> Projects <small>All Projects</small></h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li class="active">Projects</li>
</ol>

<div class="row">
	<div class="col-md-4 col-md-push-8">
		<div class="newbtn">
			<a href="<?php echo $this->webroot; ?>projects/add" class="btn btn-success btn-block">New Project</a>
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
		<div class="selectproject">
			<select id="projectfilter" data-placeholder="Choose a Project..." class="chosen" style="width:386px;" tabindex="3">
				<option value="">All Projects</option>
				<?php foreach($projects AS $project) { ?>
				<option value="<?php echo $project['Project']['id']; ?>"><?php echo $project['Project']['title']; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-md-8 col-md-pull-4">
		<form class="form">
			<select id="viewfilter" data-placeholder="Select Filters..." class="chosen statusviewer" multiple tabindex="2" autofocus>
				<option value=""></option>
				<option value="new">New</option>
				<option value="active" selected="selected">Active</option>
				<option value="onhold" selected="selected">Assigned to Me</option>
				<option value="onhold">On Hold</option>
				<option value="archived">Archived</option>
			</select>
		</form>
		<div class="list-group">
			<?php foreach ($projects as $project): ?>
				<a href="<?php echo $this->webroot; ?>projects/view/<?php echo $project['Project']['id']; ?>" class="list-group-item">
					<p class="list-group-item-text"><i class="fa fa-archive"></i> <?php echo $project['Project']['title']; ?></p>
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