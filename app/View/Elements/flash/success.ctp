<div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#">&times;</a>
	<?php if (isset($heading)) { ?>
		<h4 class="alert-heading"><?php echo $heading; ?></h4>
	<?php }
	echo '<span class="glyphicon glyphicon-thumbs-up"></span> ' . $message; ?>
</div>