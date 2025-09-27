<?php
namespace Lf\LinkFlowControls\HoverAnimations\ConditionalControls;

    class LfConditionalControls{
        public static function topUnderlineBg($widget_top_underline_styles){
            $widget_top_underline_styles->start_controls_section(
            'menu-hover-bg',
            [
                'label' => __('Hover Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'top_underline',
                ],
            ]
        );
        $widget_top_underline_styles->add_control(
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
        $widget_top_underline_styles->end_controls_section();
        }
        public static function bottomUnderlineBg($widget_bottom_underline_styles){
            $widget_bottom_underline_styles->start_controls_section(
            'menu-hover-bg-bottom',
            [
                'label' => __('Hover Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'bottom_underline',
                ],
            ]
        );
        $widget_bottom_underline_styles->add_control(
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
        $widget_bottom_underline_styles->end_controls_section();
        }
        
        public static function hoverDoubleLine($widget_frame_pulse_style){
            $widget_frame_pulse_style->start_controls_section(
            'menu-hover-bg-double-line',
            [
                'label' => __('Hover Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );
        $widget_frame_pulse_style->add_control('group_heading_hoverBg', [
            'label' => esc_html__('Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_frame_pulse_style->add_control(
            'hover_double_line_bgcolor',
            [
                'label' => esc_html__('Background', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a5a5aff',
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );
        $widget_frame_pulse_style->add_control('group_heading_hover_text_arrow', [
            'label' => esc_html__('Text and Arrow Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_frame_pulse_style->add_control(
            'hover_double_line_text_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'condition' => [
                    'lf_menu_animations' => 'double_line',
                ],
            ]
        );
        $widget_frame_pulse_style->end_controls_section();
        }
        public static function hoverFramePulse($widget_frame_pulse_style){
            $widget_frame_pulse_style->start_controls_section(
            'menu-hover-bg-frame-pulse',
            [
                'label' => __('Hover Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'frame_pulse',
                ],
            ]
        );
        $widget_frame_pulse_style->add_control('group_heading_hoverFramePulseBg', [
            'label' => esc_html__('Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_frame_pulse_style->add_control(
            'hover_frame_pulse_bgcolor',
            [
                'label' => esc_html__('Background', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a5a5aff',
                'condition' => [
                    'lf_menu_animations' => 'frame_pulse',
                ],
            ]
        );
        $widget_frame_pulse_style->add_control('group_heading_hoverframepulse_text_arrow', [
            'label' => esc_html__('Text and Arrow Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $widget_frame_pulse_style->add_control(
            'hover_frame_pulse_text_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'condition' => [
                    'lf_menu_animations' => 'frame_pulse',
                ],
            ]
        );
        $widget_frame_pulse_style->end_controls_section();
        }
        public static function default_hover($widget_default_hover_style){
            $widget_default_hover_style->start_controls_section(
            'menu-hover-color',
            [
                'label' => __('Menu Link Hover Color', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'lf_menu_animations' => 'default',
                ],
            ]
        );
        $widget_default_hover_style->add_control(
            'lf_link_hover',
            [
                'label' => esc_html__('Enable Hover', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'plugin-name'),
                'label_off' => esc_html__('Hide', 'plugin-name'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $widget_default_hover_style->add_control('group_heading_hoverbgcolor', [
            'label' => esc_html__('Background Hover Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'lf_link_hover' => 'yes',
                'lf_menu_animations' => 'default',
            ],
        ]);
        $widget_default_hover_style->add_control(
            'link_hover_bg_color',
            [
                'label' => esc_html__('Background Hover Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#DDE1E6',
                'condition' => [
                    'lf_link_hover' => 'yes',
                    'lf_menu_animations' => 'default',
                ],
            ]
        );
        $widget_default_hover_style->add_control(
            'link_hover_bg_text',
            [
                'label' => esc_html__('Text On Hover', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#484848ff',
                'condition' => [
                    'lf_link_hover' => 'yes',
                    'lf_menu_animations' => 'default',
                ],
            ]
        );
        $widget_default_hover_style->end_controls_section();

        }
    }
?>