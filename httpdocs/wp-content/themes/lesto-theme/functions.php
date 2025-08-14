
<?php
/**
 * lesto-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lesto-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lesto_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on lesto-theme, use a find and replace
		* to change 'lesto-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lesto-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'lesto-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lesto_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'lesto_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lesto_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lesto_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'lesto_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lesto_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lesto-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lesto-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lesto_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lesto_theme_scripts() {
	// Google Fonts
	wp_enqueue_style( 'google-fonts-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap', array(), null );
	
	wp_enqueue_style( 'lesto-theme-main', get_template_directory_uri() . '/css/main.css', array(), filemtime(get_template_directory() . '/css/main.css'));
	wp_enqueue_style( 'lesto-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'lesto-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'lesto-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'lesto-theme-booststrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'lesto-theme-menu-dropdown', get_template_directory_uri() . '/js/menu-dropdown.js', array(), filemtime(get_template_directory() . '/js/menu-dropdown.js'), true );
	wp_localize_script( 'lesto-theme-menu-dropdown', 'lestoTheme', array(
		'menuCloseImg' => get_template_directory_uri() . '/images/Container.png',
		'ajaxUrl' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('lesto_ajax_nonce')
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lesto_theme_scripts' );

// Enqueue main.js con dipendenza da Masonry
function lesto_enqueue_main_js() {
	wp_enqueue_script(
		'lesto-main-js',
		get_template_directory_uri() . '/js/main.js',
		array('masonry-cdn'), // dipendenza da Masonry
		null,
		true
	);
}
add_action('wp_enqueue_scripts', 'lesto_enqueue_main_js');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Registrazione Custom Post Type Settore e Servizio
 */
function lesto_register_custom_post_types() {
	// Settore
	register_post_type('settore', array(
		'labels' => array(
			'name' => __('Settori', 'lesto-theme'),
			'singular_name' => __('Settore', 'lesto-theme'),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'settori'),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'show_in_rest' => true,
	));

	// Servizio
	register_post_type('servizio', array(
		'labels' => array(
			'name' => __('Servizi', 'lesto-theme'),
			'singular_name' => __('Servizio', 'lesto-theme'),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'servizi'),
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
		'show_in_rest' => true,
	));
}
add_action('init', 'lesto_register_custom_post_types');

// Enqueue Masonry via CDN
function lesto_enqueue_masonry_cdn() {
	wp_enqueue_script(
		'masonry-cdn',
		'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js',
		array(),
		null,
		true
	);
}
add_action('wp_enqueue_scripts', 'lesto_enqueue_masonry_cdn');

/**
 * AJAX function to get posts from custom post types
 */
function lesto_get_cpt_posts() {
	// Verifica nonce per sicurezza
	if (!wp_verify_nonce($_POST['nonce'], 'lesto_ajax_nonce')) {
		wp_die('Security check failed');
	}

	$post_type = sanitize_text_field($_POST['post_type']);
	
	// Verifica che il post type sia uno di quelli permessi
	if (!in_array($post_type, array('settore', 'servizio'))) {
		wp_die('Invalid post type');
	}

	$posts = get_posts(array(
		'post_type' => $post_type,
		'numberposts' => -1,
		'post_status' => 'publish',
		'orderby' => 'title',
		'order' => 'ASC'
	));

	$response = array();
	foreach ($posts as $post) {
		$response[] = array(
			'id' => $post->ID,
			'title' => $post->post_title,
			'url' => get_permalink($post->ID)
		);
	}

	wp_send_json_success($response);
}

// Hook per utenti loggati e non loggati
add_action('wp_ajax_lesto_get_cpt_posts', 'lesto_get_cpt_posts');
add_action('wp_ajax_nopriv_lesto_get_cpt_posts', 'lesto_get_cpt_posts');

