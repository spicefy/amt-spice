<?php
/**
 * Bootstrap 5 NavWalker
 * 
 * @package AMT-Spice
 */

if (defined('ABSPATH') && class_exists('Walker_Nav_Menu') && !class_exists('Bootstrap_NavWalker')) {
    class Bootstrap_NavWalker extends Walker_Nav_Menu {
        /**
         * Starts the list before the elements are added.
         */
        public function start_lvl(&$output, $depth = 0, $args = null) {
            $output .= '<ul class="dropdown-menu">';
        }

        /**
         * Starts the element output.
         */
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = 'nav-item';
            
            if (in_array('menu-item-has-children', $classes)) {
                $classes[] = 'dropdown';
            }
            
            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
            
            $output .= '<li' . $class_names . '>';
            
            $atts = array();
            $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
            $atts['href'] = !empty($item->url) ? $item->url : '';
            
            if ($depth === 0) {
                $atts['class'] = 'nav-link';
                if (in_array('menu-item-has-children', $classes)) {
                    $atts['class'] .= ' dropdown-toggle';
                    $atts['data-bs-toggle'] = 'dropdown';
                    $atts['aria-expanded'] = 'false';
                }
            } else {
                $atts['class'] = 'dropdown-item';
            }
            
            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }
            
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            
            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }
}