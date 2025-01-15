<?php
/**
 * Plugin Name: Google Site Verification
 * Description: Adds Google site verification meta tag to the head section.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Function to add Google site verification
function add_google_site_verification() {
    $verification_code = get_option('google_site_verification_code');
    if ($verification_code) {
        echo '<meta name="google-site-verification" content="' . esc_attr($verification_code) . '" />' . "\n";
    }
}
add_action('wp_head', 'add_google_site_verification');

// Admin notice for plugin usage
function google_site_verification_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>Google Site Verification Plugin Activated:</strong> Please enter your Google site verification code in the settings.</p>
    </div>';
}
add_action('admin_notices', 'google_site_verification_admin_notice');

// Add settings page
function google_site_verification_menu() {
    add_options_page('Google Site Verification', 'Google Site Verification', 'manage_options', 'google-site-verification', 'google_site_verification_settings_page');
}
add_action('admin_menu', 'google_site_verification_menu');

// Settings page content
function google_site_verification_settings_page() {
    ?>
    <div class="wrap">
        <h1>Google Site Verification</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('google_site_verification_options');
            do_settings_sections('google-site-verification');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Verification Code</th>
                    <td><input type="text" name="google_site_verification_code" value="<?php echo esc_attr(get_option('google_site_verification_code')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register settings
function google_site_verification_settings() {
    register_setting('google_site_verification_options', 'google_site_verification_code');
}
add_action('admin_init', 'google_site_verification_settings');
