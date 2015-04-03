<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User', array(
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    ),
    'class' => 'form-signin'
)); ?>
    <fieldset>
        <legend><?php echo __('Please Sign In'); ?></legend>
        <?php
            echo $this->Form->input('username', array(
                'class' => 'form-control',
                'type' => 'email',
                'required' => true,
                'autofocus' => true,
                'placeholder' => 'Username'
            ));
            echo $this->Form->input('password', array(
                'type' => 'password',
                'class' => 'form-control',
                'required' => true,
                'placeholder' => 'Password'
            ));
            echo $this->Form->input('rememberme', array(
                'type' => 'checkbox',
                'value' => '1',
                'label' => 'Remember me'
            ));
        ?>
    </fieldset>
<?php
	$options = array(
	    'label' => 'Sign In',
	    'class' => 'btn btn-lg btn-primary btn-block'
	);
	echo $this->Form->end($options);
?>
</div>