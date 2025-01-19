<?php
/**
 * Plugin Name: Robots Meta Tag
 * Description: Adds a robots meta tag to the head section based on the current page.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Function to add robots meta tag
function add_robots_meta_tag() {
    echo '<meta name="robots" content="index, follow">' . "\n";
}
add_action('wp_head', 'add_robots_meta_tag');

// Admin notice for plugin usage
function robots_meta_tag_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Robots Meta Tag Plugin Activated:</strong> This plugin adds a robots meta tag to the head section based on the current page.</p>
    </div>';
}
add_action('admin_notices', 'robots_meta_tag_admin_notice');
