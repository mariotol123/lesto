<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lesto-theme
 */

?>

	<?php echo (is_front_page() ? 'ciao' : ''); ?>

	<footer id="colophon" class="site-footer">
		<div class="container footer-container pt-7xl">
	   <!-- Prima row desktop: logo, navigation, azienda -->
	   <div class="row d-none d-md-flex">
		   <div class="col-lg-3 mb-4">
			   <?php if ( has_custom_logo() ) : ?>
				   <div class="footer-logo">
					   <?php the_custom_logo(); ?>
				   </div>
			   <?php else : ?>
				   <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="Footer Logo" class="footer-logo">
			   <?php endif; ?>
		   </div>
		   <div class="col-lg-3 col-md-6 mb-4 d-flex flex-column gap-5">
			   <div class="footer-navigation mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title"><?php _e( 'Navigation', 'lesto-theme' ); ?></h4>
				   <?php
				   // Try to display navigation from ACF first
				   if (function_exists('lesto_get_footer_navigation') && lesto_get_footer_navigation()) {
					   // Navigation displayed by lesto_get_footer_navigation()
				   } elseif (has_nav_menu('footer-menu')) {
					   // Display WordPress menu if available
					   wp_nav_menu( array(
						   'theme_location' => 'footer-menu',
						   'menu_class'     => 'footer-nav-list',
						   'container'      => false,
						   'fallback_cb'    => false,
					   ) );
				   } else {
					   // Show fallback menu
					   lesto_footer_fallback_menu();
				   }
				   ?>
			   </div>
		   </div>
		   <div class="col-lg-6 col-md-6 mb-4 d-flex flex-column gap-5">
			   <div class="footer-company mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title"><?php _e( 'Informazioni aziendali', 'lesto-theme' ); ?></h4>
				   <?php
				   // Try to display company info from ACF first
				   if (function_exists('lesto_get_footer_company_info') && lesto_get_footer_company_info()) {
					   // Company info displayed by lesto_get_footer_company_info()
				   } else {
					   // Show fallback company info
					   echo '<ul class="footer-company-list">';
					   echo '<li>' . esc_html( get_theme_mod( 'lesto_company_name', 'Lesto Srl' ) ) . '</li>';
					   echo '<li>P.IVA: <a href="' . esc_url( get_theme_mod( 'lesto_company_piva_url', 'https://www.example.com/piva' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_piva', '12345678901' ) ) . '</a></li>';
					   echo '<li>Cod. Fisc.: <a href="' . esc_url( get_theme_mod( 'lesto_company_codfisc_url', 'https://www.example.com/codfisc' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_codfisc', '12345678901' ) ) . '</a></li>';
					   echo '<li>REA: <a href="' . esc_url( get_theme_mod( 'lesto_company_rea_url', 'https://www.example.com/rea' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_rea', 'MI-1234567' ) ) . '</a></li>';
					   echo '</ul>';
				   }
				   ?>
			   </div>
		   </div>
	   </div>

	   <!-- Prima row mobile: navigation e social affiancate -->
	   <!-- Logo solo mobile -->
	   <div class="row d-flex d-md-none">
		   <div class="col-12 mb-4">
			   <?php if ( has_custom_logo() ) : ?>
				   <div class="footer-logo">
					   <?php the_custom_logo(); ?>
				   </div>
			   <?php else : ?>
				   <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="Footer Logo" class="footer-logo">
			   <?php endif; ?>
		   </div>
	   </div>
	   <div class="row d-flex d-md-none">
		   <div class="col-6 mb-4">
			   <div class="footer-navigation mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title"><?php _e( 'Navigation', 'lesto-theme' ); ?></h4>
				   <?php
				   // Try to display navigation from ACF first
				   if (function_exists('lesto_get_footer_navigation') && lesto_get_footer_navigation()) {
					   // Navigation displayed by lesto_get_footer_navigation()
				   } elseif (has_nav_menu('footer-menu')) {
					   // Display WordPress menu if available
					   wp_nav_menu( array(
						   'theme_location' => 'footer-menu',
						   'menu_class'     => 'footer-nav-list',
						   'container'      => false,
						   'fallback_cb'    => false,
					   ) );
				   } else {
					   // Show fallback menu
					   lesto_footer_fallback_menu();
				   }
				   ?>
			   </div>
		   </div>
		   <div class="col-6 mb-4">
			   <div class="footer-social d-flex flex-column gap-3">
				   <h4 class="footer-title"><?php _e( 'Social', 'lesto-theme' ); ?></h4>
				   <?php
				   // Try to display social from ACF first
				   if (function_exists('lesto_get_footer_social') && lesto_get_footer_social()) {
					   // Social displayed by lesto_get_footer_social()
				   } else {
					   // Show fallback social
					   echo '<ul class="footer-social-list">';
					   $social_links = array(
						   'facebook'  => array( 'url' => get_theme_mod( 'lesto_facebook_url' ), 'label' => 'Facebook' ),
						   'instagram' => array( 'url' => get_theme_mod( 'lesto_instagram_url' ), 'label' => 'Instagram' ),
						   'linkedin'  => array( 'url' => get_theme_mod( 'lesto_linkedin_url' ), 'label' => 'LinkedIn' ),
						   'twitter'   => array( 'url' => get_theme_mod( 'lesto_twitter_url' ), 'label' => 'Twitter' ),
					   );
					   
					   foreach ( $social_links as $platform => $data ) :
						   if ( ! empty( $data['url'] ) ) : ?>
							   <li><a href="<?php echo esc_url( $data['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $data['label'] ); ?></a></li>
						   <?php else : ?>
							   <li><?php echo esc_html( $data['label'] ); ?></li>
						   <?php endif;
					   endforeach;
					   echo '</ul>';
				   }
				   ?>
			   </div>
		   </div>
	   </div>
	   <!-- Informazioni aziendali solo mobile -->
	   <div class="row d-flex d-md-none">
		   <div class="col-12 mb-4">
			   <div class="footer-company mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title"><?php _e( 'Informazioni aziendali', 'lesto-theme' ); ?></h4>
				   <?php
				   // Try to display company info from ACF first
				   if (function_exists('lesto_get_footer_company_info') && lesto_get_footer_company_info()) {
					   // Company info displayed by lesto_get_footer_company_info()
				   } else {
					   // Show fallback company info
					   echo '<ul class="footer-company-list">';
					   echo '<li>' . esc_html( get_theme_mod( 'lesto_company_name', 'Lesto Srl' ) ) . '</li>';
					   echo '<li>P.IVA: <a href="' . esc_url( get_theme_mod( 'lesto_company_piva_url', 'https://www.example.com/piva' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_piva', '12345678901' ) ) . '</a></li>';
					   echo '<li>Cod. Fisc.: <a href="' . esc_url( get_theme_mod( 'lesto_company_codfisc_url', 'https://www.example.com/codfisc' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_codfisc', '12345678901' ) ) . '</a></li>';
					   echo '<li>REA: <a href="' . esc_url( get_theme_mod( 'lesto_company_rea_url', 'https://www.example.com/rea' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_company_rea', 'MI-1234567' ) ) . '</a></li>';
					   echo '</ul>';
				   }
				   ?>
			   </div>
		   </div>
	   </div>
		   <!-- Seconda row: social e contatti -->
		   <div class="row">
			   <div class="col-lg-3 col-md-6 mb-4 offset-lg-3 d-flex flex-column gap-5">
							   <div class="footer-social d-flex flex-column gap-3 d-none d-md-flex">
								   <h4 class="footer-title"><?php _e( 'Social', 'lesto-theme' ); ?></h4>
								   <?php
								   // Try to display social from ACF first
								   if (function_exists('lesto_get_footer_social') && lesto_get_footer_social()) {
									   // Social displayed by lesto_get_footer_social()
								   } else {
									   // Show fallback social
									   echo '<ul class="footer-social-list">';
									   $social_links = array(
										   'facebook'  => array( 'url' => get_theme_mod( 'lesto_facebook_url' ), 'label' => 'Facebook' ),
										   'instagram' => array( 'url' => get_theme_mod( 'lesto_instagram_url' ), 'label' => 'Instagram' ),
										   'linkedin'  => array( 'url' => get_theme_mod( 'lesto_linkedin_url' ), 'label' => 'LinkedIn' ),
										   'twitter'   => array( 'url' => get_theme_mod( 'lesto_twitter_url' ), 'label' => 'Twitter' ),
									   );
									   
									   foreach ( $social_links as $platform => $data ) :
										   if ( ! empty( $data['url'] ) ) : ?>
											   <li><a href="<?php echo esc_url( $data['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $data['label'] ); ?></a></li>
										   <?php else : ?>
											   <li><?php echo esc_html( $data['label'] ); ?></li>
										   <?php endif;
									   endforeach;
									   echo '</ul>';
								   }
								   ?>
							   </div>
			   </div>
			   <div class="col-lg-6 col-md-6 mb-4 d-flex flex-column gap-5">
				   <div class="footer-contacts d-flex flex-column gap-3">
					   <h4 class="footer-title"><?php _e( 'Contatti', 'lesto-theme' ); ?></h4>
					   <?php
					   // Try to display contacts from ACF first
					   if (function_exists('lesto_get_footer_contacts') && lesto_get_footer_contacts()) {
						   // Contacts displayed by lesto_get_footer_contacts()
					   } else {
						   // Show fallback contacts
						   echo '<ul class="footer-contacts-list">';
						   echo '<li>Progettazione e showroom: <a href="' . esc_url( get_theme_mod( 'lesto_address_url', 'https://www.google.com/maps?q=Via+Roma+123,+Milano' ) ) . '" target="_blank">' . esc_html( get_theme_mod( 'lesto_address', 'Via Roma 123, Milano' ) ) . '</a></li>';
						   echo '<li>Telefono: <a href="tel:' . esc_attr( get_theme_mod( 'lesto_phone_link', '+390212345678' ) ) . '">' . esc_html( get_theme_mod( 'lesto_phone', '+39 02 1234 5678' ) ) . '</a></li>';
						   echo '<li>Email: <a href="mailto:' . esc_attr( get_theme_mod( 'lesto_email', 'info@lesto.it' ) ) . '">' . esc_html( get_theme_mod( 'lesto_email', 'info@lesto.it' ) ) . '</a></li>';
						   echo '<li>PEC: <a href="mailto:' . esc_attr( get_theme_mod( 'lesto_pec_email', 'pec@lesto.it' ) ) . '">' . esc_html( get_theme_mod( 'lesto_pec_email', 'pec@lesto.it' ) ) . '</a></li>';
						   echo '</ul>';
					   }
					   ?>
				   </div>
			   </div>
		   </div>
			<!-- Divider fuori dal container solo su mobile -->
			<hr class="footer-divider border-2 opacity-75 d-block d-md-none m-0 mt-5">
			<!-- Divider dentro il container solo su desktop -->
			<hr class="footer-divider border-2 opacity-75 d-none d-md-block">

			<!-- Copyright e informazioni legali -->
			<div class="row align-items-center py-2">
				<div class="col-md-10">
					<p class="footer-copyright mb-0">
						<?php echo wp_kses_post( get_theme_mod( 'lesto_copyright_text', 'Lesto Group S.A.S di Martino Accongiagioco & C. | Sede legale: Via Volterra,12 – 20146 – Milano (MI) | Pec: lestogroupsas@pro-pec.it | P.IVA: 12986630965' ) ); ?>
					</p>
				</div>
				<!-- Footer credit accanto al copyright su desktop -->
				<div class="col-md-2 text-end d-none d-md-block">
					<p class="footer-credit mb-0"><?php echo esc_html( get_theme_mod( 'lesto_footer_credit', '@wndr' ) ); ?></p>
				</div>
			</div>
			<!-- Divider sotto copyright solo su mobile -->
			<hr class="footer-divider border-2 opacity-75 d-block d-md-none m-0">
			<!-- Footer credit sotto solo su mobile -->
			<div class="w-100 text-center mt-2 d-block d-md-none">
				<p class="footer-credit mb-0"><?php echo esc_html( get_theme_mod( 'lesto_footer_credit', '@wndr' ) ); ?></p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
