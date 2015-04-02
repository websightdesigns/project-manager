<!-- app/View/Projects/view.ctp -->

<h1><i class="fa fa-archive"></i> Project <small><?php echo $project['Project']['title']; ?></small></h1>

<ol class="breadcrumb">
    <li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
    <li><a href="<?php echo $this->webroot; ?>projects">Projects</a></li>
    <li class="active"><?php echo $project['Project']['title']; ?></li>
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
        <p>Coming soon.</p>
    </div>
</div>