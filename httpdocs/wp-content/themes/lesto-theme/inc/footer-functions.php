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
                echo '<a href="' . esc_url($manual_url) . '" class="m_h5">' . $text . '</a>';
            } else {
                // For contacts and company: show text + clickable auto_link
                echo '<span class="m_h5">' . $text . '</span> ';
                if (!empty($auto_link)) {
                    echo '<a href="' . esc_url($manual_url) . '" target="_blank" rel="noopener">' . esc_html($auto_link) . '</a>';
                } else {
                    echo '<a href="' . esc_url($manual_url) . '" target="_blank" rel="noopener">' . esc_html($manual_url) . '</a>';
                }
            }
        } else if (!empty($auto_link)) {
            if ($behavior === 'clickable_text') {
                // Simple text display for navigation/social without manual URL
                echo '<span class="m_h5">' . $text . '</span>';
            } else {
                // For contacts: auto-detect link types, for company: plain text
                echo '<span class="m_h5">' . $text . '</span> ';
                if ($link_field === 'contatti_link') {
                    echo lesto_render_smart_link($auto_link);
                } else {
                    echo esc_html($auto_link);
                }
            }
        } else {
            // Only text
            echo '<span class="m_h5">' . $text . '</span>';
        }
        
        echo '</li>';
    }
    
    echo '</ul>';
    return true;
}

/**
 * Check if a string looks like an address
 * 
 * @param string $text The text to check
 * @return bool True if it looks like an address
 */
function lesto_is_address($text) {
    $text = strtolower(trim($text));
    
    // Skip if it's clearly an email, phone, or URL
    if (filter_var($text, FILTER_VALIDATE_EMAIL) || 
        preg_match('/^[\+]?[0-9\s\-\(\)\.]{7,20}$/', $text) ||
        filter_var($text, FILTER_VALIDATE_URL) ||
        strpos($text, 'www.') === 0) {
        return false;
    }
    
    // Italian street indicators
    $street_indicators = array(
        'via', 'viale', 'corso', 'piazza', 'largo', 'vicolo', 'strada', 'località',
        'frazione', 'borgo', 'rione', 'contrada', 'salita', 'discesa', 'circonvallazione',
        'lungotevere', 'lungomare', 'passeggiata', 'galleria', 'sottopasso',
        'v.', 'c.so', 'p.za', 'str.', 'loc.', 'fraz.', 'c.da'
    );
    
    // Check if contains street indicators
    $has_street_indicator = false;
    foreach ($street_indicators as $indicator) {
        if (strpos($text, $indicator . ' ') === 0 || 
            strpos($text, ' ' . $indicator . ' ') !== false) {
            $has_street_indicator = true;
            break;
        }
    }
    
    // Must have a street indicator AND a number AND reasonable length
    $has_number = preg_match('/\b\d+\b/', $text);
    $reasonable_length = strlen($text) > 5 && strlen($text) < 200;
    
    // Check for city indicators (common Italian cities or postal codes)
    $has_city_indicator = preg_match('/\b\d{5}\b/', $text) || // postal code
                         preg_match('/\b(milano|roma|napoli|torino|palermo|genova|bologna|firenze|bari|catania|venezia|verona|messina|padova|trieste|brescia|parma|prato|modena|reggio|perugia|livorno|ravenna|cagliari|foggia|rimini|salerno|ferrara|monza|sassari|bergamo|trento|vicenza|terni|bolzano|novara|cesena|pescara|udine|como|lucca|pistoia|pisa|cremona|cosenza|lecce|catanzaro|brindisi|andria|arezzo|siena|gorizia|massa|varese|asti|ragusa|treviso|piacenza|busto|carpi|caserta|latina|giugliano|taranto|la spezia|forli|guidonia|cinisello|aprilia|livorno|san|sant|monte|monti)\b/i', $text);
    
    return $has_street_indicator && $has_number && $reasonable_length && $has_city_indicator;
}

/**
 * Smart link renderer for contacts (auto-detect email, phone, URL, addresses)
 * 
 * @param string $link The link to process
 * @return string HTML for the link
 */
