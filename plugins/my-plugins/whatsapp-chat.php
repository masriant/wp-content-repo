<?php
/**
 * Plugin Name: WhatsApp Chat Integration
 * Description: A simple plugin to integrate WhatsApp chat into the site.
 * Version: 1.0
 * Author: Masrianto
 * Author URI: https://bimtekhub.com
 */

// Function to enqueue WhatsApp chat script
function enqueue_whatsapp_chat() {
    wp_enqueue_script('whatsapp-chat', get_stylesheet_directory_uri() . '/assets/whatsapp-chat-script.js', array(), null, true);
    wp_enqueue_style('whatsapp-chat-style', get_stylesheet_directory_uri() . '/assets/whatsapp-chat-style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_whatsapp_chat');

// Shortcode to display WhatsApp chat
function display_whatsapp_chat() {
    return '<div id="whatsapp-chat">Chat with us on WhatsApp!</div>'; // Placeholder for WhatsApp chat
}
add_shortcode('whatsapp_chat', 'display_whatsapp_chat');

// Admin notice for plugin usage
function whatsapp_chat_admin_notice() {
    echo '<div class="notice notice-info is-dismissible">
        <p><strong>WhatsApp Chat Plugin Activated:</strong> This plugin integrates WhatsApp chat into your site. Use the shortcode [whatsapp_chat] to display the chat widget.</p>
    </div>';
}
add_action('admin_notices', 'whatsapp_chat_admin_notice');
