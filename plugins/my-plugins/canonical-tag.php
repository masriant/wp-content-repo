<?php
/**
 * Plugin Name: Canonical Tag
 * Description: Adds a canonical tag to the head section based on the current page.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

function add_canonical_tag() {
    if (is_single()) {
        global $post;
        $url = get_permalink($post->ID);
        echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    }
}
add_action('wp_head', 'add_canonical_tag');

// Admin notice for plugin usage
function canonical_tag_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Canonical Tag Plugin Activated:</strong> This plugin adds a canonical tag to the head section based on the current page.</p>
    </div>';
}
add_action('admin_notices', 'canonical_tag_admin_notice');
