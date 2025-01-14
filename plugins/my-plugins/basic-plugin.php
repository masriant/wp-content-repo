<?php
/**
 * Plugin Name: Footer Credit and Meta Robots
 * Plugin URI: https://bimtekhub.com
 * Description: A simple plugin to display a footer credit message with the current year and site name, and to add meta robots tags.
 * Version: 1.0
 * Requires PHP: 7.0
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: footer-credit
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function display_footer_credit() {
    $current_year = date('Y');
    $site_name = get_bloginfo('name');
    echo '<p style="text-align: center;">© ' . $current_year . ' ' . $site_name . '</p>';
}
add_action('wp_footer', 'display_footer_credit');

function add_meta_robots_tag() {
    if (is_page('private-page')) {
        echo '<meta name="robots" content="noindex, nofollow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
}
add_action('wp_head', 'add_meta_robots_tag');
