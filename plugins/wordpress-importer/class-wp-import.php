<?php
/**
 * WordPress Importer class for managing the import process of a WXR file
 *
 * @package WordPress
 * @subpackage Importer
 */

/**
 * WordPress importer class.
 */
class WP_Import extends WP_Importer {
    public $max_wxr_version = 1.2; // max. supported WXR version

    public $id; // WXR attachment ID

    // information to import from WXR file
    public $version;
    public $authors    = array();
    public $posts      = array();
    public $terms      = array();
    public $categories = array();
    public $tags       = array();
    public $base_url   = '';

    // mappings from old information to new
    public $processed_authors    = array();
    public $author_mapping       = array();
    public $processed_terms      = array();
    public $processed_posts      = array();
    public $post_orphans         = array();
    public $processed_menu_items = array();
    public $menu_item_orphans    = array();
    public $missing_menu_items   = array();

    public $fetch_attachments = false;
    public $url_remap         = array();
    public $featured_images   = array();

    /**
     * Registered callback function for the WordPress Importer
     *
     * Manages the three separate stages of the WXR import process
     */
    public function dispatch() {
        $this->header();

        $step = empty( $_GET['step'] ) ? 0 : (int) $_GET['step'];
        switch ( $step ) {
            case 0:
                $this->greet();
                break;
            case 1:
                check_admin_referer( 'import-upload' );
                if ( $this->handle_upload() ) {
                    $this->import_options();
                }
                break;
            case 2:
                check_admin_referer( 'import-wordpress' );
                $this->fetch_attachments = ( ! empty( $_POST['fetch_attachments'] ) && $this->allow_fetch_attachments() );
                $this->id                = (int) $_POST['import_id'];
                $file                    = get_attached_file( $this->id );
                set_time_limit( 0 );
                $this->import( $file );
                break;
        }

        $this->footer();
    }

    /**
     * The main controller for the actual import stage.
     *
     * @param string $file Path to the WXR file for importing
     */
    public function import( $file ) {
        add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
        add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

        $this->import_start( $file );

        $this->get_author_mapping();

        wp_suspend_cache_invalidation( true );
        $this->process_categories();
        $this->process_tags();
        $this->process_terms();
        $this->process_posts();
        wp_suspend_cache_invalidation( false );

        // update incorrect/missing information in the DB
        $this->backfill_parents();
        $this->backfill_attachment_urls();
        $this->remap_featured_images();

        $this->import_end();
    }

    /**
     * Create new post tags based on import information
     *
     * Doesn't create a tag if its slug already exists
     */
    public function process_tags() {
        $this->tags = apply_filters('wp_import_tags', $this->tags);

        // Directly store the keywords if no tags are present
        if (empty($this->tags)) {
            $default_keywords = "Bimbingan Teknis, Bimtek, Diklat, Pelatihan, ASN, OPD, DPRD, Dana Desa";
            $this->tags[] = array(
                'tag_name' => $default_keywords,
                'tag_slug' => sanitize_title($default_keywords),
                'tag_description' => '',
            );
        }

        foreach ($this->tags as $tag) {
            // if the tag already exists leave it alone
            $term_id = term_exists($tag['tag_slug'], 'post_tag');
            if ($term_id) {
                if (is_array($term_id)) {
                    $term_id = $term_id['term_id'];
                }
                if (isset($tag['term_id'])) {
                    $this->processed_terms[intval($tag['term_id'])] = (int) $term_id;
                }
                continue;
            }

            $description = isset($tag['tag_description']) ? $tag['tag_description'] : '';
            $args = array(
                'slug' => $tag['tag_slug'],
                'description' => wp_slash($description),
            );

            $id = wp_insert_term(wp_slash($tag['tag_name']), 'post_tag', $args);
            if (!is_wp_error($id)) {
                if (isset($tag['term_id'])) {
                    $this->processed_terms[intval($tag['term_id'])] = $id['term_id'];
                }
            } else {
                printf(__('Failed to import post tag %s', 'wordpress-importer'), esc_html($tag['tag_name']));
                if (defined('IMPORT_DEBUG') && IMPORT_DEBUG) {
                    echo ': ' . $id->get_error_message();
                }
                echo '<br />';
                continue;
            }

            $this->process_termmeta($tag, $id['term_id']);
        }

        unset($this->tags);
    }

    // ... (rest of the class remains unchanged)
}
