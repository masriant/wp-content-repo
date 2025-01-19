<?php
/**
 * Plugin Name: Robots.txt Generator
 * Description: Dynamically generates a robots.txt file.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

function generate_robots_txt() {
    header('Content-Type: text/plain');
    echo "User-agent: *\n";
    echo "Disallow: /wp-admin/\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /private/\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "\n";
    echo "User-agent: Googlebot\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /nogooglebot/\n";
    echo "Allow: /\n";
    echo "\n";
    echo "User-agent: BadBot\n";
    echo "Disallow: /\n";
    echo "\n";
    echo "Sitemap: https://www.bimtekhub.com/sitemap.xml\n";
    echo "Sitemap: https://www.bimtekhub.com/sitemap.rss\n";
    echo "Sitemap: https://bimtekhub.com/sitemap_index.xml\n";
}

add_action('init', function() {
    if (isset($_GET['robots.txt'])) {
        generate_robots_txt();
        exit;
    }
});
