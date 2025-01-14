<?php
/**
 * Plugin Name: My Custom Plugins
 * Description: A collection of custom plugins for the site.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Function to add Open Graph tags
function add_open_graph_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full');
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
        if (has_post_format('article')) {
            echo '<meta property="og:type" content="article" />' . "\n";
        }
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '" />' . "\n";
        }
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />' . "\n";
        echo '<meta property="og:locale" content="' . esc_attr($locale) . '" />' . "\n";
        echo '<meta property="article:published_time" content="' . esc_attr($published_time) . '" />' . "\n";
        echo '<meta property="article:modified_time" content="' . esc_attr($modified_time) . '" />' . "\n";
        echo '<meta property="article:author" content="' . esc_attr($author) . '" />' . "\n";
        echo '<meta name="keywords" content="' . esc_attr($keywords) . '" />' . "\n";
    }
}

// Function to add canonical tag
function add_canonical_tag() {
    if (is_single()) {
        global $post;
        $url = get_permalink($post->ID);
        echo '<link rel="canonical" href="' . esc_url($url) . '" />' . "\n";
    }
}

// Function to add Twitter meta tags
function add_twitter_meta_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full');
        $url = get_permalink($post->ID);

        // Limit title and description lengths
        $title = mb_substr($title, 0, 60);
        $description = mb_substr($description, 0, 140);

        // Output Twitter meta tags
        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n"; // Added twitter:card
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '" />' . "\n";
        echo '<meta name="twitter:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta name="twitter:site" content="@bimtekhub" />' . "\n"; // Added twitter:site
    }
}

add_action('wp_head', 'add_open_graph_tags');
add_action('wp_head', 'add_canonical_tag');
add_action('wp_head', 'add_twitter_meta_tags');
