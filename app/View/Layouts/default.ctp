<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$appName = __d('cake_dev', 'Project Manager');
$companyName = __d('cake_dev', 'webSIGHTdesigns, Inc.');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php echo $this->Html->charset(); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="<?php echo $this->webroot; ?>favicon.ico">

	<title><?php echo $title_for_layout . ' - ' . $appName; ?></title>

	<link href="<?php echo $this->webroot; ?>js/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $this->webroot; ?>css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo $this->webroot; ?>js/vendor/chosen/chosen.min.css" rel="stylesheet">
	<link href="<?php echo $this->webroot; ?>css/main.css" rel="stylesheet">

	<?php
		if(!$this->Session->read('Auth.User')) {
			?>
			<style>
				#wrap {
					margin: 0 auto -59px;
				}
				.form-signin {
					max-width: 330px;
					padding: 15px;
					margin: 0 auto;
				}
				.form-signin .form-signin-heading,
				.form-signin input[type="checkbox"] {
					margin-bottom: 10px;
				}
				.form-signin input[type="checkbox"] {
					margin-right: 0.5em;
				}
				.form-signin input[type="checkbox"] {
					font-weight: normal;
				}
				.form-signin .form-control {
					position: relative;
					font-size: 16px;
					height: auto;
					padding: 10px;
					-webkit-box-sizing: border-box;
					-moz-box-sizing: border-box;
					box-sizing: border-box;
				}
				.form-signin .form-control:focus {
					z-index: 2;
				}
				.form-signin input[type="email"] {
					margin-bottom: -1px;
					border-bottom-left-radius: 0;
					border-bottom-right-radius: 0;
				}
				.form-signin input[type="password"] {
					margin-bottom: 10px;
					border-top-left-radius: 0;
					border-top-right-radius: 0;
				}
			</style>
			<?php
		}
	?>

	<?php
		echo $this->fetch('meta');
		echo $this->fetch('script');
	?>

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
  </head>

  <body>

	<div id="wrap">

		<?php if($this->Session->read('Auth.User')) { ?>
			<?php

			?>
			<div id="topmenu-wrapper" class="container">
				<div class="col-lg-12">
					<div id="topmenu">
						<ul class="homemenu">
							<li><span class="glyphicon glyphicon-home"></span> <a href="<?php echo $this->webroot; ?>">Home</a></li>
							<li class="hidden-xs"><span class="glyphicon glyphicon-search"></span> <a href="#" id="searchlink_form" rel="popover" class="popover-link" data-placement="bottom" data-title="Search" data-content='<form class="form-search form-inline" role="form"><div class="form-group"><input type="text" class="form-control" placeholder="Search"></div><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></form>'>Search</a></li>
						</ul>
						<ul class="usermenu">
							<li class="notifications">
								<a href="#" rel="notifications" class="popover-link" data-title="Notifications">
									<span class="label label-primary">0</span>
								</a>
							</li>
							<li><span class="glyphicon glyphicon-user"></span> <a href="<?php echo $this->webroot; ?>users/edit/<?php echo $this->Session->read('Auth.User.id'); ?>"><?php echo ($this->Session->read('Auth.User.name') ? $this->Session->read('Auth.User.name') : 'Welcome'); ?></a></li>
							<li><span class="glyphicon glyphicon-cog"></span> <a href="<?php echo $this->webroot; ?>settings/">Settings</a></li>
							<li class="hidden-xs"><span class="glyphicon glyphicon-off"></span> <a href="<?php echo $this->webroot; ?>users/logout/"><i class="icon-off icon-white"></i>Sign Out</a></li>
						</ul>
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo $this->webroot; ?>"><?php echo $appName; ?></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<?php if($this->Session->read('Auth.User')) { ?>
							<li<?php if($_SERVER['REQUEST_URI'] == $this->webroot) echo ' class="active"'; ?>><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
							<li<?php if(substr($_SERVER['REQUEST_URI'], 0, strlen($this->webroot . 'projects')) == $this->webroot . 'projects') echo ' class="active"'; ?>><a href="<?php echo $this->webroot; ?>projects">Projects</a></li>
							<li<?php if(substr($_SERVER['REQUEST_URI'], 0, strlen($this->webroot . 'milestones')) == $this->webroot . 'milestones') echo ' class="active"'; ?>><a href="<?php echo $this->webroot; ?>milestones">Milestones</a></li>
							<li<?php if(substr($_SERVER['REQUEST_URI'], 0, strlen($this->webroot . 'tickets')) == $this->webroot . 'tickets') echo ' class="active"'; ?>><a href="<?php echo $this->webroot; ?>tickets">Tickets</a></li>
							<li<?php if(substr($_SERVER['REQUEST_URI'], 0, strlen($this->webroot . 'calendar')) == $this->webroot . 'calendar') echo ' class="active"'; ?>><a href="<?php echo $this->webroot; ?>calendar">Calendar</a></li>
							<!-- <li class="<?php if(substr($_SERVER['REQUEST_URI'], 0, strlen($this->webroot . 'reports')) == $this->webroot . 'reports') echo 'active '; ?>dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li role="presentation" class="dropdown-header">Tickets</li>
									<li><a href="<?php echo $this->webroot; ?>reports/tickets/">Tickets</a></li>
									<li class="divider"></li>
									<li role="presentation" class="dropdown-header">Time Tracking</li>
									<li><a href="<?php echo $this->webroot; ?>reports/tracked/">Tracked Time</a></li>
									<li><a href="<?php echo $this->webroot; ?>reports/billed">Billed Time</a></li>
								</ul>
							</li> -->
						<?php } else { ?>
							<li class="active"><a href="<?php echo $this->webroot; ?>">Sign In</a></li>
						<?php } ?>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

		<div id="main" class="container">

			<div class="home-page-header">
				<h1><?php echo $this->Html->link($appName, $this->webroot); ?></h1>
			</div>

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>

			<?php echo $this->element('sql_dump'); ?>

		</div>

	</div>

	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul>
						<?php if($this->Session->read('Auth.User')) { ?>
						<li><a href="<?php echo $this->webroot; ?>users/" title="">Users</a></li>
						<li><a href="<?php echo $this->webroot; ?>users/logout/" class="visible-xs" title="">Sign Out</a></li>
						<?php } ?>
						<li>&copy; <?php echo date('Y') . ' ' . $companyName; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo $this->webroot; ?>js/vendor/jquery.min.js"></script>
	<script src="<?php echo $this->webroot; ?>js/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo $this->webroot; ?>js/vendor/chosen/jquery.chosen.min.js"></script>
	<script src="<?php echo $this->webroot; ?>js/main.js"></script>
</body>
</html>