<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function generatepress_child_enqueue_styles() {
    // Enqueue parent theme stylesheet
    wp_enqueue_style('generatepress-parent-style', get_template_directory_uri() . '/style.css');
    
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', array(), null, 'all');

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js', array(), null, true);
}

// Remove emoji scripts and styles
function disable_wp_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

function disable_emojis_tinymce($plugins) {
    return array_diff($plugins, array('wpemoji'));
}

add_action('init', 'disable_wp_emojis');

// Add Google site verification meta tag
function add_google_site_verification() {
    echo '<meta name="google-site-verification" content="av2rpSIYvX4gfgjThO7LgHUib4d-JfZTgwMo_3w_BME" />';
}

// Add robots meta tag
function add_robots_meta_tag() {
    echo '<meta name="robots" content="index, follow" />';
}

// Add Open Graph and Twitter meta tags
function add_meta_tags() {
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

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full');
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

// Function to change footer credit
function custom_footer_credit() {
    $year = date('Y'); // Get current year
    $site_name = get_bloginfo('name'); // Get site name
    echo '<div class="footer-credit">© ' . $year . ' ' . esc_html($site_name) . ' All Rights Reserved.</div>'; // Updated footer credit
}

add_action('wp_head', 'add_google_site_verification');
add_action('wp_head', 'add_robots_meta_tag');
add_action('wp_head', 'add_meta_tags');
add_action('wp_head', 'add_twitter_meta_tags');
add_action('generate_footer_credit', 'custom_footer_credit');
