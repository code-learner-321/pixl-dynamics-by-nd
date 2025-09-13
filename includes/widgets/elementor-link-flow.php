<?php

namespace Elementor_Addon_Pixl_Dynamics;

require_once plugin_dir_path(__FILE__) . '../nav-walker/class-custom-nav-walker.php';

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

require_once plugin_dir_path(__FILE__) . 'lf-animations/lf-animations.php';

use LFWidgets\Animations;

// animation controls
require_once plugin_dir_path(__DIR__) . '../controls/link-flow-controls/hover-animations/default-controls.php';

use Elementor_Addon_Pixl_Dynamics\LfControls;


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
    public function get_menus()
    {
        $menus = wp_get_nav_menus();

        $menu_list = [];

        foreach ($menus as $menu) {
            $menu_list[$menu->slug] = $menu->name;
        }

        return $menu_list;
    }
    public function get_default_slug()
    {
        $menu = $this->get_menus();

        return key($menu);
    }
    public function register_controls(): void
    {
        LfControls::menuSettings($this);

        LfControls::menu_styles($this);
        
        LfControls::lf_margin($this);

        LfControls::typography($this);

        LfControls::menu_background($this);

        LfControls::lfConditionalControls($this);
        
        LfControls::lfmobile_menu_settings($this);
    }

    protected function render(): void
    {
        $unique_id = uniqid('pixl-link-flow-');
?>
<div class="elementor-link-flow-wrapper">
    <?php

            $settings = $this->get_settings_for_display();

            $lf_alignment = isset($settings['lf_alignment']) ? esc_attr($settings['lf_alignment']) : 'right';
            $lf_menu_animations = isset($settings['lf_menu_animations']) ? esc_attr($settings['lf_menu_animations']) : 'none';

            $this->display_menu_id = $settings['menu'];
            $show_arrow = $settings['submenu_arrow_toggle'];

            // $lf_select_animation = new Animations();

            if ($lf_menu_animations == "top_underline") {
                // $lf_select_animation->render_underline_top($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_underline_top($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);                
            } elseif ($lf_menu_animations == "bottom_underline") {
                // $lf_select_animation->render_underline_below($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_underline_below($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "double_line") {
                // $lf_select_animation->render_double_line($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_double_line($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "default") {
                // $lf_select_animation->render_default($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_default($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } elseif ($lf_menu_animations == "frame_pulse") {
                // $lf_select_animation->render_frame_pulse($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_frame_pulse($settings, $this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            } else {
                // $lf_select_animation->render_default($this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
                Animations::render_default($this->display_menu_id, $lf_alignment, $show_arrow, $unique_id);
            }
            ?>
</div>
<?php
    }  /* ends render..*/
}