<?php
/**
 * Plugin Name: ZenStaging - Search Engine Blocker
 * Plugin URI: https://zencodesolutions.com/
 * Description: Forces the "discourage search engines" option with maximum priority and displays a warning notice in the admin dashboard to prevent staging sites from being indexed.
 * Version: 1.0.3
 * Author: ZenCode Solutions
 * License: GPL v2 or later
 * Text Domain: zenstaging
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main ZenStaging plugin class
 * Handles forcing search engine discouragement and admin notices
 */
class ZenStaging {
    
    /**
     * Initialize the plugin
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialize plugin functionality
     */
    public function init() {
        // Force search engine discouragement with maximum priority
        add_action('wp_loaded', array($this, 'force_search_engine_discouragement'), PHP_INT_MAX);
        
        // Add admin notice
        add_action('admin_notices', array($this, 'show_admin_notice'));
        
        // Add admin styles for the notice
        add_action('admin_head', array($this, 'admin_notice_styles'));
        
        // Add custom admin bar styles
        add_action('admin_head', array($this, 'admin_bar_styles'));
        add_action('wp_head', array($this, 'admin_bar_styles'));
        
        // Prevent the option from being changed via admin interface
        add_filter('pre_update_option_blog_public', array($this, 'prevent_blog_public_change'), PHP_INT_MAX, 3);
        
        // Enable maintenance mode for non-admins
        add_action('template_redirect', array($this, 'maybe_enable_maintenance_mode'), 0);
        add_action('admin_init', array($this, 'maybe_enable_maintenance_mode'), 0);
    }
    
    /**
     * Force the blog_public option to 0 (discourage search engines)
     * Uses maximum priority to ensure it runs after all other hooks
     */
    public function force_search_engine_discouragement() {
        // Force the option to 0 (discourage search engines)
        if (get_option('blog_public') !== '0') {
            update_option('blog_public', '0');
        }
        
        // Also hook into the option filter to ensure it always returns 0
        add_filter('option_blog_public', array($this, 'force_blog_public_zero'), PHP_INT_MAX);
    }
    
    /**
     * Filter to always return 0 for blog_public option
     * 
     * @param mixed $value The option value
     * @return string Always returns '0'
     */
    public function force_blog_public_zero($value) {
        return '0';
    }
    
    /**
     * Prevent the blog_public option from being changed
     * 
     * @param mixed $value The new value
     * @param mixed $old_value The old value
     * @param string $option The option name
     * @return string Always returns '0'
     */
    public function prevent_blog_public_change($value, $old_value, $option) {
        return '0';
    }
    
    /**
     * Display admin notice warning about search engine discouragement
     */
    public function show_admin_notice() {
        ?>
        <div class="notice zenstaging-notice">
            <p>
                <strong><?php _e('⚠️ ATTENZIONE: SITO IN STAGING', 'zenstaging'); ?></strong><br>
                <?php _e('Il plugin ZenStaging è attivo e sta forzando l\'opzione "Scoraggia i motori di ricerca" per impedire l\'indicizzazione di questo sito.', 'zenstaging'); ?>
            </p>
        </div>
        <?php
    }
    
