<?php

namespace LFWidgets;

use Elementor_Addon_Pixl_Dynamics\Custom_Nav_Walker;

class Animations
{

    public static function render_underline_top($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

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

        // Submenu link padding for tablet and mobile
        $lfsubmenu_link_padding = $settings['lfsubmenu_link_padding'] ?? [];
        $lfsubmenu_link_padding_top    = isset($lfsubmenu_link_padding['top'])    ? $lfsubmenu_link_padding['top']    : '0';
        $lfsubmenu_link_padding_right  = isset($lfsubmenu_link_padding['right'])  ? $lfsubmenu_link_padding['right']  : '0';
        $lfsubmenu_link_padding_bottom = isset($lfsubmenu_link_padding['bottom']) ? $lfsubmenu_link_padding['bottom'] : '0';
        $lfsubmenu_link_padding_left   = isset($lfsubmenu_link_padding['left'])   ? $lfsubmenu_link_padding['left']   : '0';
        $lfsubmenu_link_padding_unit   = $lfsubmenu_link_padding['unit'] ?? 'px';

        $hover_bg_color = !empty($settings['navbar_hover_bg_color']) ? $settings['navbar_hover_bg_color'] : '#5e5e5eff';

        $alignment = $settings['lf_hamburger_alignment'];
        $align_map = [
            'left' => 'flex-start',
            'center' => 'center',
            'right' => 'flex-end',
        ];
        $align_style = isset($align_map[$alignment]) ? $align_map[$alignment] : 'flex-start';

?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?> {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                /* Wrapper fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-item-wrapper'; ?> {
                    position: relative;
                    display: block;
                    width: 100%;
                    z-index: 1;
                }

                /* Submenu toggle label fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . 'ul li > .menu-item-wrapper > a'; ?> {
                    text-transform: capitalize;
                }

                /* Ensure link and arrow label sit inline on desktop */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    vertical-align: middle;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    display: inline-block;
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li'; ?> {
                    position: relative;
                    margin: 0;
                    padding: 0;
                    line-height: 1;
                    font-size: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>a:hover::after'; ?> {
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

                <?php if ($show_arrow !== 'yes'): ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    display: none !important;
                }

                <?php endif ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label span.submenu-arrow'; ?> {
                    transform: rotate(30deg);
                }

