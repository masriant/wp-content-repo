<?php
/**
 * Plugin Name: Robots.txt Generator
 * Description: Dynamically generates a robots.txt file.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Hook to 'robots_txt' filter to customize the robots.txt content
add_filter('robots_txt', 'custom_robots_txt', 10, 2);

function custom_robots_txt($output, $public) {
    $output .= "User-Agent: *\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n";
    $output .= "Disallow: /cgi-bin/\n";
    $output .= "Disallow: /scripts/\n";
    $output .= "Disallow: /tmp/\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n\n";

    $output .= "User-Agent: Googlebot\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /nogooglebot/\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n\n";

    $output .= "User-Agent: BingBot\n";
    $output .= "Disallow: /cgi-bin/\n";
    $output .= "Disallow: /scripts/\n";
    $output .= "Disallow: /tmp/\n";
    $output .= "Allow: /\n\n";

    $output .= "User-agent: Twitterbot\n";
    $output .= "Allow: /images\n";
    $output .= "Allow: /archives\n";
    $output .= "Disallow: *\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n\n";

    $output .= "User-agent: BadBot\n";
    $output .= "Disallow: /\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n\n";

    $output .= "User-agent: AhrefsSiteAudit\n";
    $output .= "Allow: /\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n\n";

    $output .= "User-agent: AhrefsBot\n";
    $output .= "Allow: /\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    $output .= "Allow: /wp-content/uploads/\n";
    $output .= "Allow: /public/\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /admin/\n";
    $output .= "Disallow: /login/\n";
    $output .= "Disallow: /register/\n";
    $output .= "Disallow: /private/\n";
    $output .= "Disallow: /*.pdf$\n";
    $output .= "Disallow: /*.doc$\n";
    $output .= "Disallow: /*.docx$\n";
    $output .= "Disallow: /*.xls$\n";
    $output .= "Disallow: /*.xlsx$\n";
    $output .= "Disallow: /search/\n";

    $output .= "Sitemap: https://bimtekhub.com/sitemap.xml\n";
}
?>