    /**
     * Add custom CSS styles for the admin notice
     */
    public function admin_notice_styles() {
        ?>
        <style type="text/css">
        .zenstaging-notice {
            background-color: #dc3232 !important;
            border-left: 4px solid #a00 !important;
            color: #ffffff !important;
            padding: 12px !important;
            margin: 5px 0 15px 0 !important;
            font-weight: bold !important;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
        }
        
        .zenstaging-notice p {
            margin: 0 !important;
            color: #ffffff !important;
        }
        
        .zenstaging-notice strong {
            font-size: 16px !important;
            color: #ffffff !important;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5) !important;
        }
        </style>
        <?php
    }
      /**
     * Add custom CSS styles for the admin bar and sidebar to make them dark red
     */
    public function admin_bar_styles() {
        ?>
        <style type="text/css">
        /* Admin bar dark red styling */
        <?php if (is_admin_bar_showing()): ?>
        #wpadminbar {
            background: #722f37 !important;
            background: linear-gradient(to bottom, #722f37 0%, #5a252a 100%) !important;
        }
        
        #wpadminbar .ab-top-menu > li.hover > .ab-item,
        #wpadminbar.nojq .quicklinks .ab-top-menu > li > .ab-item:focus,
        #wpadminbar:not(.mobile) .ab-top-menu > li:hover > .ab-item,
        #wpadminbar:not(.mobile) .ab-top-menu > li > .ab-item:focus {
            background: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #wpadminbar .ab-top-menu > li.hover > .ab-item,
        #wpadminbar .ab-top-menu > li:hover > .ab-item,
        #wpadminbar .ab-top-menu > li > .ab-item:focus {
            background: #8b2635 !important;
        }
        
