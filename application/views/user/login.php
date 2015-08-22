<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open(); ?>
		<p>
			<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" />
		</p>
		<p>
			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" />
		</p>
		<p>
			<input type="submit" class="submitBtn" value="Submit" />
		</p>
	<?php echo form_close(); ?>
</div>