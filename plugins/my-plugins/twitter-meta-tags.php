<?php
/**
 * Plugin Name: Twitter Meta Tags
 * Description: Adds Twitter meta tags to the head section for better sharing on Twitter.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

function add_twitter_meta_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: 'https://bimtekhub.com/wp-content/uploads/2025/01/logo-1-png.webp'; // Default image
        $url = get_permalink($post->ID);

        // Output Twitter meta tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta name="twitter:url" content="' . esc_url($url) . '">' . "\n";
    }
}
add_action('wp_head', 'add_twitter_meta_tags');

// Admin notice for plugin usage
function twitter_meta_tags_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Twitter Meta Tags Plugin Activated:</strong> This plugin adds Twitter meta tags for better sharing on Twitter.</p>
    </div>';
}
add_action('admin_notices', 'twitter_meta_tags_admin_notice');
