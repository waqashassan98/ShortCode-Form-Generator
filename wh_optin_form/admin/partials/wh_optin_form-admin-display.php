<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.linkedin.com/in/waqas-hassan98/
 * @since      1.0.0
 *
 * @package    Wh_optin_form
 * @subpackage Wh_optin_form/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h1>Dynamic Form Generation and Population</h1>

<div class="wh_panel_body">
	<strong>Usage:</strong>
	Use <code>[create_form]</code> for default options. If you want to over-ride certain fields refer to the format below. The fields which are not overridden, will take default values.
	<div class="instruction">
		<code>
			[create_form]
		</code>

		<code>
			[create_form full_name="Full Name|50"]
		</code>

		<code>
			[create_form full_name="Full Name|50" email="Email|100" phone="Phone Number|20" budget="Desired Budget|10" message="Message|3|150"]
		</code>
	</div>

	<div class="instruction">
		<strong>Format for <i>full_name, email, phone & budget</i></strong><br>
		{Field Name="Label|maxlength"}
	</div>

	<div class="instruction">
		<strong>Format for <i>message</i></strong><br>
		{Field Name="Label|rows|col"}
	</div>
</div>