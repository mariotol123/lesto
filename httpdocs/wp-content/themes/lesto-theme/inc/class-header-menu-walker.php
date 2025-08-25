<?php
/**
 * Custom Walker for Header Menu
 *
 * @package lesto-theme
 */

class Header_Menu_Walker extends Walker_Nav_Menu {

    /**
     * Start Level - output sub menu container
     */
    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-generale\" style=\"display: none;\">\n";
    }

    /**
     * End Level - close sub menu container
     */
    function end_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }

    /**
     * Start Element - output menu item
     */
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // For top level items (main buttons)
        if ( $depth == 0 ) {
            // Check if this is the "Contatti" item
            $is_contatti = (strtolower($item->title) === 'contatti');
            
            // Check if this item has children for dropdown functionality
            $has_children = in_array( 'menu-item-has-children', $classes );
            
            // Create unique button ID based on menu item
            $button_id = 'menu-item-' . $item->ID . '-btn';
            if ($is_contatti) {
                $button_id = 'contatti-btn';
            }
            
            // Add the icon image
            $icon_img = '<img class="icon" src="' . get_template_directory_uri() . '/images/Group 1.png" alt="icon" />';
            
            if ($is_contatti) {
                // Close main group and create separate contatti element
                $output .= '</div><div class="menu-contatti-item">';
                $output .= '<button type="button" class="btn btn-header-custom btn-small" id="' . $button_id . '">';
                $output .= $icon_img;
                $output .= '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
                $output .= '</button>';
            } else {
                // Create a wrapper div for button and its dropdown
                $output .= $indent . '<div class="menu-item menu-item-' . $item->ID . ($has_children ? ' menu-item-has-children' : '') . '">';
                
                if ($has_children) {
                    // Button with dropdown functionality and double-click link
                    $item_url = ! empty( $item->url ) ? esc_attr( $item->url ) : '';
                    $output .= '<button type="button" class="btn btn-header-custom btn-small" id="' . $button_id . '" data-url="' . $item_url . '">';
                    $output .= $icon_img;
                    $output .= '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
                    $output .= '</button>';
                } else {
                    // Link button for items without children
                    $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
                    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
                    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
                    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

                    $output .= '<a class="btn btn-header-custom btn-small"' . $attributes . '>';
                    $output .= $icon_img;
                    $output .= '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>';
                    $output .= '</a>';
                }
            }
            
            // If this item has children, we don't output the <a> tag, just the button
            // The submenu will be handled by JavaScript showing/hiding the dropdown
            
        } else {
            // For submenu items (dropdown links)
            $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

            $output .= $indent . '<li>';
            $output .= '<a class="dropdown-link"' . $attributes . '>';
            $output .= apply_filters( 'the_title', $item->title, $item->ID );
            $output .= '</a>';
        }
    }

    /**
     * End Element - close menu item
     */
    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $is_contatti = (strtolower($item->title) === 'contatti');
        
        if ( $depth == 0 && !$is_contatti ) {
            $output .= "</div>
"; // Close the wrapper div for non-contatti top-level items
        } else if ( $depth > 0 ) {
            $output .= "</li>
"; // Close list item for sub-menu items
        }
        // For contatti items, no closing div needed as it's handled in start_el
    }
}
