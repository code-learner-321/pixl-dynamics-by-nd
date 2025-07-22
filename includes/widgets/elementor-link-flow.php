<?php

namespace Elementor_Addon_Pixl_Dynamics;

require_once plugin_dir_path(__FILE__) . '../nav-walker/class-custom-nav-walker.php';

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

require_once plugin_dir_path(__FILE__) . 'lf-animations/lf-animations.php';

use LFWidgets\Animations;


if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;

class Elementor_Link_Flow_Widget extends Widget_Base
{
    private $display_menu_id;
    public function get_script_depends(): array
    {
        return ['widget-link-flow-js', 'link-flow-script-js'];
    }

    public function get_style_depends(): array
    {
        return ['widget-link-flow-menu-style', 'widget-font-awsome-style'];
    }

    public function get_name(): string
    {
        return 'elementor-link-flow';
    }

    public function get_title(): string
    {
        return esc_html__('Link Flow', 'pixl-dynamics-by-nd');
    }

    public function get_icon(): string
    {
        return 'eicon-mega-menu';
    }

    public function get_categories(): array
    {
        return ['pixel-dynamics'];
    }

    public function get_keywords(): array
    {
        return ['nav', 'navigation', 'link', 'flow'];
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
    private function get_menus()
    {
        $menus = wp_get_nav_menus();

        $menu_list = [];

        foreach ($menus as $menu) {
            $menu_list[$menu->slug] = $menu->name;
        }

        return $menu_list;
    }
    private function get_default_slug()
    {
        $menu = $this->get_menus();

        return key($menu);
    }
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'menu_selection',
            [
                'label' => __('Menu Settings', 'pixl-dynamics-by-nd'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'menu',
            [
                'label'   => __('Select Menu', 'pixl-dynamics-by-nd'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => $this->get_menus(),
                'default' => $this->get_default_slug(),
                'label_block' => false,
            ]
        );



        $this->add_control(
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
        $this->add_control(
            'lf_menu_animations',
            [
                'label' => esc_html__('Select Menu Animations', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'top_underline' => esc_html__('Top Underline Animation', 'plugin-name'),
                    'bottom_underline' => esc_html__('Bottom Underline Animation', 'plugin-name'),
                    'slide_up_anim' => esc_html__('Slide Up Animation', 'plugin-name'),
                    'slide_down_anim' => esc_html__('Slide Down Animation', 'plugin-name'),
                ],
                'default' => 'none',
            ]
        );
        $this->end_controls_section();

        /*Style Section...*/
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Menu Styles', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
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
        $this->add_control('group_heading_menu_padding', [
            'label' => esc_html__('Padding Between Links', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_responsive_control(
            'link_padding',
            [
                'label' => esc_html__('Padding', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} nav.menu ul>li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'menu-bg',
            [
                'label' => __('Menu Background', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control('group_heading_menu_bg', [
            'label' => esc_html__('Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
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
        $this->add_control(
            'nav_txt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#505050ff',
                'selectors' => [
                    '{{WRAPPER}} nav.menu > ul > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control('group_heading_submenu_bg', [
            'label' => esc_html__('Sub Menu Background Color', 'plugin-name'),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control(
            'navbar_sub_menu_bg_color',
            [
                'label' => esc_html__('Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#e2e2e2ff',
                'selectors' => [
                    '{{WRAPPER}} .lf-sub-menu-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_subtxt_color',
            [
                'label' => esc_html__('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#5a5a5aff',
                'selectors' => [
                    '{{WRAPPER}} .menu-dropdown a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        // $this->start_controls_section(
        //     'mobile_only_view',
        //     [
        //         'label' => __('Mobile Only View', 'plugin-name'),
        //         'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        //     ]
        // );

        // $this->end_controls_section();
    }

    protected function render(): void
    {
?>
        <?php

        $settings = $this->get_settings_for_display();

        $lf_alignment = isset($settings['lf_alignment']) ? esc_attr($settings['lf_alignment']) : 'right';
        // $lf_menu_animations = isset($settings['lf_menu_animations']) ? esc_attr($settings['lf_menu_animations']) : 'none';

        $lf_sub_menu_bg = isset($settings['navbar_sub_menu_bg_color']) ? esc_attr($settings['navbar_sub_menu_bg_color']) : 'white';

        $this->display_menu_id = $settings['menu'];

        $show_arrow = $settings['submenu_arrow_toggle'];

        ?>
        <nav role='navigation' class="menu">
            <label for="menu">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" id="menu">
            <?php
            wp_nav_menu(array(
                'menu'          => $this->display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . $lf_alignment,
                'walker'        => new Custom_Nav_Walker(),
                'arrow_desktop' => $show_arrow,
                'fallback_cb'   => false,
            ));
            ?>
        </nav>
<?php
    }  /* ends render..*/
}
