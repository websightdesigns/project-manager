<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php
	$options = array(
	    'label' => 'Sign In',
	    'class' => 'btn btn-primary'
	);
	echo $this->Form->end($options);
?>
</div>