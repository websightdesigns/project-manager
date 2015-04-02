<h1><i class="fa fa-calendar"></i> Calendar <small>Month View</small></h1>

<ol class="breadcrumb">
	<li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
	<li class="active">Calendar</li>
</ol>

<div class="row">
	<div class="col-md-4 col-md-push-8">
		<div class="newbtn">
			<a href="<?php echo $this->webroot; ?>events/add" class="btn btn-success btn-block">New Event</a>
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
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#gantt" data-toggle="tab">Timeline</a></li>
				<li><a href="#month" data-toggle="tab">Month</a></li>
				<li><a href="#week" data-toggle="tab">Week</a></li>
				<li><a href="#day" data-toggle="tab">Day</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="gantt">
					<div id="gantt"></div>
				</div>
				<div class="tab-pane" id="month">
					<?php
						// list months
						$year = date('Y');
						$cur_month = date('m');
						$nextyear = $year+1;
						$begin = new DateTime( $year . '-01-01' );
						$end = new DateTime( $nextyear . '-01-01' );
						$interval = DateInterval::createFromDateString('1 month');
						$period = new DatePeriod($begin, $interval, $end);
					?>
					<div class="calendar">
					<?php
						// iterate through months
						$year = date('Y');
						$nextyear = $year + 1;
						$begin_dt = $year . '-01-01';
						$begin = new DateTime( $begin_dt );
						$eng_dt = $nextyear . '-01-01';
						$end = new DateTime( $eng_dt );
						$interval = DateInterval::createFromDateString('1 month');
						$period = new DatePeriod($begin, $interval, $end);
						$j = 0;
						foreach ( $period as $dt ) {
							$activemonth = false;
							if($dt->format("m") == $cur_month) { $activemonth = true; }
							echo '<div id="' . strtolower($dt->format("M")) . '" class="month';
							if($activemonth) { echo ' active'; }
							echo '">';
							$month_name = trim($dt->format("F"));
							echo '<header>' . $month_name . '</header>';
							$headings = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
							echo  '<div class="calendar-row"><div class="calendar-day-head">'.implode('</div><div class="calendar-day-head">',$headings).'</div></div>';
							$month = trim($dt->format("m"));
							$nextmonth = trim(sprintf("%2u", $dt->format("m") + 1 ));
							if($nextmonth == "13") { $nextmonth = "01"; $endyear = $nextyear; } else { $endyear = $year; }
							$day_begin = new DateTime( $year . '-' . $month . '-01' );
							$day_end = new DateTime( $endyear . '-' . $nextmonth . '-01' );
							$day_interval = DateInterval::createFromDateString('1 day');
							$day_period = new DatePeriod($day_begin, $day_interval, $day_end);
							// iterate through days for this month
							echo '<div class="calendar-row">';
							$firstloop = false;
							$row = 0;
							foreach ( $day_period as $day_dt ) {
								$day_date = $day_dt->format("Y") . '-' . $day_dt->format("m") . '-' . $day_dt->format("d");
								$today_date = date("Y") . '-' . date("m") . '-' . date("d");
								if(!$firstloop && $day_dt->format("N") == "1") $i = 0; // monday
								if(!$firstloop && $day_dt->format("N") == "2") $i = 1; // tuesday
								if(!$firstloop && $day_dt->format("N") == "3") $i = 2; // wednesday
								if(!$firstloop && $day_dt->format("N") == "4") $i = 3; // thursday
								if(!$firstloop && $day_dt->format("N") == "5") $i = 4; // friday
								if(!$firstloop && $day_dt->format("N") == "6") $i = 5; // saturday
								if(!$firstloop && $day_dt->format("N") == "7") $i = 6; // sunday
								if(!$firstloop) {
									$ii = 0;
									while($ii < $i) {
										echo '<div class="emptyday"> </div>';
										$ii++;
									}
								}
								if(!$firstloop) { $firstdiff = $i; }
								if($i % 7 == 0) { $row++; echo '</div><div class="calendar-row">'; }
								echo '<div class="day' . ($today_date == $day_date ? ' active' : '') . '">';
								echo '<a href="" id="' . $day_date . '">';
								echo $day_dt->format("j");
								echo "</a>";
								echo "</div>";

								$i++;

								$daysinmonth = $day_dt->format("t");
								$daysblocks = $daysinmonth + $firstdiff;
								$totaldays = $row * 7;
								if($daysblocks > $totaldays) $totaldays = ($row + 1) * 7;
								if($daysblocks > $totaldays) $totaldays = ($row + 2) * 7;
								$diff = $totaldays - ($daysinmonth + $firstdiff);
								if($i == $daysblocks) {
									$jj = 0;
									while($jj < $diff) {
										echo '<div class="emptyday"> </div>';
										$jj++;
									}
								}

								$firstloop = true;
							}
							echo '</div>';
							echo '</div>';
							$j++;
						}
					?>
					</div>
				</div>
				<div class="tab-pane" id="week">

				</div>
				<div class="tab-pane" id="day">

				</div>
			</div>
		</div>
	</div>
</div>