<?php
/*
 * Plugin Name:       Pixl Dynamics By ND
 * Description:       A Simple Elementor Portfolio Gallery Plugin With Card Flip Effect.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Najubudeen
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       portfolio-card-flipping
 * * Requires Plugins: elementor
 */

if (! defined('ABSPATH')) {
    exit;
}

/* Add Elementor Widget Categorie called Pixl Dynamics By ND*/
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'pixel-dynamics',
		[
			'title' => esc_html__( 'Pixl Dynamics By ND', 'textdomain' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

// Ensure Elementor is active
if (!did_action('elementor/loaded')) {
    add_action('admin_notices', function() {
        if (!is_plugin_active('elementor/elementor.php')) {
            $message = sprintf(
                esc_html__('Portfolio Card Flip requires %1$s to be installed and activated.', 'portfolio-card-flipping'),
                '<strong>Elementor</strong>'
            );
            $html = sprintf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
            echo wp_kses_post($html);
        }
    });
    return;
}

function create_portfolio_card_flip_gallery()
{

    $labels = array(
        'name' => _x('Portfolio Image Card Gallery', 'Post Type General Name', 'portfolio-card-flipping'),
        'singular_name' => _x('Portfolio Image Card Gallery', 'Post Type Singular Name', 'portfolio-card-flipping'),
        'menu_name' => _x('Portfolio Card Gallery', 'Admin Menu text', 'portfolio-card-flipping'),
        'name_admin_bar' => _x('Portfolio Image Card Gallery', 'Add New on Toolbar', 'portfolio-card-flipping'),
        'add_new' => __('Add New', 'portfolio-card-flipping'),
        'add_new_item' => __('Add New Image Slider', 'portfolio-card-flipping'),
        'new_item' => __('New Image Slider', 'portfolio-card-flipping'),
        'edit_item' => __('Edit Image Slider', 'portfolio-card-flipping'),
        'view_item' => __('View Image Slider', 'portfolio-card-flipping'),
        'all_items' => __('All Image Slider', 'portfolio-card-flipping'),
        'search_items' => __('Search Image Slider', 'portfolio-card-flipping'),
        'parent_item_colon' => __('Parent Image Slider:', 'portfolio-card-flipping'),
        'not_found' => __('No image slider found.', 'portfolio-card-flipping'),
        'not_found_in_trash' => __('No image slider found in Trash.', 'portfolio-card-flipping'),
        'featured_image' => _x('Slider Image', 'Overrides the "Featured Image" phrase for this post type.', 'portfolio-card-flipping'),
        'set_featured_image' => _x('Set slider image', 'Overrides the "Set featured image" phrase for this post type.', 'portfolio-card-flipping'),
        'remove_featured_image' => _x('Remove slider image', 'Overrides the "Remove featured image" phrase for this post type.', 'portfolio-card-flipping'),
        'use_featured_image' => _x('Use as slider image', 'Overrides the "Use as featured image" phrase for this post type.', 'portfolio-card-flipping'),
        'archives' => _x('Image Slider Archives', 'The post type archive label used in nav menus.', 'portfolio-card-flipping'),
        'insert_into_item' => _x('Insert into image slider', 'Overrides the "Insert into post" phrase for this post type.', 'portfolio-card-flipping'),
        'uploaded_to_this_item' => _x('Uploaded to this image slider', 'Overrides the "Uploaded to this post" phrase for this post type.', 'portfolio-card-flipping'),
        'filter_items_list' => _x('Filter image slides list', 'Screen reader text for the filter links heading.', 'portfolio-card-flipping'),
        'items_list_navigation' => _x('Image slider list navigation', 'Screen reader text for the pagination heading.', 'portfolio-card-flipping'),
        'items_list' => _x('Image slider list', 'Screen reader text for the items list heading.', 'portfolio-card-flipping'),
    );

    $args = array(
        'label' => __('Portfolio Image Card Gallery', 'portfolio-card-flipping'),
        'description' => __('A custom post type for image slider', 'portfolio-card-flipping'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail','page-attributes'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-grid-view',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );

    register_post_type('portfolio_card', $args);
}

add_action('init', 'create_portfolio_card_flip_gallery', 0);

// SLIDER TAXANOMY...
function create_card_slider_taxonomy()
{
    $labels = array(
        'name' => _x('Card Categories', 'Taxonomy General Name', 'portfolio-card-flipping'),
        'singular_name' => _x('Slider Category', 'Taxonomy Singular Name', 'portfolio-card-flipping'),
        'menu_name' => __('Card Categories', 'portfolio-card-flipping'),
        'all_items' => __('All Categories', 'portfolio-card-flipping'),
        'parent_item' => __('Parent Category', 'portfolio-card-flipping'),
        'parent_item_colon' => __('Parent Category:', 'portfolio-card-flipping'),
        'new_item_name' => __('New Category Name', 'portfolio-card-flipping'),
        'add_new_item' => __('Add New Category', 'portfolio-card-flipping'),
        'edit_item' => __('Edit Category', 'portfolio-card-flipping'),
        'update_item' => __('Update Category', 'portfolio-card-flipping'),
        'view_item' => __('View Category', 'portfolio-card-flipping'),
        'separate_items_with_commas' => __('Separate categories with commas', 'portfolio-card-flipping'),
        'add_or_remove_items' => __('Add or remove categories', 'portfolio-card-flipping'),
        'choose_from_most_used' => __('Choose from the most used', 'portfolio-card-flipping'),
        'popular_items' => __('Popular Categories', 'portfolio-card-flipping'),
        'search_items' => __('Search Categories', 'portfolio-card-flipping'),
        'not_found' => __('Not Found', 'portfolio-card-flipping'),
        'no_terms' => __('No categories', 'portfolio-card-flipping'),
        'items_list' => __('Categories list', 'portfolio-card-flipping'),
        'items_list_navigation' => __('Categories list navigation', 'portfolio-card-flipping'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
    );
    register_taxonomy('card_slider_category', array('portfolio_card'), $args);
}
add_action('init', 'create_card_slider_taxonomy', 0);
// SLIDER TAXANOMY ENDS...

function elementor_widget_flip_card_dependencies()
{
    if (is_admin()) {
        return;
    }

    wp_enqueue_script(
        'widget-flip-card-js',
        plugins_url('assets/js/flip-card.js', __FILE__),
        ['jquery', 'elementor-frontend'],
        null,
        true
    );
    
    // js for pagenation
    wp_enqueue_script(
        'widget-card-pagenation-js',
        plugins_url('assets/js/widget-pagenation.js', __FILE__),
        ['jquery', 'elementor-frontend'],
        null,
        true
    );

    // Localize the script with new data
    wp_localize_script('widget-card-pagenation-js', 'portfolioCardAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('portfolio_card_pagination_nonce')
    ));

    wp_enqueue_style(
        'widget-flip-card-style',
        plugins_url('assets/css/flip-card-style.css', __FILE__)
    );
}
add_action('wp_enqueue_scripts', 'elementor_widget_flip_card_dependencies');

add_action('elementor/frontend/after_enqueue_styles', 'elementor_widget_flip_card_dependencies');

// Update the AJAX handler to return the complete HTML structure
function handle_load_more_cards() {
    
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'portfolio_card_pagination_nonce')) {
        error_log('Nonce verification failed');
        error_log('Received nonce: ' . (isset($_POST['nonce']) ? $_POST['nonce'] : 'not set'));
        wp_send_json_error('Invalid nonce');
        return;
    }

    $page = isset($_POST['page']) ? max(1, intval($_POST['page'])) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 2;
    
    $args = [
        'post_type'      => 'portfolio_card',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ];

    error_log('WP_Query args: ' . print_r($args, true));
    $query = new WP_Query($args);
    error_log('Found ' . $query->found_posts . ' posts');
    error_log('Max pages: ' . $query->max_num_pages);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="gallery">';
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $title = get_the_title();
            $thumbnail = get_the_post_thumbnail($post_id, 'medium');
            $categories = get_the_terms($post_id, 'card_slider_category');

            echo '<a href="' . get_permalink() . '" class="card">
                <div class="card-inner">
                    <div class="card-front">
                        ' . $thumbnail . '
                    </div>
                    <div class="card-back">
                        <h3>' . $title . '</h3>';
            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    echo '<p>' . esc_html($category->name) . '</p>';
                }
            }
            echo '</div>
                </div>
              </a>';
        }
        echo '</div>';
    }

    wp_reset_postdata();

    $html = ob_get_clean();

    wp_send_json_success([
        'html' => $html,
        'page' => $page,
        'max_pages' => $query->max_num_pages
    ]);
}
add_action('wp_ajax_load_more_cards', 'handle_load_more_cards');
add_action('wp_ajax_nopriv_load_more_cards', 'handle_load_more_cards');

