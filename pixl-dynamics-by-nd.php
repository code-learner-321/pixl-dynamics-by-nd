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
 * Text Domain:       pixl-dynamics-by-nd
 * * Requires Plugins: elementor
 */

if (! defined('ABSPATH')) {
    exit;
}

// require_once plugin_dir_path(__FILE__) . 'includes/nav-walker/class-custom-nav-walker.php';
// add_action('init', function() {
//     require_once plugin_dir_path(__FILE__) . 'includes/nav-walker/class-custom-nav-walker.php';
// });

/* Add Elementor Widget Categorie called Pixl Dynamics By ND*/
function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'pixel-dynamics',
		[
			'title' => esc_html__( 'Pixl Dynamics By ND', 'pixl-dynamics-by-nd' ),
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
                esc_html__('Portfolio Card Flip requires %1$s to be installed and activated.', 'pixl-dynamics-by-nd'),
                '<strong>Elementor</strong>'
            );
            $html = sprintf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
            echo wp_kses_post($html);
        }
    });
    return;
}


function elementor_widget_pixl_dynamics_dependencies()
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
    
    wp_enqueue_script(
        'link-flow-script-js',
        plugins_url('assets/js/link-flow-script.js', __FILE__),
        ['jquery'],
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
    wp_enqueue_style(
        'widget-font-awsome-style',
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    );
    /* styles for link flow menu */
    wp_enqueue_style(
        'widget-link-flow-menu-style',
        plugins_url('assets/css/link-flow-menu-styles.css', __FILE__)
    );
}
add_action('wp_enqueue_scripts', 'elementor_widget_pixl_dynamics_dependencies');

add_action('elementor/frontend/after_enqueue_styles', 'elementor_widget_pixl_dynamics_dependencies');

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
    $order_type = isset($_POST['order_type']) ? sanitize_text_field($_POST['order_type']) : 'DESC';
    
    $args = [
        'post_type'      => 'portfolio_card',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => 'date',
        'order'          => $order_type
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

// Register Card Flip post type
function register_portfolio_card_post_type() {
    $labels = [
        'name'               => _x('Card Flip', 'post type general name', 'pixl-dynamics-by-nd'),
        'singular_name'      => _x('Card Flip', 'post type singular name', 'pixl-dynamics-by-nd'),
        'menu_name'          => _x('Card Flip', 'admin menu', 'pixl-dynamics-by-nd'),
        'name_admin_bar'     => _x('Card Flip', 'add new on admin bar', 'pixl-dynamics-by-nd'),
        'add_new'            => _x('Add New', 'Card Flip Slider', 'pixl-dynamics-by-nd'),
        'add_new_item'       => __('Add New Card Flip Slider', 'pixl-dynamics-by-nd'),
        'new_item'           => __('New Card Flip Slider', 'pixl-dynamics-by-nd'),
        'edit_item'          => __('Edit Card Flip Slider', 'pixl-dynamics-by-nd'),
        'view_item'          => __('View Card Flip Slider', 'pixl-dynamics-by-nd'),
        'all_items'          => __('All Card Flip', 'pixl-dynamics-by-nd'),
        'search_items'       => __('Search Card Flip', 'pixl-dynamics-by-nd'),
        'parent_item_colon'  => __('Parent Card Flip:', 'pixl-dynamics-by-nd'),
        'not_found'          => __('No Card Flip found.', 'pixl-dynamics-by-nd'),
        'not_found_in_trash' => __('No Card Flip found in Trash.', 'pixl-dynamics-by-nd')
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

// SLIDER TAXANOMY...
function create_card_slider_taxonomy()
{
    $labels = array(
        'name' => _x('Card Categories', 'Taxonomy General Name', 'pixl-dynamics-by-nd'),
        'singular_name' => _x('Slider Category', 'Taxonomy Singular Name', 'pixl-dynamics-by-nd'),
        'menu_name' => __('Card Categories', 'pixl-dynamics-by-nd'),
        'all_items' => __('All Categories', 'pixl-dynamics-by-nd'),
        'parent_item' => __('Parent Category', 'pixl-dynamics-by-nd'),
        'parent_item_colon' => __('Parent Category:', 'pixl-dynamics-by-nd'),
        'new_item_name' => __('New Category Name', 'pixl-dynamics-by-nd'),
        'add_new_item' => __('Add New Category', 'pixl-dynamics-by-nd'),
        'edit_item' => __('Edit Category', 'pixl-dynamics-by-nd'),
        'update_item' => __('Update Category', 'pixl-dynamics-by-nd'),
        'view_item' => __('View Category', 'pixl-dynamics-by-nd'),
        'separate_items_with_commas' => __('Separate categories with commas', 'pixl-dynamics-by-nd'),
        'add_or_remove_items' => __('Add or remove categories', 'pixl-dynamics-by-nd'),
        'choose_from_most_used' => __('Choose from the most used', 'pixl-dynamics-by-nd'),
        'popular_items' => __('Popular Categories', 'pixl-dynamics-by-nd'),
        'search_items' => __('Search Categories', 'pixl-dynamics-by-nd'),
        'not_found' => __('Not Found', 'pixl-dynamics-by-nd'),
        'no_terms' => __('No categories', 'pixl-dynamics-by-nd'),
        'items_list' => __('Categories list', 'pixl-dynamics-by-nd'),
        'items_list_navigation' => __('Categories list navigation', 'pixl-dynamics-by-nd'),
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

 /*SIngleton code starts..*/
 function elementor_card_addon() {
    require_once( __DIR__ . '/includes/plugin.php' );
    \Elementor_Addon_Pixl_Dynamics\Plugin::instance();
}
add_action( 'plugins_loaded', 'elementor_card_addon' );