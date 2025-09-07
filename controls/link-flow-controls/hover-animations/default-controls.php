<?php

namespace Elementor_Addon_Pixl_Dynamics;

// animation controls
// require_once plugin_dir_path(__FILE__) . 'conditional-controls/conditional_controls.php';

// use Lf\LinkFlowControls\HoverAnimations\ConditionalControls\LfConditionalControls;

class LfControls
{

    public static function menuSettings($widget)
    {
        $widget->start_controls_section(
            'menu_selection',
            [
                'label' => __('Menu Settings', 'pixl-dynamics-by-nd'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $widget->add_control(
            'menu',
            [
                'label'   => __('Select Menu', 'pixl-dynamics-by-nd'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $widget->get_menus(),
                'default' => $widget->get_default_slug(),
                'label_block' => false,
            ]
        );
        $widget->add_control(
            'submenu_arrow_toggle',
            [
                'label' => esc_html__('Show Menu Arrow', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'plugin-name'),
                'label_off' => esc_html__('Hide', 'plugin-name'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        # Add a control to select menu animations
        $widget->add_control(
            'lf_menu_animations',
            [
                'label' => esc_html__('Select Menu Animations', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'plugin-name'),
                    'top_underline' => esc_html__('Top Underline', 'plugin-name'),
                    'bottom_underline' => esc_html__('Bottom Underline', 'plugin-name'),
                    'double_line' => esc_html__('Double Line', 'plugin-name'),
                    'frame_pulse' => esc_html__('Frame Pulse', 'plugin-name'),
                ],
                'default' => 'default',
            ]
        );
        $widget->end_controls_section();
    }
    public static function typography($widget_typography)
    {
        // typography for menu links...
        $widget_typography->start_controls_section(
            'section_style_typography',
            [
                'label' => __('Typography', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $widget_typography->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Menu Link', 'custom-elementor-widget'),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} nav.menu a.menu-link',
            ]
        );
        $widget_typography->end_controls_section();
        // typography for menu links...

    }
    public static function menu_styles($widget_menu_styles)
    {

        /*Style Section...*/
        $widget_menu_styles->start_controls_section(
            'section_style',
            [
                'label' => __('Menu Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $widget_menu_styles->add_control(
            'lf_alignment',
            [
                'label'   => __('Menu Alignment', 'plugin-domain'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left'  => __('Left', 'plugin-domain'),
                    'right' => __('Right', 'plugin-domain'),
                    'center' => __('Center', 'plugin-domain'),
                ],
                'default' => 'right',
            ]
        );
        // Padding control 
        $widget_menu_styles->add_control('group_heading_menu_padding', [
            'label' => esc_html__('Padding Between Links', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_menu_styles->add_responsive_control(
            'link_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );
        $widget_menu_styles->add_control('group_heading_menu_padding_submenu', [
            'label' => esc_html__('Submenu Padding Between Links', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_menu_styles->add_responsive_control(
            'lf_submenu_link_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );
        $widget_menu_styles->end_controls_section();
    }
    public static function menu_background($widget_menu_background)
    {
        $widget_menu_background->start_controls_section(
            'menu-bg',
            [
                'label' => __('Menu Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $widget_menu_background->add_control('group_heading_menu_bg', [
            'label' => esc_html__('Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_menu_background->add_control(
            'navbar_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f2f2ff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // nav bar text color
        $widget_menu_background->add_control(
            'nav_txt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#505050ff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu > ul > li > a' => 'color: {{VALUE}};','{{WRAPPER}} nav.menu > ul > li > label > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $widget_menu_background->add_control('group_heading_submenu_bg', [
            'label' => esc_html__('Sub Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_menu_background->add_control(
            'navbar_sub_menu_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f0f0f0ff',
                'selectors' => [
                    '{{WRAPPER}} .lf-sub-menu-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $widget_menu_background->add_control(
            'nav_subtxt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a5a5aff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu ul ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $widget_menu_background->end_controls_section();
    }
    public static function mobile_label_styles($widget_mobile_label_styles)
    {
        // Hover Top background color....
        $widget_mobile_label_styles->start_controls_section(
            'menu-hover-bg',
            [
                'label' => __('Hover Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'top_underline',
                ],
            ]
        );
        $widget_mobile_label_styles->add_control(
            'navbar_hover_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#747474',
                'condition' => [
                    'lf_menu_animations' => 'top_underline',
                ],
            ]
        );
        $widget_mobile_label_styles->end_controls_section();
        // Hover background color....

        // Hover Bottom background color....
        $widget_mobile_label_styles->start_controls_section(
            'menu-hover-bg-bottom',
            [
                'label' => __('Hover Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'bottom_underline',
                ],
            ]
        );
        $widget_mobile_label_styles->add_control(
            'navbar_hover_bg_color_bottom',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#747474',
                'condition' => [
                    'lf_menu_animations' => 'bottom_underline',
                ],
            ]
        );
        $widget_mobile_label_styles->end_controls_section();
        // Hover Bottom background color....

        $widget_mobile_label_styles->start_controls_section(
            'mobile_menu_label',
            [
                'label' => __('Mobile Label Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $widget_mobile_label_styles->add_control('group_heading_arrow', [
            'label' => esc_html__('Arrow Padding', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        //WORK AREA.. 
        $widget_mobile_label_styles->add_control(
            'lf_label_padding',
            [
                'label' => __('Padding (All Devices)', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
            ]
        );

        $widget_mobile_label_styles->add_control('group_heading_arrow_bg_color', [
            'label' => esc_html__('Arrow Label Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_mobile_label_styles->add_control(
            'menu_link_arrow_label_bg_color',
            [
                'label' => esc_html__('Arrow Label Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 0.3)',
            ]
        );

        $widget_mobile_label_styles->add_control('group_heading_arrow_size', [
            'label' => esc_html__('Arrow Size', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_mobile_label_styles->add_control(
            'lf_arrow_size',
            [
                'label' => __('Arrow Size', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
            ]
        );
        $widget_mobile_label_styles->add_control(
            'lf_hamburger_alignment',
            [
                'label' => __('Hamburger Alignment', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'plugin-name'),
                    'center' => __('Center', 'plugin-name'),
                    'right' => __('Right', 'plugin-name'),
                ],
            ]
        );
        $widget_mobile_label_styles->add_control('group_heading_link_padding', [
            'label' => esc_html__('Padding Between Links', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $widget_mobile_label_styles->add_control(
            'lf_link_padding_mobile',
            [
                'label' => __('Padding', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
            ]
        );

        $widget_mobile_label_styles->end_controls_section();
    }
}