        #wpadminbar .ab-submenu .ab-item:hover,
        #wpadminbar .ab-submenu .ab-item:focus {
            background: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #wpadminbar .quicklinks .menupop ul li .ab-item:hover,
        #wpadminbar .quicklinks .menupop ul li .ab-item:focus {
            background: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #wpadminbar .ab-top-secondary .menupop .ab-item:hover,
        #wpadminbar .ab-top-secondary .menupop .ab-item:focus {
            background: #8b2635 !important;
        }
        
        /* Dropdown menu styling */
        #wpadminbar .ab-submenu {
            background: #5a252a !important;
        }
        
        #wpadminbar .quicklinks .menupop ul {
            background: #5a252a !important;
        }
        
        /* Search box styling */
        #wpadminbar #adminbarsearch:before {
            color: #ffffff !important;
        }
        
        #wpadminbar > #wp-toolbar > #wp-admin-bar-top-secondary > #wp-admin-bar-search #adminbarsearch input.adminbar-input {
            background: rgba(255,255,255,0.2) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            color: #ffffff !important;
        }
        
        #wpadminbar > #wp-toolbar > #wp-admin-bar-top-secondary > #wp-admin-bar-search #adminbarsearch input.adminbar-input:focus {
            background: rgba(255,255,255,0.3) !important;
            border-color: rgba(255,255,255,0.5) !important;
        }
        <?php endif; ?>
        
        /* Admin sidebar dark red styling */
        <?php if (is_admin()): ?>
        /* Main admin menu background */
        #adminmenu,
        #adminmenuback,
        #adminmenuwrap {
            background: #722f37 !important;
        }
        
        /* Menu items */
        #adminmenu li.menu-top {
            border-color: #5a252a !important;
        }
        
        #adminmenu .wp-menu-arrow {
            background: #722f37 !important;
            border-color: #5a252a !important;
        }
        
        #adminmenu .wp-menu-arrow div {
            background: #722f37 !important;
            border-color: #5a252a !important;
        }
        
        /* Menu links */
        #adminmenu a {
            color: #ffffff !important;
        }
        
        #adminmenu div.wp-menu-name {
            color: #ffffff !important;
        }
        
        /* Hover states */
        #adminmenu .wp-menu-open .wp-menu-toggle,
        #adminmenu .wp-has-current-submenu .wp-menu-toggle,
        #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
        #adminmenu li.current a.menu-top,
        #adminmenu li.wp-has-current-submenu .wp-submenu .wp-submenu-head,
        .folded #adminmenu li.current.menu-top,
        .folded #adminmenu li.wp-has-current-submenu {
            background: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #adminmenu li.menu-top:hover,
        #adminmenu li.opensub > a.menu-top,
        #adminmenu li > a.menu-top:focus {
            background-color: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #adminmenu li.menu-top:hover div.wp-menu-name,
        #adminmenu li.opensub > a.menu-top div.wp-menu-name,
        #adminmenu li > a.menu-top:focus div.wp-menu-name {
            color: #ffffff !important;
        }
        
        /* Submenu styling */
        #adminmenu .wp-submenu {
            background-color: #5a252a !important;
        }
        
        #adminmenu .wp-submenu a {
            color: #ffffff !important;
        }
        
        #adminmenu .wp-submenu a:hover,
        #adminmenu .wp-submenu a:focus {
            background-color: #8b2635 !important;
            color: #ffffff !important;
        }
        
        #adminmenu .wp-submenu li.current a,
        #adminmenu .wp-submenu li.current a:hover,
        #adminmenu .wp-submenu li.current a:focus {
            background-color: #8b2635 !important;
            color: #ffffff !important;
        }
        
        /* Separator lines */
        #adminmenu li.wp-menu-separator {
            background: #5a252a !important;
            border-color: #5a252a !important;
        }
        
        /* Collapse menu button */
        #collapse-button {
            color: #ffffff !important;
        }
        
        #collapse-button:hover,
        #collapse-button:focus {
            background: #8b2635 !important;
            color: #ffffff !important;
        }
        
        /* Menu icons */
        #adminmenu .wp-menu-image:before {
            color: #ffffff !important;
        }
        
        #adminmenu li.menu-top:hover .wp-menu-image:before,
        #adminmenu li.opensub > a.menu-top .wp-menu-image:before,
        #adminmenu li > a.menu-top:focus .wp-menu-image:before {
            color: #ffffff !important;
        }
        
        /* Current page indicator */
        #adminmenu .current div.wp-menu-image:before,
        #adminmenu .wp-has-current-submenu div.wp-menu-image:before,
        #adminmenu a.current:hover div.wp-menu-image:before,
        #adminmenu a.wp-has-current-submenu:hover div.wp-menu-image:before,
        #adminmenu li.wp-has-current-submenu a:focus div.wp-menu-image:before,
        #adminmenu li.wp-has-current-submenu.opensub div.wp-menu-image:before,
        #adminmenu li.wp-has-current-submenu:hover div.wp-menu-image:before {
            color: #ffffff !important;
        }
        <?php endif; ?>
        </style>
        <?php
    }
    
    /**
     * Maintenance mode: block access to non-logged-in users with a custom HTML page
     * Shows a minimal HTML5 page with a noindex meta and a fixed title/message
     */
    public function maybe_enable_maintenance_mode() {
        // Allow access for any logged-in user and AJAX/cron requests
        if (
            is_user_logged_in() ||
            (defined('DOING_AJAX') && DOING_AJAX) ||
            (defined('DOING_CRON') && DOING_CRON)
        ) {
            return;
        }

        // Output maintenance page and stop further processing
        if (!headers_sent()) {
            header('HTTP/1.1 503 Service Unavailable');
            header('Content-Type: text/html; charset=utf-8');
        }
        echo "<!DOCTYPE html>\n";
        echo "<html lang='it'>\n<head>\n";
        echo "<meta charset='utf-8' />\n";
        echo "<meta name='robots' content='noindex, nofollow' />\n";
        echo "<title>staging - accesso limitato</title>\n";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1' />\n";
        echo "</head>\n<body style='background:#fff;color:#222;font-family:sans-serif;text-align:center;padding-top:10vh;'>\n";
        echo "<h1 style='font-size:2em;'>staging - accesso limitato</h1>\n";
        echo "</body>\n</html>";
        exit;
    }
}

// Initialize the plugin
new ZenStaging();

/**
 * Plugin activation hook
 * Forces the search engine discouragement option on activation
 */
register_activation_hook(__FILE__, 'zenstaging_activate');
function zenstaging_activate() {
    update_option('blog_public', '0');
}

/**
 * Plugin deactivation hook
 * Note: We don't re-enable search engines on deactivation for safety
 */
register_deactivation_hook(__FILE__, 'zenstaging_deactivate');
function zenstaging_deactivate() {
    // We intentionally do NOT re-enable search engines when deactivating
    // This is a safety measure to prevent accidental indexing
    // Site administrators must manually re-enable search engines if needed
}
