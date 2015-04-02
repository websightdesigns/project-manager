<div class="container marketing">
	<div class="row">
		<div class="span8">
			<div class="page-header">
				<h1>Settings</h1>
			</div>
			<?php if($this->Session->read('Auth.User.role') == "admin") { ?>
				<div class="tabbable">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#general" data-toggle="tab">General</a></li>
						<li><a href="#site" data-toggle="tab">Site</a></li>
						<li><a href="#theme" data-toggle="tab">Theme</a></li>
						<li><a href="#users" data-toggle="tab">Users</a></li>
						<li><a href="#projects" data-toggle="tab">Projects</a></li>
						<li><a href="#notices" data-toggle="tab">Notifications</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="general">
							<?
								$itemsperpage = Configure::read('AppSettings.itemsperpage');
								echo $this->Form->create('Setting', array(
									'inputDefaults' => array(
										'div' => array('class' => 'control-group')
									)
								));
								echo $this->Form->input('itemsperpage', array(
									'label' => 'By default, how many items per page?',
									'default' => $itemsperpage,
									'between' => '<p class="text-info">The user can set their own default if they choose.</p>'
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
										'div' => array('class' => 'control-group')
									)
								));
								echo $this->Form->input('appname', array(
									'label' => 'App Name',
									'default' => $appname
								));
								echo $this->Form->input('sitedescribe', array(
									'label' => 'Site Description',
									'default' => $sitedescribe
								));
								echo $this->Form->input('favicon', array(
									'label' => 'Favicon Path',
									'default' => $favicon,
									'between' => '<p class="text-info">Path to a favicon image relative to the root</p>'
								));
								echo $this->Form->input('ogimg', array(
									'label' => 'Open Graph Icon',
									'default' => $ogimg,
									'between' => '<p class="text-info">The full URL path to an icon image</p>'
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
												'between' => '<p class="text-info">A URL relative to the web root for the header logo</p>'
											));
										?>
									</div>
									<div class="tab-pane" id="headerlogo_file">
										<?php
											echo $this->Form->input('headerlogo', array(
												'label' => '',
												'default' => $headerlogo,
												'between' => '<p class="text-info">Upload a file for the header logo</p>',
												'type' => 'file'
											));
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="users">
							<h3>User Roles</h3>
						</div>
						<div class="tab-pane" id="projects">

						</div>
						<div class="tab-pane" id="notices">

						</div>
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
										'div' => array('class' => 'control-group')
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
</div>