// Register Portfolio Card post type
function register_portfolio_card_post_type() {
    $labels = [
        'name'               => _x('Portfolio Cards', 'post type general name', 'portfolio-card-flipping'),
        'singular_name'      => _x('Portfolio Card', 'post type singular name', 'portfolio-card-flipping'),
        'menu_name'          => _x('Portfolio Cards', 'admin menu', 'portfolio-card-flipping'),
        'name_admin_bar'     => _x('Portfolio Card', 'add new on admin bar', 'portfolio-card-flipping'),
        'add_new'            => _x('Add New', 'portfolio card', 'portfolio-card-flipping'),
        'add_new_item'       => __('Add New Portfolio Card', 'portfolio-card-flipping'),
        'new_item'           => __('New Portfolio Card', 'portfolio-card-flipping'),
        'edit_item'          => __('Edit Portfolio Card', 'portfolio-card-flipping'),
        'view_item'          => __('View Portfolio Card', 'portfolio-card-flipping'),
        'all_items'          => __('All Portfolio Cards', 'portfolio-card-flipping'),
        'search_items'       => __('Search Portfolio Cards', 'portfolio-card-flipping'),
        'parent_item_colon'  => __('Parent Portfolio Cards:', 'portfolio-card-flipping'),
        'not_found'          => __('No portfolio cards found.', 'portfolio-card-flipping'),
        'not_found_in_trash' => __('No portfolio cards found in Trash.', 'portfolio-card-flipping')
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'portfolio_card'],
        'capability_type'    => 'post',
        'has_archive'        => true, // Enable archive support
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => ['title', 'editor', 'thumbnail'],
        'menu_icon'          => 'dashicons-grid-view'
    ];

    register_post_type('portfolio_card', $args);
}
add_action('init', 'register_portfolio_card_post_type');


 /*SIngleton code starts..*/
 function elementor_card_addon() {
    require_once( __DIR__ . '/includes/plugin.php' );
    \Elementor_Addon_Flip_Card\Plugin::instance();
}
add_action( 'plugins_loaded', 'elementor_card_addon' );