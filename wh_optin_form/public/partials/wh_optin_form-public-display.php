<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/waqas-hassan98/
 * @since      1.0.0
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/public/partials
 */
?>

<form id="wh_optin_form_1"  action="#">
	<div>
		<label for="full_name"><?php echo $atts['full_name'][0];?></label>
		<input type="text" maxlength="<?php echo $atts['full_name'][1] ?>" name="full_name"/>
	</div>

	<div>
		<label for="phone"><?php echo $atts['phone'][0];?></label>
		<input type="tel" maxlength="<?php echo $atts['phone'][1] ?>" name="phone_num"/>
	</div>

	<div>
		<label for="email"><?php echo $atts['email'][0];?></label>
		<input type="email" maxlength="<?php echo $atts['email'][1] ?>" name="email"/>
	</div>

	<div>
		<label for="budget"><?php echo $atts['budget'][0];?></label>
		<input type="number" maxlength="<?php echo $atts['budget'][1] ?>" name="budget"/>
	</div>

	<div>
		<label for="message"><?php echo $atts['message'][0];?></label>
		<textarea name="message" rows="<?php echo $atts['message'][1] ?>" cols="<?php echo $atts['message'][2] ?>"></textarea>
	</div>
	<div class="success" style="display: none;">
	</div>
	<div class="error" style="display: none;">
	</div>
	<div>
		<input type="hidden" name="date_time">
		<button class="button">Submit</button>
	</div>

</form>