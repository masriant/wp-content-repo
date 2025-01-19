<?php
/**
 * GeneratePress Child Theme Functions
 */

// Add meta tags to the head section
function add_meta_tags() {
    echo '<meta charset="utf-8">' . "\n";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
}
add_action('wp_head', 'add_meta_tags', 5); // Set priority to 5

// Function to add meta description
function add_meta_description() {
    global $post;
    if (is_single()) {
        $description = get_the_excerpt($post->ID); // Get the post excerpt as the meta description
        if (empty($description)) {
            $description = "Portal Informasi Bimbingan Teknis Nasional, Pendidikan, Pelatihan Terupdate, Temukan Materi Bimtek Diklat OPD, ASN, DPRD, Dana Desa, Regulasi Pemerintah Terkini"; // Default description
        }
    } else {
        $description = "Portal Informasi Bimbingan Teknis Nasional, Pendidikan, Pelatihan Terupdate, Temukan Materi Bimtek Diklat OPD, ASN, DPRD, Dana Desa, Regulasi Pemerintah Terkini"; // Default description for other pages
    }
    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
}
add_action('wp_head', 'add_meta_description');

// Function to add meta keywords
function add_meta_keywords() {
    if (is_single()) {
        global $post;
        $tags = get_the_tags($post->ID);
        if ($tags) {
            $keywords = array();
            foreach ($tags as $tag) {
                $keywords[] = $tag->name; // Get the tag name
            }
            echo '<meta name="keywords" content="' . esc_attr(implode(', ', $keywords)) . '">' . "\n"; // Join tags into a string
        } else {
            echo '<meta name="keywords" content="default, keywords">' . "\n"; // Default keywords if no tags
        }
    } else {
        echo '<meta name="keywords" content="default, keywords">' . "\n"; // Default keywords for non-single pages
    }
}
add_action('wp_head', 'add_meta_keywords');

// Enqueue Font Awesome
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

// Enqueue Bootstrap CSS and JS
function enqueue_bootstrap() {
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

// Function to add Open Graph tags
function add_open_graph_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: 'https://bimtekhub.com/wp-content/uploads/2025/01/logo-1-png.webp'; // Default image
        $url = get_permalink($post->ID);
        $site_name = get_bloginfo('name');

        // Output Open Graph tags
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '">' . "\n";
    }
}
add_action('wp_head', 'add_open_graph_tags');

// Function to add canonical tag
function add_canonical_tag() {
    if (is_single()) {
        global $post;
        $url = get_permalink($post->ID);
        echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    }
}
add_action('wp_head', 'add_canonical_tag');

// Function to add Twitter meta tags
function add_twitter_meta_tags() {
    if (is_single()) {
        global $post;

        // Get post data
        $title = get_the_title($post->ID);
        $description = get_the_excerpt($post->ID);
        $image = get_the_post_thumbnail_url($post->ID, 'full') ?: 'https://bimtekhub.com/wp-content/uploads/2025/01/logo-1-png.webp'; // Default image
        $url = get_permalink($post->ID);

        // Output Twitter meta tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
        echo '<meta name="twitter:url" content="' . esc_url($url) . '">' . "\n";
    }
}
add_action('wp_head', 'add_twitter_meta_tags');

// Function to add alt and title attributes to images
function add_image_alt_and_title($attr, $attachment) {
    // Check if alt attribute is empty
    if (!isset($attr['alt']) || empty($attr['alt'])) {
        $attr['alt'] = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
        
        // If alt is still empty, use the image title
        if (empty($attr['alt'])) {
            $attr['alt'] = 'bimtekhub-' . $attachment->ID; // Set alt to "bimtekhub-*"
        }
    }

    // Check if title attribute is empty
    if (!isset($attr['title']) || empty($attr['title'])) {
        $attr['title'] = 'bimtekhub-' . $attachment->ID; // Set title to "bimtekhub-*"
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'add_image_alt_and_title', 10, 2);

// Function to add Google site verification
function add_google_site_verification() {
    echo '<meta name="google-site-verification" content="YOUR_VERIFICATION_CODE" />' . "\n";
}
add_action('wp_head', 'add_google_site_verification');
