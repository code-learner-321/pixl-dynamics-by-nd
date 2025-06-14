<?php

namespace Elementor_Addon_Flip_Card;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;

class Elementor_Gallery_Card_Widget extends Widget_Base
{

    public function get_script_depends(): array
    {
        return ['widget-flip-card-js', 'widget-card-pagenation-js'];
    }

    public function get_style_depends(): array
    {
        return ['widget-flip-card-style'];
    }

    public function get_name(): string
    {
        return 'elementor-gallery-flip-card';
    }

    public function get_title(): string
    {
        return esc_html__('Gallery Flip Card', 'elementor-gallery-flip-card-widget');
    }

    public function get_icon(): string
    {
        return 'eicon-ehp-cta';
    }

    public function get_categories(): array
    {
        return ['pixel-dynamics'];
    }

    public function get_keywords(): array
    {
        return ['flipcard', 'card', 'porfolio'];
    }

    public function get_custom_help_url(): string
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    public function has_widget_inner_wrapper(): bool
    {
        return false;
    }

    protected function is_dynamic_content(): bool
    {
        return false;
    }

    protected function register_controls(): void
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Projects To Display', 'elementor-gallery-flip-card-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Projects Per Page', 'elementor-gallery-flip-card-widget'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 20,
                'step' => 1,
                'default' => 2,
            ]
        );

        $this->add_control(
            'paged',
            [
                'label' => esc_html__('Current Page', 'elementor-gallery-flip-card-widget'),
                'type' => \Elementor\Controls_Manager::HIDDEN,
                'default' => 1,
            ]
        );

        // Order Control
        $this->add_control(
            'order_type',
            [
                'label'   => __('Order Type', 'plugin-domain'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => __('Ascending (ASE)', 'plugin-domain'),
                    'DESC' => __('Descending (DSE)', 'plugin-domain'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Card Border Radius', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--card-border-radius: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .card-front, {{WRAPPER}} .card-back' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hover_effects',
            [
                'label' => esc_html__('Hover Effects', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'hover_effect',
            [
                'label'   => esc_html__('Select Hover Effect', 'plugin-name'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'vertical-flip'         => esc_html__('Vertical Flip', 'plugin-name'),
                    'inverse-vertical-flip' => esc_html__('Inverse Vertical Flip', 'plugin-name'),
                    'horizontal-flip'       => esc_html__('Horizontal Flip', 'plugin-name'),
                    'inverse-horizontal-flip' => esc_html__('Inverse Horizontal Flip', 'plugin-name'),
                ],
                'default' => 'vertical-flip',
                'prefix_class' => 'elementor-gallery-flip-card-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        // Image Effects Section
        $this->start_controls_section(
            'section_image_effects',
            [
                'label' => esc_html__('Image Effects', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'enable_reflection',
            [
                'label' => esc_html__('Enable Image Reflection', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'plugin-name'),
                'label_off' => esc_html__('No', 'plugin-name'),
                'return_value' => 'yes',
                'default' => 'no',
                'prefix_class' => 'elementor-gallery-flip-card-reflection-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'reflection_opacity',
            [
                'label' => esc_html__('Reflection Opacity', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-gallery-flip-card-reflection-yes .card-front' => '--reflection-opacity: {{SIZE}}%;',
                ],
                'condition' => [
                    'enable_reflection' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_card_dimensions',
            [
                'label' => esc_html__('Card Dimensions', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_width',
            [
                'label' => __('Card Width', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'tablet_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'mobile_default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery' => 'grid-template-columns: repeat(auto-fill, minmax({{SIZE}}{{UNIT}}, 1fr)) !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_height',
            [
                'label' => __('Card Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 1,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'columns_gap',
            [
                'label' => __('Columns Gap', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .gallery' => 'gap: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'card_front_style',
            [
                'label' => __('Card Background ( Back Side )', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'card_back_color',
            [
                'label' => __('Background Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.7)',
                'selectors' => [
                    '{{WRAPPER}}' => '--card-back-bg: {{VALUE}};',
                ],
            ]
        );

        // Add a divider for better organization
        $this->add_control(
            'card_back_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        // Add a note about the background color
        $this->add_control(
            'card_back_style_note',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => __('The background color will be applied to the back of the card.', 'plugin-name'),
                'content_classes' => 'elementor-descriptor',
            ]
        );
        $this->end_controls_section();

        // Card Back Styles starts....
        $this->start_controls_section(
            'section_card_back',
            [
                'label' => __('Card Text Styles ( Back Side )', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card-back h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_font_size',
            [
                'label' => __('Heading Font Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 28,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-back h3' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'paragraph_color',
            [
                'label' => __('Category Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .card-back p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'paragraph_font_size',
            [
                'label' => __('Category Font Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'mobile_default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .card-back p' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
        // Card Back Styles ends here...

        // Add Pagination Style Section
        $this->start_controls_section(
            'section_pagination_style',
            [
                'label' => __('Pagination Style', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => __('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-gallery-flip-card-container .pagination-links' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'top' => '30',
                    'right' => '0',
                    'bottom' => '30',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-gallery-flip-card-container .pagination-links' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_link_padding',
            [
                'label' => __('Link Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-gallery-flip-card-container .pagination-links .page-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'default' => [
                    'top' => '8',
                    'right' => '16',
                    'bottom' => '8',
                    'left' => '16',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_gap',
            [
                'label' => __('Gap Between Links', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-gallery-flip-card-container .pagination-links' => 'gap: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void
    {
        $settings = $this->get_settings_for_display();
        $selected_effect = esc_attr($settings['hover_effect']); // Ensure safe output
        $posts_per_page = isset($settings['posts_per_page']) ? intval($settings['posts_per_page']) : 2;

        /*ORDER TYPE*/
        $order_type = isset($settings['order_type']) ? esc_attr($settings['order_type']) : 'DESC'; // Get selected order type


        // Get current page
        $paged = max(1, get_query_var('paged'));

        $args = [
            'post_type'      => 'portfolio_card',
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => $order_type,
        ];

        $query = new \WP_Query($args);


        if ($query->have_posts()) {
            echo '<div class="elementor-widget-container elementor-gallery-flip-card ' . $selected_effect . '" data-effect="' . $selected_effect . '">';
            echo '<div class="elementor-gallery-flip-card-container" data-posts-per-page="' . esc_attr($posts_per_page) . '" data-order-type="' . esc_attr($order_type) . '">';
            echo '<div class="gallery-container">';
            echo '<div class="gallery">';

            while ($query->have_posts()) {
                $query->the_post();
                $post_id    = get_the_ID();
                $title      = get_the_title();
                $thumbnail  = get_the_post_thumbnail($post_id, 'full', ['class' => 'card-image']);
                $categories = get_the_terms($post_id, 'card_slider_category');
                $post_link  = get_permalink($post_id);

                echo '<div class="elementor-widget-container">';
                echo '<a href="' . esc_url($post_link) . '" class="card" data-effect="' . $selected_effect . '">';
                echo '  <div class="card-inner">';
                echo '      <div class="card-front">';
                if (has_post_thumbnail($post_id)) {
                    echo $thumbnail;
                } else {
                    echo '<img src="' . esc_url(plugins_url('assets/images/placeholder.jpg', dirname(__FILE__))) . '" alt="' . esc_attr($title) . '" class="card-image">';
                }
                echo '</div>';
                echo '      <div class="card-back">';
                echo '<h3>' . esc_html($title) . '</h3>';

                if (!empty($categories) && !is_wp_error($categories)) {
                    foreach ($categories as $category) {
                        echo '<p>' . esc_html($category->name) . '</p>';
                    }
                }

                echo '      </div>'; // Close .card-back
                echo '  </div>'; // Close .card-inner
                echo '</a>';
                echo '</div>';
            }

            echo '</div>'; // End .gallery

            if ($query->max_num_pages > 1) {
                echo '<div class="pagination-links">';

                // Previous button
                if ($paged > 1) {
                    echo '<a href="#" data-page="' . ($paged - 1) . '" class="page-number prev">&laquo; Previous</a>';
                }

                // Page numbers
                for ($i = 1; $i <= $query->max_num_pages; $i++) {
                    $class = ($i === $paged) ? 'current' : '';
                    echo '<a href="#" data-page="' . $i . '" class="page-number ' . $class . '">' . $i . '</a>';
                }

                // Next button
                if ($paged < $query->max_num_pages) {
                    echo '<a href="#" data-page="' . ($paged + 1) . '" class="page-number next">Next &raquo;</a>';
                }

                echo '</div>'; // End .pagination-links
            }

            echo '</div>'; // End .gallery-container
            echo '</div>'; // End .elementor-gallery-flip-card-container
            echo '</div>'; // End .elementor-widget-container

            wp_reset_postdata();
        } else {
            echo '<p>No portfolio cards found.</p>';
        }
    }
}
