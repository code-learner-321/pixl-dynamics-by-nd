<?php

namespace Elementor_Addon_Pixl_Dynamics;

// animation controls
require_once plugin_dir_path(__FILE__) . 'conditional-controls/conditional_controls.php';

use Lf\LinkFlowControls\HoverAnimations\ConditionalControls\LfConditionalControls;

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
    public static function lf_margin($widget_margin)
    {
        $widget_margin->start_controls_section(
            'section_margin',
            [
                'label' => __('Menu Margin', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget_margin->add_responsive_control(
            'menu_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '8',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .lf-pixl-nav-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget_margin->end_controls_section();
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
                'fields_options' => [
                    'font_size' => [
                        'default' => [
                            'size' => 16,
                            'unit' => 'px',
                        ],
                    ],
                ],

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
                    'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
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
                'default' => '#f8f9fa',
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
                'default' => '#505050',
                'selectors' => [
                    '{{WRAPPER}} nav.menu > ul > li > .menu-item-wrapper > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} nav.menu > ul > li > .menu-item-wrapper > label.submenu-toggle-label > a' => 'color: {{VALUE}};',
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
                'default' => '#e9ecef',
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
                'default' => '#505050',
                'selectors' => [
                    '{{WRAPPER}} nav.menu ul ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $widget_menu_background->end_controls_section();
    }
    public static function lfmobile_menu_settings($widget_mobile_label_styles)
    {
        $widget_mobile_label_styles->start_controls_section(
            'mobile_menu_label',
            [
                'label' => __('Mobile Menu Settings', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

        $widget_mobile_label_styles->add_control('group_heading_submenu_link_padding', [
            'label' => esc_html__('Submenu Padding', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $widget_mobile_label_styles->add_control(
            'lfsubmenu_link_padding',
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
        $widget_mobile_label_styles->add_control('group_heading_arrow', [
            'label' => esc_html__('Arrow Padding', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        //WORK AREA.. 

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
        $widget_mobile_label_styles->add_control('group_heading_hamburger_style', [
            'label' => esc_html__('Hamburger Icon', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]); 
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
       
        $widget_mobile_label_styles->add_control(
	'lf_hamburger_margin',
	[
		'label' => esc_html__( 'Hamburger Icon Margin', 'textdomain' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em', 'rem' ],
		'default' => [
			'top' => '0',
			'right' => '0',
			'bottom' => '0',
			'left' => '0',
			'isLinked' => false,
		],
		'selectors' => [
			'{{WRAPPER}} .lf-hamburger' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

        $widget_mobile_label_styles->end_controls_section();
    }
    public static function lfConditionalControls($widget_mobile_label_styles)
    {
        LfConditionalControls::topUnderlineBg($widget_mobile_label_styles);

        LfConditionalControls::bottomUnderlineBg($widget_mobile_label_styles);

        LfConditionalControls::hoverDoubleLine($widget_mobile_label_styles);

        LfConditionalControls::hoverFramePulse($widget_mobile_label_styles);
            
        LfConditionalControls::default_hover($widget_mobile_label_styles);

    }
}
