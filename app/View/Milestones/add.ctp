<!-- app/View/Milestones/add.ctp -->
<?php
    $project_titles = array('0' => 'Add A New Project');
    foreach($projects AS $key => $project) {
        $id = $project['Project']['id'];
        $project_titles[$id] = $project['Project']['title'];
    }
?>
<!-- app/View/Milestones/add.ctp -->
<?php
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
<h1><i class="fa fa-archive"></i> Add a New Milestone</h1>

<ol class="breadcrumb">
    <li><a href="<?php echo $this->webroot; ?>">Dashboard</a></li>
    <li><a href="<?php echo $this->webroot; ?>tickets">Milestones</a></li>
    <li class="active">Add Milestone</li>
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
        <?php echo $this->Form->create('Milestone'); ?>
        <fieldset>
            <legend><?php echo __('Add Milestone'); ?></legend>
            <?php
            echo $this->Form->input('title', array(
                'empty' => true,
                'class' => 'form-control',
                'placeholder' => 'Milestone Title',
                'div' => array( 'class' => 'form-group' )
            ));
            echo $this->Form->input('project_id', array(
                'empty' => true,
                'label' => 'Project',
                'options' => $project_titles,
                'default' => '',
                'class' => 'chosen',
                'div' => array( 'style' => 'width:220px;margin-bottom:2em;' )
            ));
            ?>
        </fieldset>
        <?php
            $options = array(
                'label' => 'Add Milestone',
                'class' => 'btn btn-primary'
            );
            echo $this->Form->end($options);
        ?>
    </div>
</div>