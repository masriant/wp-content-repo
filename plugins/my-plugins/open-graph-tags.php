<?php
/**
 * Plugin Name: Open Graph Tags
 * Description: Adds Open Graph tags to the head section for better social media sharing.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

function add_open_graph_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: 'https://bimtekhub.com/wp-content/uploads/2025/01/logo-1-png.webp'; // Default image
        $url = get_permalink($post->ID);
        $site_name = get_bloginfo('name');

        // Output Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    }
}
add_action('wp_head', 'add_open_graph_tags');

// Admin notice for plugin usage
function open_graph_tags_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Open Graph Tags Plugin Activated:</strong> This plugin adds Open Graph tags for better social media sharing.</p>
    </div>';
}
add_action('admin_notices', 'open_graph_tags_admin_notice');
