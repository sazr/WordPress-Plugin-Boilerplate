<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Newsletter_Builder_vD
 * @subpackage Newsletter_Builder_vD/admin/partials
 */

	$nonce = wp_create_nonce('send_email_campaign');
?>

<div class="vd-bootstrap">
	<div class="vd-row">
		<div class="newsletter-container vd-col-md-6 vd-col-sm-12">
			<input type="" name="">
		</div>
		<div class="newsletter-container vd-col-md-6 vd-col-sm-12">
			<textarea></textarea>
		</div>
	</div>

	<div class="vd-row">
		<div class="newsletter-container vd-col-xs-12">
			<iframe id='vd-platform-view' src='/wp-admin/admin.php?page=newsletter-builder-vd-editor' style="width: 100%; height: 100%; min-height: 1000px;"></iframe>
		</div>
	</div>
</div>

