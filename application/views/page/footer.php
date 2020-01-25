<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

// footer.php Chris Dart Mar 6, 2015 2:21:46 PM chrisdart@cerebratorium.com

?>
<footer>
<?php if(isset($is_front)): ?>
<span id="ci-version">
<?php echo "CI Version: v" . CI_VERSION;?>,
</span>
	<span class='app-name'><?php echo APP_NAME;?>: <?php echo APP_VERSION;?></span>

<?php endif; ?>
</footer>