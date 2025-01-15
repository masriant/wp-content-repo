<?php
/**
 * Plugin Name: My Custom Plugins
 * Description: A collection of custom plugins for the site.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Default image URL with width and height
$default_image = 'https://bimtekhub.com/wp-content/uploads/2025/01/logo-1-png.webp';
$default_image_width = '300'; // Set desired width
$default_image_height = '100'; // Set desired height

// Function to add Open Graph tags
function add_open_graph_tags() {
    if (is_single()) {
        global $post;
        global $default_image, $default_image_width, $default_image_height; // Access the default image variables

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: $default_image; // Use default image if none
        $url = get_permalink($post->ID);
        $site_name = get_bloginfo('name');
        $locale = get_locale();
        $published_time = get_the_date('c', $post->ID);
        $modified_time = get_the_modified_date('c', $post->ID);
        $author = get_the_author_meta('display_name', $post->post_author);

        // Limit title and description lengths
        $title = mb_substr($title, 0, 60);
        $description = mb_substr($description, 0, 140);

        // Get post tags
        $tags = get_the_tags($post->ID);
        $tag_names = [];
        if ($tags) {
            foreach ($tags as $tag) {
                $tag_names[] = esc_html($tag->name);
            }
        }
        $keywords = implode(', ', $tag_names);

        // Output Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
        echo '<meta property="og:locale" content="' . esc_attr($locale) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n"; // Added og:type
        echo '<meta property="article:author" content="' . esc_attr($author) . '">' . "\n"; // Automatically get author
        echo '<meta name="keywords" content="' . esc_attr($keywords) . '">' . "\n"; // Added keywords from tags
    }
}

// Function to add canonical tag
function add_canonical_tag() {
    if (is_single()) {
        global $post;
        $url = get_permalink($post->ID);
        echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    }
}

// Function to add Twitter meta tags
function add_twitter_meta_tags() {
    if (is_single()) {
        global $post;
        global $default_image, $default_image_width, $default_image_height; // Access the default image variables

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: $default_image; // Use default image if none
        $url = get_permalink($post->ID);

        // Limit title and description lengths
        $title = mb_substr($title, 0, 60);
        $description = mb_substr($description, 0, 140);

        // Output Twitter meta tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n"; // Added twitter:card
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta name="twitter:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta name="twitter:site" content="@bimtekhub">' . "\n"; // Added twitter:site
    }
}

// Function to add alt and title attributes to images
function add_image_alt_and_title($attr, $attachment) {
    // Check if alt attribute is empty
    if (!isset($attr['alt']) || empty($attr['alt'])) {
        $attr['alt'] = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        
        // If alt is still empty, use the image title
        if (empty($attr['alt'])) {
            $attr['alt'] = 'bimtekhub-' . $attachment->ID; // Set alt to "bimtekhub-*"
        }
    }

    // Check if title attribute is empty
    if (!isset($attr['title']) || empty($attr['title'])) {
        $attr['title'] = 'bimtekhub-' . $attachment->ID; // Set title to "bimtekhub-*"
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'add_image_alt_and_title', 10, 2);

add_action('wp_head', 'add_google_site_verification');
add_action('wp_head', 'add_robots_meta_tag');
add_action('wp_head', 'add_meta_tags');
add_action('wp_head', 'add_twitter_meta_tags');
