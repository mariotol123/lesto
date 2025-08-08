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
		<div class="container">
			<div class="row align-items-center">
				<!-- Logo a sinistra -->
				   <div class="col-4 col-md-5 d-flex align-items-center justify-content-between">
					   <div class="site-logo">
						   <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							   <img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="<?php bloginfo('name'); ?>" class="img-fluid">
						   </a>
					   </div>
					   <!-- Hamburger menu visibile solo su mobile, accanto al logo -->
					   <img src="<?php echo get_template_directory_uri(); ?>/images/Vector (1).png" alt="Menu" class="img-fluid d-block d-md-none" style="width: 40px; height: 40px; cursor: pointer;" id="hamburger-menu">
				   </div>
				   <!-- Container bottoni a destra -->
				   <div class="col-4 col-md-7 header-buttons">
					   <div class="d-flex position-relative align-items-center justify-content-between w-100">
						   <!-- Bottoni visibili solo su desktop -->
						   <div class="main-buttons d-none d-md-flex">
							   <button type="button" class="btn btn-header-custom" id="settori-btn">
								   <span>Settori</span>
							   </button>
							   <button type="button" class="btn btn-header-custom" id="servizi-btn">
								   <span>Servizi</span>
							   </button>
							   <button type="button" class="btn btn-header-custom" id="realizzazioni-btn">
								   <span>Realizzazioni</span>
							   </button>
						   </div>
						   <div class="contatti-button ms-3 align-self-end d-none d-md-flex">
							   <button type="button" class="btn btn-header-custom" id="contatti-btn">
								   <span>Contatti</span>
							   </button>
						   </div>
					   </div>
				   </div>
				   
			</div>
		</div>
	</header><!-- #masthead -->

		<!-- JS per il dropdown menu header ora incluso da js/menu-dropdown.js -->

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		var serviziToggle = document.getElementById('servizi-toggle');
		var dropdownMenu = document.querySelector('.dropdown-servizi-menu');
		serviziToggle.addEventListener('click', function(e) {
			e.preventDefault();
			if (dropdownMenu.style.display === 'block') {
				dropdownMenu.style.display = 'none';
			} else {
				dropdownMenu.style.display = 'block';
			}
		});
		document.addEventListener('click', function(e) {
			if (!serviziToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
				dropdownMenu.style.display = 'none';
			}
		});
	});
	</script>
