<!-- app/View/Projects/view.ctp -->
<div class="container marketing">
    <div class="row">
        <div class="span8">
            <div class="page-header">
                <h1>Project <small><?php echo $project['Project']['title']; ?></small></h1>
                <a href="<?php echo $this->webroot; ?>projects/add" class="newbtn btn btn-success">New Project</a>
            </div>
            <div>
                <p>Coming soon.</p>
            </div>
        </div>
        <div class="span4">
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
    </div>
</div>