function lesto_render_smart_link($link) {
    $link = trim($link);
    
    // Check if it already has a protocol (mailto:, tel:, http://, etc.)
    if (strpos($link, 'mailto:') === 0 || 
        strpos($link, 'tel:') === 0 || 
        strpos($link, 'http') === 0 || 
        strpos($link, '//') === 0) {
        // It already has a protocol, use as is
        return '<a href="' . esc_url($link) . '" target="_blank" rel="noopener">' . esc_html($link) . '</a>';
    }
    
    // Auto-detect email
    if (filter_var($link, FILTER_VALIDATE_EMAIL)) {
        return '<a href="mailto:' . esc_attr($link) . '">' . esc_html($link) . '</a>';
    }
    
    // Auto-detect phone number (supports international formats)
    if (preg_match('/^[\+]?[0-9\s\-\(\)\.]{7,20}$/', $link)) {
        // Clean phone number for href (remove spaces, dashes, parentheses, dots)
        $clean_phone = preg_replace('/[^\+0-9]/', '', $link);
        return '<a href="tel:' . esc_attr($clean_phone) . '">' . esc_html($link) . '</a>';
    }
    
    // Auto-detect address (contains street indicators and numbers)
    if (lesto_is_address($link)) {
        $maps_url = 'https://www.google.com/maps/search/' . urlencode($link);
        return '<a href="' . esc_url($maps_url) . '" target="_blank" rel="noopener">' . esc_html($link) . '</a>';
    }
    
    // Auto-detect URL (with or without protocol)
    if (filter_var($link, FILTER_VALIDATE_URL) || 
        filter_var('http://' . $link, FILTER_VALIDATE_URL)) {
        $url = (strpos($link, 'http') === 0) ? $link : 'http://' . $link;
        return '<a href="' . esc_url($url) . '" target="_blank" rel="noopener">' . esc_html($link) . '</a>';
    }
    
    // If it contains @ but is not a valid email, treat as text
    if (strpos($link, '@') !== false) {
        return '<a href="mailto:' . esc_attr($link) . '">' . esc_html($link) . '</a>';
    }
    
    // If nothing matches, just display as text
    return esc_html($link);
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
 * Render footer navigation items with Page Link support
 * 
 * @param array $items Array of navigation items from ACF repeater
 * @return bool True if items were rendered, false otherwise
 */
function lesto_render_footer_navigation_items($items) {
    if (!is_array($items) || empty($items)) {
        return false;
    }
    
    echo '<ul class="footer-nav-list">';
    
    foreach ($items as $item) {
        // Check if navigation_text field exists and is not empty
        if (!isset($item['navigation_text']) || empty($item['navigation_text'])) {
            continue;
        }
        
        $text = '';
        $url = '';
        
        // Check if navigation_text is a Page Link object, array, or just text
        if (is_object($item['navigation_text'])) {
            // It's a Page Link object
            $page_object = $item['navigation_text'];
            $text = isset($page_object->post_title) ? $page_object->post_title : '';
            $url = isset($page_object->ID) ? get_permalink($page_object->ID) : '';
        } else if (is_array($item['navigation_text'])) {
            // It's a Page Link array
            $page_object = $item['navigation_text'];
            $text = isset($page_object['post_title']) ? $page_object['post_title'] : '';
            $url = isset($page_object['ID']) ? get_permalink($page_object['ID']) : '';
        } else if (is_numeric($item['navigation_text'])) {
            // It's a page ID
            $page_id = intval($item['navigation_text']);
            $text = get_the_title($page_id);
            $url = get_permalink($page_id);
        } else if (filter_var($item['navigation_text'], FILTER_VALIDATE_URL)) {
            // It's a URL - try to get the page title from the URL
            $page_id = url_to_postid($item['navigation_text']);
            if ($page_id) {
                $text = get_the_title($page_id);
                $url = $item['navigation_text'];
            } else {
                // Use the URL as text (fallback)
                $text = basename($item['navigation_text']);
                $url = $item['navigation_text'];
            }
        } else {
            // It's just text - use it as is
            $text = $item['navigation_text'];
        }
        
        // If no text was found, skip this item
        if (empty($text)) {
            continue;
        }
        
        echo '<li>';
        if (!empty($url)) {
            echo '<a href="' . esc_url($url) . '" class="m_h5">' . esc_html($text) . '</a>';
        } else {
            echo '<span class="m_h5">' . esc_html($text) . '</span>';
        }
        echo '</li>';
    }
    
    echo '</ul>';
    return true;
}

/**
 * Get Footer Navigation
 */
function lesto_get_footer_navigation() {
    $items = lesto_get_acf_footer_data('navigation_menu', 'navigation_campi');
    return lesto_render_footer_navigation_items($items);
}

/**
 * Get Footer Social
 */
function lesto_get_footer_social() {
    $items = lesto_get_acf_footer_data('social_menu', 'social_campi');
    return lesto_render_footer_items($items, 'footer-social-list', 'social_text', '', 'clickable_text');
}

/**
 * Render footer items with smart link detection (auto mailto, tel, etc.)
 * 
 * @param array $items Array of footer items
 * @param string $list_class CSS class for the ul element
 * @param string $text_field Name of the text field
 * @param string $link_field Name of the link field (optional)
 * @return bool True if items were rendered, false otherwise
 */
function lesto_render_footer_smart_items($items, $list_class, $text_field, $link_field = '') {
    if (!is_array($items) || empty($items)) {
        return false;
    }
    
    echo '<ul class="' . esc_attr($list_class) . '">';
    
    foreach ($items as $item) {
        if (!isset($item[$text_field]) || empty($item[$text_field])) {
            continue;
        }
        
        $text = esc_html($item[$text_field]);
        $link_value = '';
        
        // Get the link value if link field is specified
        if (!empty($link_field) && isset($item[$link_field]) && !empty($item[$link_field])) {
            $link_value = $item[$link_field];
        }
        
        echo '<li>';
        
        if (!empty($link_value)) {
            // Show text + smart link
            echo '<span class="m_h5">' . $text . '</span> ';
            echo lesto_render_smart_link($link_value);
        } else {
            // Only text
            echo '<span class="m_h5">' . $text . '</span>';
        }
        
        echo '</li>';
    }
    
    echo '</ul>';
    return true;
}

/**
 * Get Footer Contacts
 */
function lesto_get_footer_contacts() {
    $items = lesto_get_acf_footer_data('contatti', 'contatti_campi');
    return lesto_render_footer_smart_items($items, 'footer-contacts-list', 'contatti_text', 'contatti_link');
}

/**
 * Get Footer Company Info
 */
function lesto_get_footer_company_info() {
    $items = lesto_get_acf_footer_data('informazioni_aziendali', 'informazioni_aziendali_campi');
    return lesto_render_footer_smart_items($items, 'footer-company-list', 'informazioni_aziendali_text', 'informazioni_aziendali_link');
}
