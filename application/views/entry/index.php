<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div>
	<?php echo form_open(); ?>
	<p>
		<input type="text" id="date" name="date" value="<?php echo $date; ?>" placeholder="Date" />
	</p>
	<p>
		<select name="category" id="category" class="">
		<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category->users_categories_id; ?>" ><?php echo $category->description; ?></option>	
		<?php } ?>
		</select>
	</p>
	<p>
		<input type="text" id="description" name="description" value="<?php echo set_value('description'); ?>" placeholder="Description" />
	</p>
	<p>
		<input type="number" id="amount" name="amount" value="<?php echo set_value('amount'); ?>" placeholder="Amount" />
	</p>
	<p>
		<select name="entry_type" id="entry_type" class="">
		<?php foreach($entry_types as $entry_type) { ?>
			<option value="<?php echo $entry_type->entry_type_id; ?>" ><?php echo $entry_type->description; ?></option>	
		<?php } ?>
		</select>
	</p>
<p>
			<input type="submit" class="submitBtn" value="Submit" />
		</p>
<?php echo form_close(); ?>
</div>
<?php echo add_js('entry.js'); ?>