<!-- app/View/Milestones/view.ctp -->

<h1><i class="fa fa-archive"></i> Milestone <small><?php echo $milestone['Milestone']['title']; ?></small></h1>

<ol class="breadcrumb">
    <li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
    <li><a href="<?php echo $this->webroot; ?>projects">Projects</a></li>
    <li><a href="<?php echo $this->webroot; ?>projects/view/<?php echo $project['Project']['id']; ?>"><?php echo $project['Project']['title']; ?></a></li>
    <li class="active"><?php echo $milestone['Milestone']['title']; ?></li>
</ol>

<div class="row">
    <div class="col-md-4 col-md-push-8">
        <div class="newbtn">
            <a href="<?php echo $this->webroot; ?>milestones/add" class="btn btn-success btn-block">New Milestone</a>
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
            <select id="projectgroupfilter" data-placeholder="Choose a Project Group..." class="chosen" style="width:350px;" tabindex="3">
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
            <select id="projectfilter" data-placeholder="Choose a Project..." class="chosen" style="width:350px;" tabindex="3">
                <option value="">All Projects</option>
                <?php foreach($projects AS $project) { ?>
                <option value="<?php echo $project['Project']['id']; ?>"><?php echo $project['Project']['title']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="projects col-md-8 col-md-pull-4">
        <?php
            // display $tickets here
        ?>
    </div>
</div>