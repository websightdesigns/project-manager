<h1><i class="fa fa-gear"></i> Settings</h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li class="active">Settings</li>
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
		<?php if($this->Session->read('Auth.User.role') == "admin") { ?>
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#general" data-toggle="tab">General</a></li>
					<li><a href="#site" data-toggle="tab">Site</a></li>
					<li><a href="#theme" data-toggle="tab">Theme</a></li>
					<!-- <li><a href="#users" data-toggle="tab">Users</a></li>
					<li><a href="#projects" data-toggle="tab">Projects</a></li>
					<li><a href="#notices" data-toggle="tab">Notifications</a></li> -->
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="general">
						<?
							$itemsperpage = Configure::read('AppSettings.itemsperpage');
							echo $this->Form->create('Setting', array(
								'inputDefaults' => array(
									'div' => array('class' => 'form-group')
								)
							));
							echo $this->Form->input('itemsperpage', array(
								'label' => 'By default, how many items per page?',
								'default' => $itemsperpage,
								'between' => '<p class="text-info">Each user can set their own default if they choose.</p>',
								'empty' => true,
								'class' => 'form-control'
							));
						?>
					</div>
					<div class="tab-pane" id="site">
						<?
							$appname = Configure::read('AppSettings.appname');
							$headerlogo = Configure::read('AppSettings.headerlogo');
							$sitedescribe = Configure::read('AppSettings.sitedescribe');
							$ogimg = Configure::read('AppSettings.ogimg');
							$favicon = Configure::read('AppSettings.favicon');
							echo $this->Form->create('Setting', array(
								'inputDefaults' => array(
									'div' => array('class' => 'form-group')
								)
							));
							echo $this->Form->input('appname', array(
								'label' => 'App Name',
								'default' => $appname,
								'empty' => true,
								'class' => 'form-control'
							));
							echo $this->Form->input('sitedescribe', array(
								'label' => 'Site Description',
								'default' => $sitedescribe,
								'empty' => true,
								'class' => 'form-control'
							));
							echo $this->Form->input('favicon', array(
								'label' => 'Favicon Path',
								'default' => $favicon,
								'between' => '<p class="text-info">Path to a favicon image relative to the root</p>',
								'empty' => true,
								'class' => 'form-control'
							));
							echo $this->Form->input('ogimg', array(
								'label' => 'Open Graph Icon',
								'default' => $ogimg,
								'between' => '<p class="text-info">The full URL path to an icon image</p>',
								'empty' => true,
								'class' => 'form-control'
							));
						?>
					</div>
					<div class="tab-pane" id="theme">
						<label for="headerlogo">Header Logo</label>
						<div class="tabbable">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#headerlogo_url" data-toggle="tab">Relative URL</a></li>
								<li><a href="#headerlogo_file" data-toggle="tab">From File</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="headerlogo_url">
									<?php
										echo $this->Form->input('headerlogo', array(
											'label' => '',
											'default' => $headerlogo,
											'between' => '<p class="text-info">A URL relative to the web root for the header logo</p>',
											'empty' => true,
											'class' => 'form-control'
										));
									?>
								</div>
								<div class="tab-pane" id="headerlogo_file">
									<?php
										echo $this->Form->input('headerlogo', array(
											'label' => '',
											'default' => $headerlogo,
											'between' => '<p class="text-info">Upload a file for the header logo</p>',
											'empty' => true,
											'class' => 'form-control',
											'type' => 'file'
										));
									?>
								</div>
							</div>
						</div>
					</div>
					<!-- <div class="tab-pane" id="users">
						<p>Coming soon.</p>
					</div>
					<div class="tab-pane" id="projects">
						<p>Coming soon.</p>
					</div>
					<div class="tab-pane" id="notices">
						<p>Coming soon.</p>
					</div> -->
				</div>
			</div>
		<?php } else { ?>
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#general" data-toggle="tab">General</a></li>
					<li><a href="#notices" data-toggle="tab">Notifications</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="general">
						<?
							$itemsperpage = Configure::read('AppSettings.itemsperpage');
							echo $this->Form->create('Setting', array(
								'inputDefaults' => array(
									'div' => array('class' => 'form-group')
								)
							));
							echo $this->Form->input('itemsperpage', array(
								'label' => 'How many items per page?',
								'default' => $itemsperpage
							));
						?>
					</div>
					<div class="tab-pane" id="notices">

					</div>
				</div>
			</div>
		<?php } ?>
		<?php
			$options = array(
				'label' => 'Save',
				'class' => 'btn btn-primary'
			);
			echo $this->Form->end($options);
		?>
	</div>
</div>