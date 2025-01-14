<?php
/**
 * Plugin Name: Optimize Script, Styles, and Open Graph Metadata
 * Plugin URI: https://bimtekhub.com
 * Description: Plugin untuk mengoptimalkan atribut pada tag <script> dan <link rel="stylesheet">, menghapus trailing slash pada elemen void, menghapus CSS/JS yang tidak digunakan, dan menambahkan metadata Open Graph.
 * Version: 1.0
 * Requires PHP: 7.0
 * Requires at least: 5.0
 * Tested up to: 6.3
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: optimize-tags
 * Domain Path: /languages
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function add_meta_robots_tag() {
    if (is_page('private-page')) {
        echo '<meta name="robots" content="noindex, nofollow">';
    } else {
        echo '<meta name="robots" content="index, follow">';
    }
}
add_action('wp_head', 'add_meta_robots_tag');

function add_advanced_open_graph_metadata() {
    if (is_singular()) {
        global $post;

        // Ambil data dasar postingan
        $site_name = get_bloginfo('name'); // Nama situs, misalnya BIMTEKHUB
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID); // Mengambil excerpt sebagai deskripsi
        $url = get_permalink($post->ID);
        $image = has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, 'full') : ''; // Gambar unggulan
        $publisher = get_bloginfo('url'); // URL penerbit
        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized'; // Mengambil kategori pertama
        $tags = get_the_tags($post->ID);
        $tag_names = [];
        if ($tags) {
            foreach ($tags as $tag) {
                $tag_names[] = $tag->name;
            }
        }
        $tags_string = implode(', ', $tag_names); // Menggabungkan tag menjadi satu string

        // Open Graph Tags
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        }
        echo '<meta property="article:publisher" content="' . esc_url($publisher) . '">' . "\n";
        echo '<meta property="article:section" content="' . esc_attr($category_name) . '">' . "\n";
        echo '<meta property="article:keywords" content="' . esc_attr($tags_string) . '">' . "\n";
        echo '<meta property="article:tag" content="' . esc_attr($tags_string) . '">' . "\n";

        // Twitter Tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:site" content="@bimtekhub">' . "\n";

        // Meta Description (SEO)
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}
add_action('wp_head', 'add_advanced_open_graph_metadata');
