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

// Add Google site verification meta tag
function add_google_site_verification() {
    echo '<meta name="google-site-verification" content="av2rpSIYvX4gfgjThO7LgHUib4d-JfZTgwMo_3w_BME" />';
}

// Add robots meta tag
function add_robots_meta_tag() {
    echo '<meta name="robots" content="index, follow" />';
}

add_action('wp_head', 'add_google_site_verification');
add_action('wp_head', 'add_robots_meta_tag');
add_action('wp_enqueue_scripts', 'generatepress_child_enqueue_styles');
