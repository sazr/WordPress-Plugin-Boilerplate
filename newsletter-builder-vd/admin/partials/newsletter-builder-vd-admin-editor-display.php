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

	show_admin_bar( false );
	$nonce = wp_create_nonce('update_visual_design');
?>

<input class="vd-wp-input" id="vd-upload-nonce" type="hidden" vd-nonce="<?php $nonce ?>"/>

<div data-type='visual-designer'></div>
	
