<?php
/**
 * Plugin Name: Basic Plugin
 * Description: A simple plugin to display a footer credit message with the current year and site name.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Code for the basic plugin functionality
function display_footer_credit() {
    echo '<p>&copy; ' . date('Y') . ' BimtekHub. All rights reserved.</p>';
}
add_action('wp_footer', 'display_footer_credit');

// Admin notice for plugin usage
function basic_plugin_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Basic Plugin Activated:</strong> This plugin displays a footer credit message with the current year and site name.</p>
    </div>';
}
add_action('admin_notices', 'basic_plugin_admin_notice');
