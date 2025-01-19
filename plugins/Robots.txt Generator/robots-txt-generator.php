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

    // General rules for all user agents
    echo "User-agent: *\n";
    echo "Disallow: /wp-admin/\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /*.pdf$\n";
    echo "Disallow: /*.doc$\n";
    echo "Disallow: /*.docx$\n";
    echo "Disallow: /*.xls$\n";
    echo "Disallow: /*.xlsx$\n";
    echo "Disallow: /search/\n";
    echo "Disallow: /cgi-bin/\n";
    echo "Disallow: /scripts/\n";
    echo "Disallow: /tmp/\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "\n";

    // Specific rules for Googlebot
    echo "User-agent: Googlebot\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /nogooglebot/\n";
    echo "Disallow: /wp-admin/\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /*.pdf$\n";
    echo "Disallow: /*.doc$\n";
    echo "Disallow: /*.docx$\n";
    echo "Disallow: /*.xls$\n";
    echo "Disallow: /*.xlsx$\n";
    echo "Disallow: /search/\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "\n";

    // Rules for BingBot
    echo "User-Agent: BingBot\n";
    echo "Disallow: /cgi-bin/\n";
    echo "Disallow: /scripts/\n";
    echo "Disallow: /tmp/\n";
    echo "Allow: /\n";
    echo "\n";

    // Rules for Twitterbot
    echo "User-agent: Twitterbot\n";
    echo "Allow: /images\n";
    echo "Allow: /archives\n";
    echo "Disallow: *\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "Disallow: /wp-admin/\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /*.pdf$\n";
    echo "Disallow: /*.doc$\n";
    echo "Disallow: /*.docx$\n";
    echo "Disallow: /*.xls$\n";
    echo "Disallow: /*.xlsx$\n";
    echo "Disallow: /search/\n";
    echo "\n";

    // Rules for BadBot
    echo "User-agent: BadBot\n";
    echo "Disallow: /\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "\n";

    // Rules for Ahrefs
    echo "User-agent: AhrefsSiteAudit\n";
    echo "Allow: /\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "Disallow: /wp-admin/\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /*.pdf$\n";
    echo "Disallow: /*.doc$\n";
    echo "Disallow: /*.docx$\n";
    echo "Disallow: /*.xls$\n";
    echo "Disallow: /*.xlsx$\n";
    echo "Disallow: /search/\n";
    echo "\n";

    // Rules for AhrefsBot
    echo "User-agent: AhrefsBot\n";
    echo "Allow: /\n";
    echo "Allow: /wp-admin/admin-ajax.php\n";
    echo "Allow: /wp-content/uploads/\n";
    echo "Allow: /public/\n";
    echo "Disallow: /wp-admin/\n";
    echo "Disallow: /admin/\n";
    echo "Disallow: /login/\n";
    echo "Disallow: /register/\n";
    echo "Disallow: /private/\n";
    echo "Disallow: /*.pdf$\n";
    echo "Disallow: /*.doc$\n";
    echo "Disallow: /*.docx$\n";
    echo "Disallow: /*.xls$\n";
    echo "Disallow: /*.xlsx$\n";
    echo "Disallow: /search/\n";

    // Sitemap
    echo "Sitemap: https://bimtekhub.com/sitemap.xml\n";
   
}
?>
