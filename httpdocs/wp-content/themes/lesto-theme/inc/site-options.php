<?php
/**
 * Site Options Functions
 * Configure ACF Options Pages for Site Settings
 * 
 * @package lesto-theme
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Create Site Settings Options Page
 */
function lesto_create_site_settings_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Impostazioni Sito',
            'menu_title' => 'Opzioni Sito',
            'menu_slug' => 'site-settings',
            'capability' => 'edit_posts',
            'redirect' => false,
            'icon_url' => 'dashicons-admin-generic'
        ));
    }
}
add_action('acf/init', 'lesto_create_site_settings_page');

/**
 * Add ACF Fields for Site Options programmatically
 */
function lesto_add_site_options_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group(array(
            'key' => 'group_site_options',
            'title' => 'Impostazioni Sito',
            'fields' => array(
                array(
                    'key' => 'field_background_video',
                    'label' => 'Video Background Homepage',
                    'name' => 'background_video',
                    'type' => 'file',
                    'instructions' => 'Carica un video da utilizzare come background nella homepage. Formati supportati: MP4, WebM. Dimensione massima consigliata: 50MB.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'return_format' => 'array',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '50',
                    'mime_types' => 'mp4,webm,mov'
                ),
                array(
                    'key' => 'field_background_video_mobile',
                    'label' => 'Video Background Mobile (Opzionale)',
                    'name' => 'background_video_mobile',
                    'type' => 'file',
                    'instructions' => 'Video ottimizzato per dispositivi mobili (opzionale). Se non specificato, verrà utilizzato il video principale.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'return_format' => 'array',
                    'library' => 'all',
                    'min_size' => '',
                    'max_size' => '30',
                    'mime_types' => 'mp4,webm,mov'
                ),
                array(
                    'key' => 'field_background_video_poster',
                    'label' => 'Immagine Poster Video',
                    'name' => 'background_video_poster',
                    'type' => 'image',
                    'instructions' => 'Immagine mostrata prima del caricamento del video o come fallback.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => 'jpg,jpeg,png,webp'
                ),
                array(
                    'key' => 'field_video_autoplay',
                    'label' => 'Autoplay Video',
                    'name' => 'video_autoplay',
                    'type' => 'true_false',
                    'instructions' => 'Attiva la riproduzione automatica del video (consigliato per video background).',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'message' => '',
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Sì',
                    'ui_off_text' => 'No'
                ),
                array(
                    'key' => 'field_video_loop',
                    'label' => 'Loop Video',
                    'name' => 'video_loop',
                    'type' => 'true_false',
                    'instructions' => 'Ripeti il video in continuazione.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'message' => '',
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Sì',
                    'ui_off_text' => 'No'
                ),
                array(
                    'key' => 'field_video_muted',
                    'label' => 'Video Muto',
                    'name' => 'video_muted',
                    'type' => 'true_false',
                    'instructions' => 'Mantieni il video senza audio (richiesto per autoplay su molti browser).',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'message' => '',
                    'default_value' => 1,
                    'ui' => 1,
                    'ui_on_text' => 'Sì',
                    'ui_off_text' => 'No'
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'site-settings'
                    )
                )
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => ''
        ));
    }
}
add_action('acf/init', 'lesto_add_site_options_fields');

/**
 * Helper function to get background video settings
 */
function lesto_get_background_video_settings() {
    if (!function_exists('get_field')) {
        return false;
    }
    
    $settings = array(
        'video' => get_field('background_video', 'option'),
        'video_mobile' => get_field('background_video_mobile', 'option'),
        'poster' => get_field('background_video_poster', 'option'),
        'autoplay' => get_field('video_autoplay', 'option'),
        'loop' => get_field('video_loop', 'option'),
        'muted' => get_field('video_muted', 'option')
    );
    
    return $settings;
}

/**
 * Render background video HTML
 */
function lesto_render_background_video($css_class = 'background-video') {
    $settings = lesto_get_background_video_settings();
    
    if (!$settings || !$settings['video']) {
        return false;
    }
    
    $video = $settings['video'];
    $video_mobile = $settings['video_mobile'];
    $poster = $settings['poster'];
    $autoplay = $settings['autoplay'] ? 'autoplay' : '';
    $loop = $settings['loop'] ? 'loop' : '';
    $muted = $settings['muted'] ? 'muted' : '';
    $poster_url = $poster ? esc_url($poster['url']) : '';
    
    ?>
    <div class="<?php echo esc_attr($css_class); ?>">
        <video 
            class="video-background" 
            <?php echo $autoplay; ?> 
            <?php echo $loop; ?> 
            <?php echo $muted; ?>
            playsinline
            <?php if ($poster_url): ?>poster="<?php echo $poster_url; ?>"<?php endif; ?>
        >
            <?php if ($video_mobile): ?>
            <source src="<?php echo esc_url($video_mobile['url']); ?>" type="<?php echo esc_attr($video_mobile['mime_type']); ?>" media="(max-width: 768px)">
            <?php endif; ?>
            <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
            
            <!-- Fallback per browser che non supportano i video -->
            <?php if ($poster_url): ?>
            <img src="<?php echo $poster_url; ?>" alt="Video Background" class="video-fallback">
            <?php endif; ?>
        </video>
    </div>
    <?php
    
    return true;
}
