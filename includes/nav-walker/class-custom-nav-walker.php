<?php

namespace Elementor_Addon_Pixl_Dynamics;

class Custom_Nav_Walker extends \Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n" . $indent . '<ul class="menu-dropdown lf-sub-menu-bg">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= $indent . "</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $li_classes = empty($item->classes) ? array() : (array) $item->classes;

        $has_children = in_array('menu-item-has-children', $li_classes);

        if ($has_children) {
            $li_classes[] = 'menu-hasdropdown';
        }

        if ($has_children && $depth > 0) {
            $li_classes[] = 'menu-hasflyout';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($li_classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = ! empty($item->target)     ? $item->target     : '';
        $atts['rel']    = ! empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = ! empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        

        if ($has_children) {
            $toggle_id = 'menu-toggle-' . $item->ID;
            $item_output .= ' <label for="' . esc_attr($toggle_id) . '">';

            if ($depth === 0) {
                // Top-level: down arrow for mobile/tablet always, desktop only if switcher is "yes"
                $item_output .= '<i class="fa fa-caret-down menu-arrow depth-0-arrow" data-depth="0" data-desktop="' . esc_attr($args->arrow_desktop) . '"></i>';
            } else {
                // Sub-level: only right arrow for desktop if switcher is "yes"
                $item_output .= '<i class="fa fa-caret-right menu-arrow sub-arrow" data-depth="1" data-desktop="' . esc_attr($args->arrow_desktop) . '"></i>';

                // Down arrow for mobile/tablet only — separate element
                $item_output .= '<i class="fa fa-caret-down menu-arrow sub-arrow-mobile" data-depth="1"></i>';
            }

            $item_output .= '</label>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

        if ($has_children) {
            $toggle_id = 'menu-toggle-' . $item->ID;
            $output .= $indent . '<input type="checkbox" id="' . esc_attr($toggle_id) . '">';
        }
    }


    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
