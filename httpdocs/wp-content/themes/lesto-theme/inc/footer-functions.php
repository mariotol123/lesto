<?php
/**
 * Footer Dynamic Functions
 * Optimized and cleaned up version
 * 
 * @package lesto-theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create Footer Settings Options Page
 */
function lesto_create_footer_settings_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Footer Settings',
            'menu_title' => 'Footer',
            'menu_slug' => 'footer-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }
}
add_action('acf/init', 'lesto_create_footer_settings_page');

/**
 * Helper function to render footer items with link logic
 * 
 * @param array $items Array of footer items
 * @param string $list_class CSS class for the ul element
 * @param string $text_field Name of the text field
 * @param string $link_field Name of the auto-link field
 * @param string $behavior 'clickable_text' or 'separate_link'
 * @return bool True if items were rendered, false otherwise
 */
function lesto_render_footer_items($items, $list_class, $text_field, $link_field = '', $behavior = 'clickable_text') {
    if (!is_array($items) || empty($items)) {
        return false;
    }
    
    echo '<ul class="' . esc_attr($list_class) . '">';
    
    foreach ($items as $item) {
        if (!isset($item[$text_field]) || empty($item[$text_field])) {
            continue;
        }
        
        $text = esc_html($item[$text_field]);
        $manual_url = isset($item['link_url']) ? $item['link_url'] : '';
        $auto_link = isset($item[$link_field]) && !empty($link_field) ? $item[$link_field] : '';
        
        echo '<li>';
        
        if (!empty($manual_url)) {
            if ($behavior === 'clickable_text') {
                // For navigation and social: make text clickable
                echo '<a href="' . esc_url($manual_url) . '">' . $text . '</a>';
            } else {
                // For contacts and company: show text + clickable auto_link
                echo $text . ' ';
                if (!empty($auto_link)) {
                    echo '<a href="' . esc_url($manual_url) . '" target="_blank" rel="noopener">' . esc_html($auto_link) . '</a>';
                } else {
                    echo '<a href="' . esc_url($manual_url) . '" target="_blank" rel="noopener">' . esc_html($manual_url) . '</a>';
                }
            }
        } else if (!empty($auto_link)) {
            if ($behavior === 'clickable_text') {
                // Simple text display for navigation/social without manual URL
                echo $text;
            } else {
                // For contacts: auto-detect link types, for company: plain text
                echo $text . ' ';
                if ($link_field === 'contatti_link') {
                    echo lesto_render_smart_link($auto_link);
                } else {
                    echo esc_html($auto_link);
                }
            }
        } else {
            // Only text
            echo $text;
        }
        
        echo '</li>';
    }
    
    echo '</ul>';
    return true;
}

/**
 * Smart link renderer for contacts (auto-detect email, phone, URL)
 * 
 * @param string $link The link to process
 * @return string HTML for the link
 */
function lesto_render_smart_link($link) {
    if (filter_var($link, FILTER_VALIDATE_URL) || 
        strpos($link, 'http') === 0 || 
        strpos($link, '/') === 0 || 
        strpos($link, 'mailto:') === 0 || 
        strpos($link, 'tel:') === 0) {
        // It's a URL
        return '<a href="' . esc_url($link) . '" target="_blank" rel="noopener">' . esc_html($link) . '</a>';
    } else if (filter_var($link, FILTER_VALIDATE_EMAIL)) {
        // It's an email
        return '<a href="mailto:' . esc_attr($link) . '">' . esc_html($link) . '</a>';
    } else if (preg_match('/^\+?[0-9\s\-\(\)]+$/', $link)) {
        // It's a phone number
        $clean_phone = preg_replace('/[^\+0-9]/', '', $link);
        return '<a href="tel:' . esc_attr($clean_phone) . '">' . esc_html($link) . '</a>';
    } else {
        // Just display as text
        return esc_html($link);
    }
}

/**
 * Generic ACF field getter with fallback
 * 
 * @param string $field_name ACF field name
 * @param string $sub_field_name Sub-field name for repeater
 * @return array|false Array of items or false if not found
 */
function lesto_get_acf_footer_data($field_name, $sub_field_name) {
    if (!function_exists('get_field')) {
        return false;
    }
    
    // Try Options Page first
    $data = get_field($field_name, 'option');
    if ($data && isset($data[$sub_field_name]) && is_array($data[$sub_field_name])) {
        return $data[$sub_field_name];
    }
    
    // Fallback to Footer Settings page
    $footer_page = get_page_by_title('Footer Settings');
    if ($footer_page) {
        $data = get_field($field_name, $footer_page->ID);
        if ($data && isset($data[$sub_field_name]) && is_array($data[$sub_field_name])) {
            return $data[$sub_field_name];
        }
    }
    
    return false;
}

/**
 * Get Footer Navigation
 */
function lesto_get_footer_navigation() {
    $items = lesto_get_acf_footer_data('navigation_menu', 'navigation_campi');
    return lesto_render_footer_items($items, 'footer-nav-list', 'navigation_text', '', 'clickable_text');
}

/**
 * Get Footer Social
 */
function lesto_get_footer_social() {
    $items = lesto_get_acf_footer_data('social_menu', 'social_campi');
    return lesto_render_footer_items($items, 'footer-social-list', 'social_text', '', 'clickable_text');
}

/**
 * Get Footer Contacts
 */
function lesto_get_footer_contacts() {
    $items = lesto_get_acf_footer_data('contatti', 'contatti_campi');
    return lesto_render_footer_items($items, 'footer-contacts-list', 'contatti_text', 'contatti_link', 'separate_link');
}

/**
 * Get Footer Company Info
 */
function lesto_get_footer_company_info() {
    $items = lesto_get_acf_footer_data('informazioni_aziendali', 'informazioni_aziendali_campi');
    return lesto_render_footer_items($items, 'footer-company-list', 'informazioni_aziendali_text', 'informazioni_aziendali_link', 'separate_link');
}
