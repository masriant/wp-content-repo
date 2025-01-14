<?php
/**
 * Plugin Name: Robots Meta Tag
 * Description: Adds a robots meta tag to the head section based on the current page.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

function add_robots_meta_tag() {
    if (is_page('private-page')) {
        echo '<meta name="robots" content="noindex, nofollow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
}

add_action('wp_head', 'add_robots_meta_tag');
