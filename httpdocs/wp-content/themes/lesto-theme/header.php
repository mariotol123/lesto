<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lesto-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<?php 
	// Ottieni il video background dalle opzioni del sito (ACF)
	$background_video = get_field('background_video', 'option');
	
	if ($background_video && (is_page_template('template-home.php') || is_front_page())): 
	?>
	<!-- Video Background dalle opzioni del sito -->
	<video autoplay muted loop id="background-video">
		<source src="<?php echo esc_url($background_video['url']); ?>" type="<?php echo esc_attr($background_video['mime_type']); ?>">
		Your browser does not support the video tag.
	</video>
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<!-- Logo a sinistra -->
				   <div class="col-4 col-md-5 d-flex align-items-center justify-content-between">
					   <div class="site-logo">
						   <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							   <img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="<?php bloginfo('name'); ?>" class="img-fluid">
						   </a>
					   </div>
					   <!-- Hamburger menu visibile solo su mobile, accanto al logo -->
					   <img src="<?php echo get_template_directory_uri(); ?>/images/Vector (1).png" alt="Menu" class="" id="hamburger-menu">
				   </div>
				   <!-- Container bottoni a destra -->
				   <div class="col-4 col-md-7">
					   <div class="header-buttons">
						<div class="d-flex position-relative align-items-center justify-content-between w-100 main-buttons-container">
						   <?php
						   wp_nav_menu( array(
							   'theme_location' => 'header-menu',
							   'container'      => false,
							   'items_wrap'     => '<div class="menu-main-group d-flex">%3$s</div>',
							   'walker'         => new Header_Menu_Walker(),
							   'fallback_cb'    => function() {
								   // Fallback se non è stato configurato il menu
								   echo '<div class="menu-main-group d-flex">';
								   echo '<button type="button" class="btn btn-header-custom" id="settori-btn">';
								   echo '<img class="icon" src="' . get_template_directory_uri() . '/images/Group 1.png" alt="icon" />';
								   echo '<span>Settori</span>';
								   echo '</button>';
								   echo '<button type="button" class="btn btn-header-custom" id="servizi-btn">';
								   echo '<img class="icon" src="' . get_template_directory_uri() . '/images/Group 1.png" alt="icon" />';
								   echo '<span>Servizi</span>';
								   echo '</button>';
								   echo '<button type="button" class="btn btn-header-custom" id="realizzazioni-btn">';
								   echo '<img class="icon" src="' . get_template_directory_uri() . '/images/Group 1.png" alt="icon" />';
								   echo '<span>Realizzazioni</span>';
								   echo '</button>';
								   echo '</div>';
								   echo '<div class="menu-contatti-item">';
								   echo '<button type="button" class="btn btn-header-custom" id="contatti-btn">';
								   echo '<img class="icon" src="' . get_template_directory_uri() . '/images/Group 1.png" alt="icon" />';
								   echo '<span>Contatti</span>';
								   echo '</button>';
								   echo '</div>';
							   }
						   ) );
						   ?>
					   </div>
					   </div>
				   </div>
				   
			</div>
		</div>
	</header><!-- #masthead -->
</header><!-- #masthead -->


