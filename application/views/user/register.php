<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
	<?php echo validation_errors('<p class="error">'); ?>
	<?php echo form_open("user/submit"); ?>
		<p>
			<input type="text" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username" />
		</p>
		<p>
			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" placeholder="Password" />
		</p>
		<p>
			<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" placeholder="Confirm" />
		</p>
		<p>
			<input type="text" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="First Name" />
		</p>
		<p>
			<input type="text" id="lastname" name="lastname" value="<?php echo set_value('lastname'); ?>" placeholder="Last Name" />
		</p>        
		<p>
			<input type="text" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email" />
		</p>
		        
		<p>
			<input type="submit" class="submitBtn" value="Submit" />
		</p>
	<?php echo form_close(); ?>
</div>