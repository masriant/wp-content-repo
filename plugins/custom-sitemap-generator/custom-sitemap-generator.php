<?php
/**
 * Plugin Name: Custom Sitemap Generator
 * Description: Membuat sitemap.xml secara otomatis untuk situs WordPress.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

 // Hook untuk menangani permintaan sitemap.xml
add_action('init', 'generate_custom_sitemap');

function generate_custom_sitemap() {
    if (isset($_GET['sitemap'])) {
        header('Content-Type: application/xml; charset=utf-8');
        echo build_sitemap();
        exit;
    }
}

function build_sitemap() {
    // Query untuk mendapatkan semua post dan halaman yang dipublikasikan
    $posts = get_posts(array(
        'post_type' => array('post', 'page'),
        'post_status' => 'publish',
        'numberposts' => -1
    ));

    // Mulai format XML untuk sitemap
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    foreach ($posts as $post) {
        setup_postdata($post);
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . get_permalink($post) . '</loc>';
        $sitemap .= '<lastmod>' . get_the_modified_date('Y-m-d', $post) . '</lastmod>';
        $sitemap .= '<changefreq>weekly</changefreq>';
        $sitemap .= '<priority>0.8</priority>';
        $sitemap .= '</url>';
    }

    wp_reset_postdata();

    $sitemap .= '</urlset>';

    return $sitemap;
}

// Tambahkan rewrite rule untuk menangani sitemap.xml
add_action('init', 'add_sitemap_rewrite_rule');
function add_sitemap_rewrite_rule() {
    add_rewrite_rule('sitemap\.xml$', 'index.php?sitemap=1', 'top');
}
?>
