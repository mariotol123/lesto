<?php
/**
 * lesto-theme Theme Customizer
 *
 * @package lesto-theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lesto_theme_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'lesto_theme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'lesto_theme_customize_partial_blogdescription',
			)
		);
	}

	// Footer Section
	$wp_customize->add_section( 'lesto_footer_section', array(
		'title'    => __( 'Footer Settings', 'lesto-theme' ),
		'priority' => 120,
	) );

	// Footer Navigation Section
	$wp_customize->add_section( 'lesto_footer_navigation', array(
		'title'    => __( 'Footer Navigation', 'lesto-theme' ),
		'priority' => 119,
	) );

	// Footer Menu Items
	$default_menu_items = array(
		1 => array( 'label' => 'Home', 'url' => home_url('/') ),
		2 => array( 'label' => 'Chi Siamo', 'url' => home_url('/chi-siamo') ),
		3 => array( 'label' => 'Servizi', 'url' => home_url('/servizi') ),
		4 => array( 'label' => 'Portfolio', 'url' => home_url('/portfolio') ),
		5 => array( 'label' => 'Blog', 'url' => home_url('/blog') ),
		6 => array( 'label' => 'Contatti', 'url' => home_url('/contatti') ),
	);

	for ( $i = 1; $i <= 6; $i++ ) {
		// Menu Item Label
		$wp_customize->add_setting( "lesto_footer_menu_label_{$i}", array(
			'default'           => isset( $default_menu_items[$i] ) ? $default_menu_items[$i]['label'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "lesto_footer_menu_label_{$i}", array(
			'label'   => sprintf( __( 'Menu Item %d - Label', 'lesto-theme' ), $i ),
			'section' => 'lesto_footer_navigation',
			'type'    => 'text',
		) );

		// Menu Item URL
		$wp_customize->add_setting( "lesto_footer_menu_url_{$i}", array(
			'default'           => isset( $default_menu_items[$i] ) ? $default_menu_items[$i]['url'] : '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( "lesto_footer_menu_url_{$i}", array(
			'label'   => sprintf( __( 'Menu Item %d - URL', 'lesto-theme' ), $i ),
			'section' => 'lesto_footer_navigation',
			'type'    => 'url',
		) );
	}

	// Company Information Panel
	$wp_customize->add_panel( 'lesto_company_panel', array(
		'title'       => __( 'Company Information', 'lesto-theme' ),
		'description' => __( 'Manage company details displayed in the footer', 'lesto-theme' ),
		'priority'    => 121,
	) );

	// Company Info Section
	$wp_customize->add_section( 'lesto_company_info', array(
		'title' => __( 'Company Details', 'lesto-theme' ),
		'panel' => 'lesto_company_panel',
	) );

	// Company Name
	$wp_customize->add_setting( 'lesto_company_name', array(
		'default'           => 'Lesto Srl',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_company_name', array(
		'label'   => __( 'Company Name', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'text',
	) );

	// P.IVA
	$wp_customize->add_setting( 'lesto_company_piva', array(
		'default'           => '12345678901',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_company_piva', array(
		'label'   => __( 'P.IVA', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'text',
	) );

	// P.IVA URL
	$wp_customize->add_setting( 'lesto_company_piva_url', array(
		'default'           => 'https://www.example.com/piva',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_company_piva_url', array(
		'label'   => __( 'P.IVA URL', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'url',
	) );

	// Codice Fiscale
	$wp_customize->add_setting( 'lesto_company_codfisc', array(
		'default'           => '12345678901',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_company_codfisc', array(
		'label'   => __( 'Codice Fiscale', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'text',
	) );

	// Codice Fiscale URL
	$wp_customize->add_setting( 'lesto_company_codfisc_url', array(
		'default'           => 'https://www.example.com/codfisc',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_company_codfisc_url', array(
		'label'   => __( 'Codice Fiscale URL', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'url',
	) );

	// REA
	$wp_customize->add_setting( 'lesto_company_rea', array(
		'default'           => 'MI-1234567',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_company_rea', array(
		'label'   => __( 'REA', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'text',
	) );

	// REA URL
	$wp_customize->add_setting( 'lesto_company_rea_url', array(
		'default'           => 'https://www.example.com/rea',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_company_rea_url', array(
		'label'   => __( 'REA URL', 'lesto-theme' ),
		'section' => 'lesto_company_info',
		'type'    => 'url',
	) );

	// Social Media Section
	$wp_customize->add_section( 'lesto_social_media', array(
		'title' => __( 'Social Media', 'lesto-theme' ),
		'panel' => 'lesto_company_panel',
	) );

	// Facebook URL
	$wp_customize->add_setting( 'lesto_facebook_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_facebook_url', array(
		'label'   => __( 'Facebook URL', 'lesto-theme' ),
		'section' => 'lesto_social_media',
		'type'    => 'url',
	) );

	// Instagram URL
	$wp_customize->add_setting( 'lesto_instagram_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_instagram_url', array(
		'label'   => __( 'Instagram URL', 'lesto-theme' ),
		'section' => 'lesto_social_media',
		'type'    => 'url',
	) );

	// LinkedIn URL
	$wp_customize->add_setting( 'lesto_linkedin_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_linkedin_url', array(
		'label'   => __( 'LinkedIn URL', 'lesto-theme' ),
		'section' => 'lesto_social_media',
		'type'    => 'url',
	) );

	// Twitter URL
	$wp_customize->add_setting( 'lesto_twitter_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_twitter_url', array(
		'label'   => __( 'Twitter URL', 'lesto-theme' ),
		'section' => 'lesto_social_media',
		'type'    => 'url',
	) );

	// Contact Information Section
	$wp_customize->add_section( 'lesto_contact_info', array(
		'title' => __( 'Contact Information', 'lesto-theme' ),
		'panel' => 'lesto_company_panel',
	) );

	// Address
	$wp_customize->add_setting( 'lesto_address', array(
		'default'           => 'Via Roma 123, Milano',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_address', array(
		'label'   => __( 'Address', 'lesto-theme' ),
		'section' => 'lesto_contact_info',
		'type'    => 'text',
	) );

	// Address URL (Google Maps)
	$wp_customize->add_setting( 'lesto_address_url', array(
		'default'           => 'https://www.google.com/maps?q=Via+Roma+123,+Milano',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'lesto_address_url', array(
		'label'   => __( 'Address URL (Google Maps)', 'lesto-theme' ),
		'section' => 'lesto_contact_info',
		'type'    => 'url',
	) );

	// Phone
	$wp_customize->add_setting( 'lesto_phone', array(
		'default'           => '+39 02 1234 5678',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_phone', array(
		'label'   => __( 'Phone Number', 'lesto-theme' ),
		'section' => 'lesto_contact_info',
		'type'    => 'text',
	) );

	// Phone Link (for tel: protocol)
	$wp_customize->add_setting( 'lesto_phone_link', array(
		'default'           => '+390212345678',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_phone_link', array(
		'label'       => __( 'Phone Link (for tel: protocol)', 'lesto-theme' ),
		'description' => __( 'Phone number without spaces for tel: links', 'lesto-theme' ),
		'section'     => 'lesto_contact_info',
		'type'        => 'text',
	) );

	// Email
	$wp_customize->add_setting( 'lesto_email', array(
		'default'           => 'info@lesto.it',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'lesto_email', array(
		'label'   => __( 'Email', 'lesto-theme' ),
		'section' => 'lesto_contact_info',
		'type'    => 'email',
	) );

	// PEC Email
	$wp_customize->add_setting( 'lesto_pec_email', array(
		'default'           => 'pec@lesto.it',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'lesto_pec_email', array(
		'label'   => __( 'PEC Email', 'lesto-theme' ),
		'section' => 'lesto_contact_info',
		'type'    => 'email',
	) );

	// Copyright Section
	$wp_customize->add_section( 'lesto_copyright_info', array(
		'title' => __( 'Copyright Information', 'lesto-theme' ),
		'panel' => 'lesto_company_panel',
	) );

	// Copyright Text
	$wp_customize->add_setting( 'lesto_copyright_text', array(
		'default'           => 'Lesto Group S.A.S di Martino Accongiagioco & C. | Sede legale: Via Volterra,12 – 20146 – Milano (MI) | Pec: lestogroupsas@pro-pec.it | P.IVA: 12986630965',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'lesto_copyright_text', array(
		'label'   => __( 'Copyright Text', 'lesto-theme' ),
		'section' => 'lesto_copyright_info',
		'type'    => 'textarea',
	) );

	// Footer Credit
	$wp_customize->add_setting( 'lesto_footer_credit', array(
		'default'           => '@wndr',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'lesto_footer_credit', array(
		'label'   => __( 'Footer Credit', 'lesto-theme' ),
		'section' => 'lesto_copyright_info',
		'type'    => 'text',
	) );
}
add_action( 'customize_register', 'lesto_theme_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function lesto_theme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function lesto_theme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lesto_theme_customize_preview_js() {
	wp_enqueue_script( 'lesto-theme-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'lesto_theme_customize_preview_js' );
