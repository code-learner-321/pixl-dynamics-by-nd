<?php

namespace LFWidgets;

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

class Animations
{

    public function render_underline_top($display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-' . $unique_class_css;
?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::before {
                    content: "";
                    display: block;
                    background-color: #000000;
                    height: 2px;
                    left: 0;
                    top: 0;
                    transform: scale(0, 1);
                    transition: transform ease-in-out 250ms;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::before {
                    transform: scale(1, 1);
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.menu-dropdown {
                    display: none;
                }

                /* Submenu dropdown display for all levels */
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                /* Arrow rotation for all submenu levels */
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-arrow {
                    transform: rotate(0deg);
                    transition: transform 0.3s;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow {
                    transform: rotate(180deg);
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle,
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle-label {
                    display: inline-block;
                    cursor: pointer;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle-label {
                    margin-left: 8px;
                }

            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_underline_below($display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-below-' . $unique_class_css;
    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::after {
                    content: "";
                    display: block;
                    background-color: #000000;
                    width: 100%;
                    height: 2px;
                    left: 0;
                    bottom: 0;
                    transform: scale(0, 1);
                    transition: transform ease-in-out 250ms;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::after {
                    transform: scale(1, 1);
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                }

                /* Submenu dropdown display for all levels */
                .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                /* Arrow rotation for all submenu levels */
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-arrow {
                    transform: rotate(0deg);
                    transition: transform 0.3s;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow {
                    transform: rotate(180deg);
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle,
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle-label {
                    display: inline-block;
                    cursor: pointer;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle-label {
                    margin-left: 8px;
                }
            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_double_line($display_menu_id, $lf_alignment, $show_arrow, $menu_link_text_color = '#ffffff', $menu_link_arrow_double_line_color = '#3a3a3aff', $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;
    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                    z-index: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>a {
                    text-decoration: none;
                    transition: 1s;
                    position: relative;
                    z-index: 2;
                    pointer-events: auto;
                    color: <?php echo esc_attr($menu_link_text_color);
                            ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::before {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    border-top: 1px solid rgb(0, 0, 0);
                    border-bottom: 1px solid rgb(0, 0, 0);
                    transform: scaleY(2);
                    opacity: 0;
                    transition: .5s;
                    z-index: -1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::before {
                    transform: scaleY(1.2);
                    opacity: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li::after {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: <?php echo esc_attr($menu_link_arrow_double_line_color);
                                        ?>;
                    top: 1px;
                    left: 0;
                    transform: scale(0);
                    opacity: 0;
                    transition: .5s;
                    z-index: -1;
                    pointer-events: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li:hover::after {
                    transform: scale(1);
                    opacity: 1;
                }
            }

            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>ul>li a {
                    display: flex;
                    justify-content: space-between;
                    color: <?php echo esc_attr($menu_link_text_color);
                            ?>;
                }

                /* Submenu dropdown display for all levels */
                .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                /* Arrow rotation for all submenu levels */
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-arrow {
                    transform: rotate(0deg);
                    transition: transform 0.3s;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow {
                    transform: rotate(180deg);
                }

                .submenu-toggle,
                .submenu-toggle-label {
                    display: inline-block;
                    cursor: pointer;
                }

                .submenu-toggle-label {
                    margin-left: 8px;
                }
            }
        </style>
        <nav role='navigation' class="menu <?php echo esc_attr($unique_class); ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" class="menu-toggle" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . esc_attr($lf_alignment),
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_frame_pulse($settings, $display_menu_id, $lf_alignment, $show_arrow, $menu_link_arrow_color, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;


        // Compose inline font-size style
        // ...existing code...
        $arrow_padding = $settings['lf_label_padding'] ?? [];
        $top    = isset($arrow_padding['top'])    ? $arrow_padding['top']    : '0';
        $right  = isset($arrow_padding['right'])  ? $arrow_padding['right']  : '0';
        $bottom = isset($arrow_padding['bottom']) ? $arrow_padding['bottom'] : '0';
        $left   = isset($arrow_padding['left'])   ? $arrow_padding['left']   : '0';
        $unit   = $arrow_padding['unit'] ?? 'px';
        $padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";
        // ...existing code...
    ?>

        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul
            }

            @media screen and (max-width: 1024px) {
                /* .submenu-toggle-label {

                    position: relative;
                    padding: <?php echo esc_attr($padding_css);
                                ?>;
                    display: inline-flex;
                    justify-content: center;
                    align-items: center;
                    width: fit-content;
                } */

                .submenu-toggle-label,
                .submenu-toggle-label span.submenu-arrow {
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                }

                .submenu-toggle-label {
                    display: inline-block;
                }

                .menu.<?= esc_attr($unique_class_css);

                        ?>>ul,
                .menu-righticon {
                    display: none;
                }

                #<?php echo esc_attr($menu_id);

                    ?>:checked+ul {
                    display: block;
                    -webkit-animation: grow 0.5s ease-in-out;
                    animation: grow 0.5s ease-in-out;
                }

                /* Submenu dropdown display for all levels */
                .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked~.menu-dropdown,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked~.menu-dropdown {
                    display: block;
                    animation: grow 0.5s ease-in-out;
                }

                /* Arrow rotation for all submenu levels */
                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-arrow {
                    transform: rotate(0deg);
                    transition: transform 0.3s;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow,
                .menu.<?php echo esc_attr($unique_class_css); ?>ul li ul li ul li ul li .submenu-toggle:checked+.submenu-toggle-label .submenu-arrow {
                    transform: rotate(180deg);
                }
            }
        </style>


        <nav role='navigation' class="menu <?php echo $unique_class; ?>">
            <label for="<?php echo esc_attr($menu_id); ?>">Menu <i class="fa fa-bars"></i></label>
            <input type="checkbox" id="<?php echo esc_attr($menu_id); ?>">
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-align-' . $lf_alignment,
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
            ));
            ?>
        </nav>
    <?php
    }
    public function render_default($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {

        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

        $arrow_padding = $settings['lf_label_padding'] ?? [];
        $top    = isset($arrow_padding['top'])    ? $arrow_padding['top']    : '8';
        $right  = isset($arrow_padding['right'])  ? $arrow_padding['right']  : '8';
        $bottom = isset($arrow_padding['bottom']) ? $arrow_padding['bottom'] : '8';
        $left   = isset($arrow_padding['left'])   ? $arrow_padding['left']   : '8';
        $unit   = $arrow_padding['unit'] ?? 'px';
        $padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";

        // Link padding for large screen
        $link_padding = $settings['link_padding'] ?? [];
        $top    = isset($link_padding['top'])    ? $link_padding['top']    : '0';
        $right  = isset($link_padding['right'])  ? $link_padding['right']  : '0';
        $bottom = isset($link_padding['bottom']) ? $link_padding['bottom'] : '0';
        $left   = isset($link_padding['left'])   ? $link_padding['left']   : '0';
        $unit   = $link_padding['unit'] ?? 'px';
        $link_padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";



        // Submenu link padding for large screen
        $submenu_link_padding = $settings['lf_submenu_link_padding'] ?? [];
        $submenu_top    = isset($submenu_link_padding['top'])    ? $submenu_link_padding['top']    : '0';
        $submenu_right  = isset($submenu_link_padding['right'])  ? $submenu_link_padding['right']  : '0';
        $submenu_bottom = isset($submenu_link_padding['bottom']) ? $submenu_link_padding['bottom'] : '0';
        $submenu_left   = isset($submenu_link_padding['left'])   ? $submenu_link_padding['left']   : '0';
        $submenu_unit   = $submenu_link_padding['unit'] ?? 'px';
        $submenu_link_padding_css = "{$submenu_top}{$submenu_unit} {$submenu_right}{$submenu_unit} {$submenu_bottom}{$submenu_unit} {$submenu_left}{$submenu_unit}";


        // Link padding for tablet andmobile
        $link_padding_mobile = $settings['lf_link_padding_mobile'] ?? [];
        $link_padding_mobile_top    = isset($link_padding_mobile['top'])    ? $link_padding_mobile['top']    : '0';
        $link_padding_mobile_right  = isset($link_padding_mobile['right'])  ? $link_padding_mobile['right']  : '0';
        $link_padding_mobile_bottom = isset($link_padding_mobile['bottom']) ? $link_padding_mobile['bottom'] : '0';
        $link_padding_mobile_left   = isset($link_padding_mobile['left'])   ? $link_padding_mobile['left']   : '0';
        $link_padding_mobile_unit   = $link_padding_mobile['unit'] ?? 'px';
        $link_padding_mobile_css = "{$link_padding_mobile_top}{$link_padding_mobile_unit} {$link_padding_mobile_right}{$link_padding_mobile_unit} {$link_padding_mobile_bottom}{$link_padding_mobile_unit} {$link_padding_mobile_left}{$link_padding_mobile_unit}";


        $alignment = $settings['lf_hamburger_alignment'];
        // Map alignment to flex position
        $align_map = [
            'left' => 'flex-start',
            'center' => 'center',
            'right' => 'flex-end',
        ];
        $align_style = isset($align_map[$alignment]) ? $align_map[$alignment] : 'flex-start';


    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > a {
                    text-transform: capitalize;
                }

                /* Ensure link and arrow label sit inline on desktop */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > a,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label {
                    display: inline-flex;
                    align-items: center;
                    vertical-align: middle;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label > span.submenu-arrow {
                    display: inline-block;
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }



                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li>a:hover::after {
                    top: -8px;
                    right: -8px;
                    opacity: 1;
                }

                .pixl-hamburger-wrapper {
                    display: none;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }
            }

            /* Link padding for large screen */
            nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li {
                padding: <?php echo esc_attr($link_padding_css); ?>;
            }

            /* Remove padding for all submenu depths on large screen */
            nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li {
                padding: 0;
            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css); ?>>ul,
                .menu-righticon {
                    display: none;
                }


                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;

                }
                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li {
                    padding: 0;
                }
                
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>a,
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>label {
                    flex: 1 1 auto;
                    float: right
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>label>span.submenu-arrow {
                    float: right;
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > a,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > label {
                    flex: 1 1 auto;
                }


                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li ul li a {
                    float: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li ul li label {
                    float: right;
                }

                nav.menu>label.nav-label {
                    /* background-color: red; */
                    display: flex;
                    align-items: end;

                    flex-direction: column;
                    justify-content: space-between;
                }


                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>ul>li>label>span.submenu-arrow {
                    float: right;
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li label > span.submenu-arrow {
                    float: right;
                    padding: <?= esc_attr($padding_css);
                                ?>;
                    font-size: <?= esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']);
                                ?>;
                    background-color: <?= esc_attr($settings['menu_link_arrow_label_bg_color']);
                                        ?>;
                }

                /* WORK AREA */
                .menu-dropdown {
                    display: none;
                    flex-direction: column;
                    background: #fff;
                }

                .menu.<?php echo $unique_class; ?>:has(> .pixl-hamburger-wrapper-<?php echo $unique_class; ?> #<?php echo esc_attr($menu_id); ?>:checked)>ul.menu-dropdown {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                    margin-top: 10px;
                }

                @keyframes grow {
                    0% {
                        opacity: 0;
                        transform: scaleY(0);
                    }

                    100% {
                        opacity: 1;
                        transform: scaleY(1);
                    }
                }

                /* Arrow styling */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> .submenu-arrow {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    font-size: 12px;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css); ?>.submenu-toggle-label {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    line-height: normal;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> .submenu-toggle:checked ~ .menu-dropdown,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li .submenu-toggle:checked ~ .menu-dropdown,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li .submenu-toggle:checked ~ .menu-dropdown,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown,
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                    top: 20px;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                    top: 20px;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }


                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul > li {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                
                }
                
                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li:not(.menu-hasdropdown) > a {
                    padding: <?php echo esc_attr($link_padding_mobile_css);?>;
                }
                
                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li.menu-hasdropdown > label > a {
                    pointer-events: auto;
                    cursor: pointer;
                }
                    
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > label.submenu-toggle-label{
                    padding: <?php echo esc_attr($link_padding_mobile_css);?>;
              }                  
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li{
                align-items:center;
              }
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label{
                padding-left:<?php echo esc_attr($link_padding_mobile_left); ?>px;
              }
              /* Center contents inside labels and neutralize floats for arrow when inside label */
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label,
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > label.submenu-toggle-label {
                display: inline-flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
              }
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label > a,
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > label.submenu-toggle-label > a {
                display: inline-flex;
                align-items: center;
                justify-content: flex-start;
                flex: 1 1 auto;
                text-align: left;
              }
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li > label.submenu-toggle-label > span.submenu-arrow,
              nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li ul li > label.submenu-toggle-label > span.submenu-arrow {
                float: none;
                margin-left: 8px;
              }

            }
        </style>
        
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle anchor tag clicks in dropdown items for mobile/tablet
            const dropdownAnchors = document.querySelectorAll('nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li.menu-hasdropdown > label > a');
            
            dropdownAnchors.forEach(function(anchor) {
                anchor.addEventListener('click', function(e) {
                    // Only handle on mobile/tablet screens
                    if (window.innerWidth <= 1024) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Find the associated checkbox and toggle it
                        const label = this.closest('label');
                        const checkbox = document.getElementById(label.getAttribute('for'));
                        
                        if (checkbox) {
                            checkbox.checked = !checkbox.checked;
                            
                            // Trigger change event to ensure CSS animations work
                            const event = new Event('change', { bubbles: true });
                            checkbox.dispatchEvent(event);
                        }
                    }
                });
            });
        });
        </script>
        
        <?php

        ?>
        <nav role='navigation' class="menu <?php echo $unique_class; ?>">
            <div class="pixl-hamburger-wrapper-<?php echo $unique_class; ?>">
                <input type="checkbox" id="<?php echo esc_attr($menu_id); ?>">
                <label style="align-self: center;" for="<?php echo esc_attr($menu_id); ?>" class="nav-label lf-hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>
            <?php
            echo wp_nav_menu(array(
                'menu'          => $display_menu_id,
                'container'     => false,
                'menu_class'    => 'menu-dropdown menu-align-' . $lf_alignment,
                'walker'        => new Custom_Nav_Walker($unique_class_css),
                'arrow_desktop' => $show_arrow,
                'fallback_cb'   => false,
            ));
            ?>
        </nav>
<?php
    }
}

?>