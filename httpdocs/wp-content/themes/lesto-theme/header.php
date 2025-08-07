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

	<?php if (is_page_template('template-home.php')): ?>
	<!-- Video Background solo per la home page -->
	<video autoplay muted loop id="background-video">
		<source src="<?php echo get_template_directory_uri(); ?>/videos/6613032-hd_1920_1080_25fps (1).mp4" type="video/mp4">
		Your browser does not support the video tag.
	</video>
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<div class="container mt-3">
			<div class="row align-items-center">
				<!-- Logo a sinistra -->
				<div class="col-4 col-md-5">
					<div class="site-logo">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="<?php bloginfo('name'); ?>" class="img-fluid">
						</a>
					</div>
				</div>
				
				<!-- Container bottoni a destra -->
				<div class="col-4 col-md-7">
					<div class="header-buttons d-flex justify-content-between align-items-center">
						<!-- Container per i primi 3 bottoni -->
						<div class="main-buttons d-flex">
							<button type="button" class="btn btn-header-custom">
								<span>Settori</span>
							</button>
							<button type="button" class="btn btn-header-custom">
								<span>Servizi</span>
							</button>
							<button type="button" class="btn btn-header-custom">
								<span>Realizzazioni</span>
							</button>
						</div>
						
						<!-- Bottone in fondo alla colonna -->
						<div class="bottom-button">
							<button type="button" class="btn btn-header-custom">
								<span>Contatti</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