                /* On Hover Animation.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::before'; ?> {
                    content: "";
                    position: absolute;
                    top: 0px;
                    left: 50%;
                    transform: translateX(-50%);
                    height: 3px;
                    width: 0%;
                    background-color: <?php echo esc_attr($hover_bg_color); ?>;
                    transition: width 0.3s ease;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover::before'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                /* On Hover Animation ends.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    box-shadow:
                        0 1px 5px rgba(0, 0, 0, 0.15),
                        -1px 0 5px rgba(128, 128, 128, 0.08),
                        1px 0 5px rgba(128, 128, 128, 0.08);
                }

                /* to open menu on hover... */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Deeper submenus: open horizontally beside parent */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 0;
                    left: 100%;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                    white-space: nowrap;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Prevent parent ul from clipping child flyouts */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    position: relative;
                }

                /* Top-level link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_css); ?>;
                    /* line-height: normal; */
                    line-height: 1;
                }

                /* Submenu link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($submenu_link_padding_css); ?>;
                    /* line-height: normal; */
                    line-height: 1;
                }

                /* Prevent clipping globally */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    overflow: visible;
                }

                /* Hide hamburger on desktop */
                .pixl-hamburger-wrapper,
                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                /* Second-level submenu padding for desktop - only direct children of top-level li */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > ul:not(ul ul)'; ?> {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
            }

            /* Remove padding for all submenu depths on large screen */
            nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                line-height: 1;
            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?>,
                .menu-righticon {
                    display: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper'; ?> {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper>label.submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                    line-height: 1.6;
                }

                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    padding: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.submenu-toggle-label'; ?> {
                    line-height: 1.6;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    padding: 0 !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;

                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper > label > span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;

                }

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
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css) . '.submenu-toggle-label'; ?> {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?> {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?> {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul > li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul  li ul li > .menu-item-wrapper'; ?> {
                    /* padding: <?php echo esc_attr($link_padding_mobile_css); ?>; */
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' li:has(> input.submenu-toggle:checked)'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li:not(.menu-hasdropdown) > a'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                }

                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li.menu-hasdropdown > label > a'; ?> {
                    pointer-events: auto;
                    cursor: pointer;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding-top: <?php echo esc_attr($lfsubmenu_link_padding_top); ?>px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul ul ul'; ?> {
                    padding-left: 0;
                    padding-right: 0;
                }

                /* Center contents inside labels and neutralize floats for arrow when inside label */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > a'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex: 1 1 auto;
                    text-align: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    margin-left: <?php echo esc_attr($lfsubmenu_link_padding_left); ?>px;
                    margin-right: <?php echo esc_attr($lfsubmenu_link_padding_right); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    padding-bottom: <?php echo esc_attr($lfsubmenu_link_padding_bottom); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:not(:has(.menu-dropdown))'; ?> {
                    border-top: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li  a'; ?> {
                    text-transform: capitalize;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' a.menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li.menu-item:not(.menu-hasdropdown):not(.menu-hasflyout) > .menu-item-wrapper'; ?> {
                    border-top: none !important;
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const root = document.querySelector('nav.menu.<?php echo esc_attr($unique_class_css); ?>');
                if (root) {
                    const highlightAtPointer = function(target) {
                        const li = target.closest('li');
                        if (!li || !root.contains(li)) return;
                        const parentUl = li.parentElement;
                        if (!parentUl || parentUl.tagName !== 'UL') return;
                        parentUl.querySelectorAll(':scope > li.is-hover').forEach(function(sibling) {
                            sibling.classList.remove('is-hover');
                        });
                        li.classList.add('is-hover');
                    };

                    root.addEventListener('mousemove', function(e) {
                        highlightAtPointer(e.target);
                    });

                    root.addEventListener('mouseleave', function() {
                        root.querySelectorAll('li.is-hover').forEach(function(li) {
                            li.classList.remove('is-hover');
                        });
                    });
                }
                const dropdownAnchors = document.querySelectorAll('nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li.menu-hasdropdown > label > a');

                dropdownAnchors.forEach(function(anchor) {
                    anchor.addEventListener('click', function(e) {
                        if (window.innerWidth <= 1024) {
                            e.preventDefault();
                            e.stopPropagation();

                            const label = this.closest('label');
                            const checkbox = document.getElementById(label.getAttribute('for'));

                            if (checkbox) {
                                checkbox.checked = !checkbox.checked;

                                const event = new Event('change', {
                                    bubbles: true
                                });
                                checkbox.dispatchEvent(event);
                            }
                        }
                    });
                });
            });
        </script>
        <div class="lf-pixl-nav-wrapper">
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
        </div>
    <?php
    }
    public static function render_underline_below($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

        // Link padding for large screen
        $link_padding = $settings['link_padding'] ?? [];
        $top    = isset($link_padding['top'])    ? $link_padding['top']    : '0';
        $right  = isset($link_padding['right'])  ? $link_padding['right']  : '0';
        $bottom = isset($link_padding['bottom']) ? $link_padding['bottom'] : '0';
        $left   = isset($link_padding['left'])   ? $link_padding['left']   : '0';
        $unit   = $link_padding['unit'] ?? 'px';
        $link_padding_css = "{$top}{$unit} {$right}{$unit} {$bottom}{$unit} {$left}{$unit}";

        // Link padding for tablet andmobile
        $link_padding_mobile = $settings['lfsubmenu_link_padding'] ?? [];
        $link_padding_mobile_top    = isset($link_padding_mobile['top'])    ? $link_padding_mobile['top']    : '0';
        $link_padding_mobile_right  = isset($link_padding_mobile['right'])  ? $link_padding_mobile['right']  : '0';
        $link_padding_mobile_bottom = isset($link_padding_mobile['bottom']) ? $link_padding_mobile['bottom'] : '0';
        $link_padding_mobile_left   = isset($link_padding_mobile['left'])   ? $link_padding_mobile['left']   : '0';
        $link_padding_mobile_unit   = $link_padding_mobile['unit'] ?? 'px';
        $link_padding_mobile_css = "{$link_padding_mobile_top}{$link_padding_mobile_unit} {$link_padding_mobile_right}{$link_padding_mobile_unit} {$link_padding_mobile_bottom}{$link_padding_mobile_unit} {$link_padding_mobile_left}{$link_padding_mobile_unit}";

        $hover_bg_color_bottom = !empty($settings['navbar_hover_bg_color_bottom']) ? $settings['navbar_hover_bg_color_bottom'] : '#5e5e5eff';

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

                /* Wrapper fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-item-wrapper'; ?> {
                    position: relative;
                    display: block;
                    width: 100%;
                    z-index: 1;
                }

                /* Submenu toggle label fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . 'ul li > .menu-item-wrapper > a'; ?> {
                    text-transform: capitalize;
                }

                /* Ensure link and arrow label sit inline on desktop */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    vertical-align: middle;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    display: inline-block;
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li'; ?> {
                    position: relative;
                    margin: 0;
                    padding: 0;
                    line-height: 1;
                    font-size: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>a:hover::after'; ?> {
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

                <?php if ($show_arrow !== 'yes'): ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    display: none !important;
                }

                <?php endif ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label span.submenu-arrow'; ?> {
                    transform: rotate(30deg);
                }

                /* On Hover Animation.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::after'; ?> {
                    content: "";
                    position: absolute;
                    bottom: 0px;
                    left: 50%;
                    transform: translateX(-50%);
                    height: 3px;
                    width: 0%;
                    background-color: <?php echo esc_attr($hover_bg_color_bottom); ?>;
                    transition: width 0.3s ease;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover::after'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                /* On Hover Animation ends.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    box-shadow:
                        0 1px 5px rgba(0, 0, 0, 0.15),
                        -1px 0 5px rgba(128, 128, 128, 0.08),
                        1px 0 5px rgba(128, 128, 128, 0.08);
                }

                /* to open menu on hover... */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Deeper submenus: open horizontally beside parent */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 0;
                    left: 100%;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                    white-space: nowrap;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Prevent parent ul from clipping child flyouts */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    position: relative;
                }

                /* Top-level link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_css); ?>;
                    line-height: 1;
                }

                /* Prevent clipping globally */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    overflow: visible;
                }

                /* Hide hamburger on desktop */
                .pixl-hamburger-wrapper,
                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                /* Second-level submenu padding for desktop - only direct children of top-level li */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > ul:not(ul ul)'; ?> {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
            }

            /* Remove padding for all submenu depths on large screen */
            nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                line-height: 1;
            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?>,
                .menu-righticon {
                    display: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper'; ?> {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper>label.submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                    line-height: 1;
                }

                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    padding: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.submenu-toggle-label'; ?> {
                    line-height: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    padding: 0 !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper > label > span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

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
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css) . '.submenu-toggle-label'; ?> {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?> {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?> {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul > li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul  li ul li > .menu-item-wrapper'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' li:has(> input.submenu-toggle:checked)'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li:not(.menu-hasdropdown) > a'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                }

                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li.menu-hasdropdown > label > a'; ?> {
                    pointer-events: auto;
                    cursor: pointer;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding-top: <?php echo esc_attr($link_padding_mobile_top); ?>px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul ul ul'; ?> {
                    padding-left: 0;
                    padding-right: 0;
                }

                /* Center contents inside labels and neutralize floats for arrow when inside label */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > a'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex: 1 1 auto;
                    text-align: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    margin-left: <?php echo esc_attr($link_padding_mobile_left); ?>px;
                    margin-right: <?php echo esc_attr($link_padding_mobile_right); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    padding-bottom: <?php echo esc_attr($link_padding_mobile_bottom); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:not(:has(.menu-dropdown))'; ?> {
                    border-top: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li  a'; ?> {
                    text-transform: capitalize;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' a.menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li.menu-item:not(.menu-hasdropdown):not(.menu-hasflyout) > .menu-item-wrapper'; ?> {
                    border-top: none !important;
                }
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownAnchors = document.querySelectorAll('nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li.menu-hasdropdown > label > a');

                dropdownAnchors.forEach(function(anchor) {
                    anchor.addEventListener('click', function(e) {
                        if (window.innerWidth <= 1024) {
                            e.preventDefault();
                            e.stopPropagation();

                            const label = this.closest('label');
                            const checkbox = document.getElementById(label.getAttribute('for'));

                            if (checkbox) {
                                checkbox.checked = !checkbox.checked;

                                const event = new Event('change', {
                                    bubbles: true
                                });
                                checkbox.dispatchEvent(event);
                            }
                        }
                    });
                });
            });
        </script>
        <div class="lf-pixl-nav-wrapper">
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
        </div>

    <?php
    }

    public static function render_double_line($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

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

        $hover_double_line_bgcolor = !empty($settings['hover_double_line_bgcolor']) ? $settings['hover_double_line_bgcolor'] : '#5e5e5eff';
        $hover_double_line_text_color = !empty($settings['hover_double_line_text_color']) ? $settings['hover_double_line_text_color'] : '#ffffff';

        $alignment = $settings['lf_hamburger_alignment'];
        $align_map = [
            'left' => 'flex-start',
            'center' => 'center',
            'right' => 'flex-end',
        ];
        $align_style = isset($align_map[$alignment]) ? $align_map[$alignment] : 'flex-start';

    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?> {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                /* Wrapper fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-item-wrapper'; ?> {
                    position: relative;
                    display: block;
                    width: 100%;
                    z-index: 1;
                }

                /* Submenu toggle label fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                }

                /* Double Line Hover Animations... */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::before'; ?> {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    top: 0;
                    left: 0;
                    border-top: 1px solid <?php echo esc_attr($hover_double_line_bgcolor); ?>;
                    border-bottom: 1px solid <?php echo esc_attr($hover_double_line_bgcolor); ?>;
                    transform: scaleY(2);
                    opacity: 0;
                    transition: .5s;
                    z-index: 0;
                    pointer-events: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover::before'; ?> {
                    transform: scaleY(1.1);
                    opacity: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::after'; ?> {
                    content: '';
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    background-color: <?php echo esc_attr($hover_double_line_bgcolor); ?>;
                    top: 0;
                    left: 0;
                    transform: scaleY(0.6);
                    opacity: 0;
                    transition: .5s;
                    z-index: -1;
                    pointer-events: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul.menu-dropdown {
                    z-index: 10;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li:hover::after {
                    transform: scaleY(1);
                    opacity: 1;
                }

                /* Double Line Hover Animations ends... */

                /* Ensure non-submenu items (no wrapper) also get hover color */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li:hover>.menu-item-wrapper>a,
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li:hover>.menu-item-wrapper>label.submenu-toggle-label>a,
                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li:hover>.menu-item-wrapper>label.submenu-toggle-label>span.submenu-arrow {
                    color: <?php echo esc_attr($hover_double_line_text_color); ?> !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    position: relative;
                    z-index: 1;
                    margin: 0;
                    padding: 0;
                    line-height: 1;
                    font-size: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li>.menu-item-wrapper>label.submenu-toggle-label>a {
                    text-transform: capitalize;
                }

                /* Ensure link and arrow label sit inline on desktop */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    vertical-align: middle;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    display: inline-block;
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css);

                            ?>>ul>li {
                    position: relative;
                }

                .pixl-hamburger-wrapper {
                    display: none;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                <?php if ($show_arrow !== 'yes'): ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    display: none !important;
                }

                <?php endif ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label span.submenu-arrow'; ?> {
                    transform: rotate(30deg);
                }

                /* On Hover Animation ends.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    box-shadow:
                        0 1px 5px rgba(0, 0, 0, 0.15),
                        -1px 0 5px rgba(128, 128, 128, 0.08),
                        1px 0 5px rgba(128, 128, 128, 0.08);
                }

                /* to open menu on hover... */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Deeper submenus: open horizontally beside parent */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 0;
                    left: 100%;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                    white-space: nowrap;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Prevent parent ul from clipping child flyouts */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    position: relative;
                }

                /* Top-level link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_css); ?>;
                    line-height: 1;
                }

                /* Submenu link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($submenu_link_padding_css); ?>;
                    line-height: 1;
                }

                /* Prevent clipping globally */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    overflow: visible;
                }

                /* Hide hamburger on desktop */
                .pixl-hamburger-wrapper,
                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                /* Second-level submenu padding for desktop - only direct children of top-level li */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > ul:not(ul ul)'; ?> {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
            }

            /* Remove padding for all submenu depths on large screen */
            nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                line-height: 1;
            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?>,
                .menu-righticon {
                    display: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper'; ?> {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper>label.submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                    line-height: 1;
                }

                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    padding: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.submenu-toggle-label'; ?> {
                    line-height: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    padding: 0 !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper > label > span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

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
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css) . '.submenu-toggle-label'; ?> {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?> {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?> {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul > li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul  li ul li > .menu-item-wrapper'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' li:has(> input.submenu-toggle:checked)'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li:not(.menu-hasdropdown) > a'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                }

                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li.menu-hasdropdown > label > a'; ?> {
                    pointer-events: auto;
                    cursor: pointer;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding-top: <?php echo esc_attr($link_padding_mobile_top); ?>px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul ul ul'; ?> {
                    padding-left: 0;
                    padding-right: 0;
                }

                /* Center contents inside labels and neutralize floats for arrow when inside label */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > a'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex: 1 1 auto;
                    text-align: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    margin-left: <?php echo esc_attr($link_padding_mobile_left); ?>px;
                    margin-right: <?php echo esc_attr($link_padding_mobile_right); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    padding-bottom: <?php echo esc_attr($link_padding_mobile_bottom); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:not(:has(.menu-dropdown))'; ?> {
                    border-top: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li  a'; ?> {
                    text-transform: capitalize;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' a.menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li.menu-item:not(.menu-hasdropdown):not(.menu-hasflyout) > .menu-item-wrapper'; ?> {
                    border-top: none !important;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownAnchors = document.querySelectorAll('nav.menu.<?php echo esc_attr($unique_class_css); ?> ul li.menu-hasdropdown > label > a');

                dropdownAnchors.forEach(function(anchor) {
                    anchor.addEventListener('click', function(e) {
                        if (window.innerWidth <= 1024) {
                            e.preventDefault();
                            e.stopPropagation();

                            const label = this.closest('label');
                            const checkbox = document.getElementById(label.getAttribute('for'));

                            if (checkbox) {
                                checkbox.checked = !checkbox.checked;

                                const event = new Event('change', {
                                    bubbles: true
                                });
                                checkbox.dispatchEvent(event);
                            }
                        }
                    });
                });
            });
        </script>
        <div class="lf-pixl-nav-wrapper">
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
        </div>
    <?php
    }

    public static function render_frame_pulse($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {
        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

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

        $hover_frame_pulse_bgcolor = !empty($settings['hover_frame_pulse_bgcolor']) ? $settings['hover_frame_pulse_bgcolor'] : '#5e5e5eff';
        $hover_frame_pulse_text_color = !empty($settings['hover_frame_pulse_text_color']) ? $settings['hover_frame_pulse_text_color'] : '#ffffff';

        $alignment = $settings['lf_hamburger_alignment'];
        $align_map = [
            'left' => 'flex-start',
            'center' => 'center',
            'right' => 'flex-end',
        ];
        $align_style = isset($align_map[$alignment]) ? $align_map[$alignment] : 'flex-start';
    ?>
        <style>
            @media screen and (min-width: 1025px) {
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul'; ?> {
                    list-style: none;
                    position: relative;
                    display: flex;
                    gap: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li'; ?> {
                    position: relative;
                    margin: 0;
                    padding: 0;
                    line-height: 1;
                    font-size: 0;
                }

                /* Wrapper fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-item-wrapper'; ?> {
                    position: relative;
                    display: block;
                    width: 100%;
                    z-index: 1;
                }

                /* Submenu toggle label fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                }

                /* frame pulse animation starts here... */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::before'; ?> {
                    content: '';
                    position: absolute;
                    bottom: 12px;
                    left: 12px;
                    width: 16px;
                    height: 16px;
                    border: 3px solid <?php echo esc_attr($hover_frame_pulse_bgcolor); ?>;
                    border-width: 0 0 3px 3px;
                    transition: .5s;
                    opacity: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover'; ?> {
                    background-color: <?php echo esc_attr($hover_frame_pulse_bgcolor); ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover::before'; ?> {
                    bottom: -6px;
                    left: -6px;
                    opacity: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li::after'; ?> {
                    content: '';
                    position: absolute;
                    top: 12px;
                    right: 12px;
                    width: 16px;
                    height: 16px;
                    border: 3px solid <?php echo esc_attr($hover_frame_pulse_bgcolor); ?>;
                    border-width: 3px 3px 0 0;
                    transition: .5s;
                    opacity: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover::after'; ?> {
                    top: -6px;
                    right: -6px;
                    opacity: 1;
                }

                /* frame pulse animation starts here... */

                nav.menu.<?php echo esc_attr($unique_class_css) . '> ul > li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . '> ul > li:hover > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . '> ul > li:hover > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    color: <?php echo esc_attr($hover_frame_pulse_text_color); ?> !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li:hover>label.submenu-toggle-label>span.submenu-arrow'; ?> {
                    z-index: 2;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?> {
                    text-transform: capitalize;
                }

                /* Ensure link and arrow label sit inline on desktop */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    vertical-align: middle;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    display: inline-block;
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>>ul>li {
                    position: relative;
                }

                .pixl-hamburger-wrapper {
                    display: none;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                <?php if ($show_arrow !== 'yes'): ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    display: none !important;
                }

                <?php endif ?>nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label span.submenu-arrow'; ?> {
                    transform: rotate(30deg);
                }

                /* On Hover Animation ends.. */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    box-shadow:
                        0 1px 5px rgba(0, 0, 0, 0.15),
                        -1px 0 5px rgba(128, 128, 128, 0.08),
                        1px 0 5px rgba(128, 128, 128, 0.08);
                }

                /* to open menu on hover... */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Deeper submenus: open horizontally beside parent */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 0;
                    left: 100%;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                    white-space: nowrap;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Prevent parent ul from clipping child flyouts */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    position: relative;
                }

                /* Top-level link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_css); ?>;
                    line-height: 1;
                }

                /* Submenu link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($submenu_link_padding_css); ?>;
                    line-height: 1;
                }

                /* Prevent clipping globally */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    overflow: visible;
                }

                /* Hide hamburger on desktop */
                .pixl-hamburger-wrapper,
                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                /* Second-level submenu padding for desktop - only direct children of top-level li */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > ul:not(ul ul)'; ?> {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
            }

            /* Remove padding for all submenu depths on large screen */
            nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                line-height: 1;
            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css); ?>>ul,
                .menu-righticon {
                    display: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper'; ?> {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper>label.submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                    line-height: ;
                }

                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    padding: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.submenu-toggle-label'; ?> {
                    line-height: 1;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    padding: 0 !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper > label > span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

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
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?> {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?> {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul > li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul  li ul li > .menu-item-wrapper'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' li:has(> input.submenu-toggle:checked)'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li:not(.menu-hasdropdown) > a'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                }

                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li.menu-hasdropdown > label > a'; ?> {
                    pointer-events: auto;
                    cursor: pointer;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding-top: <?php echo esc_attr($link_padding_mobile_top); ?>px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul ul ul'; ?> {
                    padding-left: 0;
                    padding-right: 0;
                }

                /* Center contents inside labels and neutralize floats for arrow when inside label */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > a'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex: 1 1 auto;
                    text-align: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    margin-left: <?php echo esc_attr($link_padding_mobile_left); ?>px;
                    margin-right: <?php echo esc_attr($link_padding_mobile_right); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    padding-bottom: <?php echo esc_attr($link_padding_mobile_bottom); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:not(:has(.menu-dropdown))'; ?> {
                    border-top: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li  a'; ?> {
                    text-transform: capitalize;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' a.menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li.menu-item:not(.menu-hasdropdown):not(.menu-hasflyout) > .menu-item-wrapper'; ?> {
                    border-top: none !important;
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
                                const event = new Event('change', {
                                    bubbles: true
                                });
                                checkbox.dispatchEvent(event);
                            }
                        }
                    });
                });
            });
        </script>
        <div class="lf-pixl-nav-wrapper">
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
        </div>
    <?php
    }

    public static function render_default($settings, $display_menu_id, $lf_alignment, $show_arrow, $unique_id = ''): void
    {

        $unique_class = $unique_id ? htmlspecialchars($unique_id, ENT_QUOTES, 'UTF-8') : 'lf-unique-default';
        $unique_class_css = preg_replace('/[^a-zA-Z0-9_-]/', '', $unique_class);
        $menu_id = 'menu-toggle-double-' . $unique_class_css;

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

        // Link padding for tablet andmobile
        $lfsubmenu_link_padding = $settings['lfsubmenu_link_padding'] ?? [];
        $lfsubmenu_link_padding_top    = isset($lfsubmenu_link_padding['top'])    ? $lfsubmenu_link_padding['top']    : '0';
        $lfsubmenu_link_padding_right  = isset($lfsubmenu_link_padding['right'])  ? $lfsubmenu_link_padding['right']  : '0';
        $lfsubmenu_link_padding_bottom = isset($lfsubmenu_link_padding['bottom']) ? $lfsubmenu_link_padding['bottom'] : '0';
        $lfsubmenu_link_padding_left   = isset($lfsubmenu_link_padding['left'])   ? $lfsubmenu_link_padding['left']   : '0';
        $lfsubmenu_link_padding_unit   = $lfsubmenu_link_padding['unit'] ?? 'px';
        $lfsubmenu_link_padding_css = "{$lfsubmenu_link_padding_top}{$lfsubmenu_link_padding_unit} {$lfsubmenu_link_padding_right}{$lfsubmenu_link_padding_unit} {$lfsubmenu_link_padding_bottom}{$lfsubmenu_link_padding_unit} {$lfsubmenu_link_padding_left}{$lfsubmenu_link_padding_unit}";

        $link_hover_bg_color = $settings['link_hover_bg_color'] ? $settings['link_hover_bg_color'] : 'transparent';
        // link background hover text color
        $link_hover_bg_text_color = $settings['link_hover_bg_text'] ? $settings['link_hover_bg_text'] : 'transparent';

        $alignment = $settings['lf_hamburger_alignment'];
        $align_map = [
            'left' => 'flex-start',
            'center' => 'center',
            'right' => 'flex-end',
        ];
        $align_style = isset($align_map[$alignment]) ? $align_map[$alignment] : 'flex-start';

        $enable_hover = $settings['lf_link_hover'];

    ?>
        <style>
            @media screen and (min-width: 1025px) {

                /* Top-level menu layout */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul'; ?> {
                    list-style: none;
                    display: flex;
                    gap: 0;
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css); ?>ul li {
                    margin: 0;
                    padding: 0;
                    line-height: 1;
                    font-size: 0;
                }

                /* Wrapper fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-item-wrapper'; ?> {
                    position: relative;
                    display: block;
                    width: 100%;
                    z-index: 1;
                }

                /* Base link styling */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                /* Submenu toggle label fills full width */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                }

                /* Submenu arrow */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    display: inline-block;
                    margin-left: 8px;
                    vertical-align: middle;
                    <?php if ($show_arrow !== 'yes'): ?>display: none !important;
                    <?php endif; ?>
                }

                /* First-level submenu: opens vertically */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Deeper submenus: open horizontally beside parent */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    position: relative;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > ul'; ?> {
                    display: none;
                    position: absolute;
                    top: 0;
                    left: 100%;
                    flex-direction: column;
                    background-color: hsl(220, 40%, 95%);
                    box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
                    z-index: 999;
                    min-width: 200px;
                    white-space: nowrap;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > ul'; ?> {
                    display: flex;
                }

                /* Prevent parent ul from clipping child flyouts */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    position: relative;
                }

                /* Top-level link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_css); ?>;
                    line-height: 1;
                }

                /* Submenu link padding */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($submenu_link_padding_css); ?>;
                    line-height: 1;
                }

                <?php
                if ('yes' == $enable_hover) {
                ?>

                /* Hover background on full menu item */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover'; ?> {
                    background-color: <?php echo esc_attr($link_hover_bg_color); ?>;
                }

                /* Hover text color */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a.menu-link'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a.menu-link *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > label > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > label > a'; ?> {
                    color: <?php echo esc_attr($link_hover_bg_text_color); ?> !important;
                }

                <?php
                } else {
                ?>

                /* Hover background on link only */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > label > a'; ?> {
                    background-color: transparent !important;
                }

                /* Hover text color */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a.menu-link'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a.menu-link *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul > li:hover > .menu-item-wrapper > label > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > a *'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:hover > .menu-item-wrapper > label > a'; ?> {
                    color: #000000 !important;
                }

                <?php
                }
                ?>

                /* Optional: flyout arrow rotation */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label span.submenu-arrow'; ?> {
                    transform: rotate(30deg);
                }

                /* Prevent clipping globally */
                nav.menu.<?php echo esc_attr($unique_class_css); ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    overflow: visible;
                }

                /* Hide hamburger on desktop */
                .pixl-hamburger-wrapper,
                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: none;
                }

                /* Second-level submenu padding for desktop - only direct children of top-level li */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' > ul > li > ul:not(ul ul)'; ?> {
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }

                /* active color ends.. */

            }

            /* TABLET AND MOBILE narrow styles */
            @media screen and (max-width: 1024px) {

                .menu.<?php echo esc_attr($unique_class_css); ?>>ul,
                .menu-righticon {
                    display: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper'; ?> {
                    position: relative;
                    display: flex;
                    flex-wrap: wrap;
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper>label.submenu-toggle-label'; ?> {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    position: relative;
                    z-index: 2;
                    line-height: 1.6;
                }

                /* Remove padding for all submenu depths on mobile */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    padding: 0;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.submenu-toggle-label'; ?> {
                    line-height: 1.6;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul'; ?> {
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul>li>ul>li>.menu-item-wrapper>label>span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

                /* Apply arrow alignment and styling to all submenu depths */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li>.menu-item-wrapper > label > span.submenu-arrow'; ?> {
                    float: right;
                    font-size: <?php echo esc_attr($settings['lf_arrow_size']['size'] . $settings['lf_arrow_size']['unit']); ?>;
                }

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
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-arrow'; ?> {
                    transform: rotate(0deg);
                    transition: transform 0.3s ease;
                    display: inline-block;
                    color: #333;
                }

                .menu.<?php echo esc_attr($unique_class_css) . '.submenu-toggle-label'; ?> {
                    cursor: pointer;
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                /* Arrow rotation when checked - consolidated rule for all levels */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked + .submenu-toggle-label .submenu-arrow'; ?> {
                    transform: rotate(180deg) !important;
                }

                /* Ensure submenu dropdowns open at all depths when toggles are checked */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li ul li ul li .submenu-toggle:checked ~ .menu-dropdown'; ?> {
                    display: block;
                    animation: grow 0.3s ease-in-out;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(1) {
                    transform: rotate(45deg);
                    position: absolute;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(2) {
                    top: 10px;
                    opacity: 0;
                }

                #<?php echo esc_attr($menu_id); ?>:checked+.lf-hamburger span:nth-child(3) {
                    transform: rotate(-45deg);
                    position: absolute;
                }

                .lf-hamburger {
                    display: flex;
                }

                .pixl-hamburger-wrapper-<?php echo $unique_class; ?> {
                    display: flex;
                    justify-content: <?php echo esc_attr($align_style); ?>;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul > li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Link padding for tablet and mobile (top-level only) */
                nav.menu.<?php echo esc_attr($unique_class_css) . '>ul  li ul li > .menu-item-wrapper'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' li:has(> input.submenu-toggle:checked)'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                /* Add padding to anchor tags inside list items that don't have .menu-hasdropdown class */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li:not(.menu-hasdropdown) > a'; ?> {
                    padding: <?php echo esc_attr($link_padding_mobile_css); ?>;
                }

                /* Allow pointer events on anchor tags inside dropdown items for mobile interaction */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li.menu-hasdropdown > label > a'; ?> {
                    pointer-events: auto;
                    cursor: pointer;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper'; ?> {
                    padding-top: <?php echo esc_attr($lfsubmenu_link_padding_top); ?>px;
                    padding-bottom: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li'; ?> {
                    align-items: center;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul ul ul'; ?> {
                    padding-left: 0;
                    padding-right: 0;
                }

                /* Center contents inside labels and neutralize floats for arrow when inside label */
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 100%;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > a'; ?> {
                    display: inline-flex;
                    align-items: center;
                    justify-content: flex-start;
                    flex: 1 1 auto;
                    text-align: left;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > a'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    margin-left: <?php echo esc_attr($lfsubmenu_link_padding_left); ?>px;
                    margin-right: <?php echo esc_attr($lfsubmenu_link_padding_right); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > label.submenu-toggle-label'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > .menu-item-wrapper > a'; ?> {
                    padding-bottom: <?php echo esc_attr($lfsubmenu_link_padding_bottom); ?>px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul'; ?> {
                    border-left: none;
                    border-right: none;
                    border-bottom: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li > label.submenu-toggle-label > span.submenu-arrow'; ?>,
                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li > label.submenu-toggle-label > span.submenu-arrow'; ?> {
                    float: none;
                    margin-left: 8px;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li'; ?> {
                    border-top: 1px solid #c5c5c5ff;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li:not(:has(.menu-dropdown))'; ?> {
                    border-top: none;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li  a'; ?> {
                    text-transform: capitalize;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' a.menu-link'; ?> {
                    font-size: 16px;
                    text-transform: capitalize;
                    font-weight: normal !important;
                }

                nav.menu.<?php echo esc_attr($unique_class_css) . ' ul li ul li.menu-item:not(.menu-hasdropdown):not(.menu-hasflyout) > .menu-item-wrapper'; ?> {
                    border-top: none !important;
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
                                const event = new Event('change', {
                                    bubbles: true
                                });
                                checkbox.dispatchEvent(event);
                            }
                        }
                    });
                });
            });
        </script>

        <div class="lf-pixl-nav-wrapper">
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
        </div>
<?php
    }
}

?>