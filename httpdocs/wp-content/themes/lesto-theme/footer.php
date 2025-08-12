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

	<footer id="colophon" class="site-footer">
		<div class="container footer-container mt-4">
	   <!-- Prima row desktop: logo, navigation, azienda -->
	   <div class="row d-none d-md-flex">
		   <div class="col-lg-3 mb-4">
			   <img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="Footer Logo" class="footer-logo">
		   </div>
		   <div class="col-lg-3 col-md-6 mb-4 d-flex flex-column gap-5">
			   <div class="footer-navigation mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title">Navigation</h4>
				   <ul class="footer-nav-list">
					   <li>Home</li>
					   <li>Chi Siamo</li>
					   <li>Servizi</li>
					   <li>Portfolio</li>
					   <li>Blog</li>
					   <li>Contatti</li>
				   </ul>
			   </div>
		   </div>
		   <div class="col-lg-6 col-md-6 mb-4 d-flex flex-column gap-5">
			   <div class="footer-company mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title">Informazioni aziendali</h4>
				   <ul class="footer-company-list">
					   <li>Lesto Srl</li>
					   <li>P.IVA: <a href="https://www.example.com/piva" target="_blank">12345678901</a></li>
					   <li>Cod. Fisc.: <a href="https://www.example.com/codfisc" target="_blank">12345678901</a></li>
					   <li>REA: <a href="https://www.example.com/rea" target="_blank">MI-1234567</a></li>
				   </ul>
			   </div>
		   </div>
	   </div>

	   <!-- Prima row mobile: navigation e social affiancate -->
	   <!-- Logo solo mobile -->
	   <div class="row d-flex d-md-none">
		   <div class="col-12 mb-4">
			   <img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="Footer Logo" class="footer-logo">
		   </div>
	   </div>
	   <div class="row d-flex d-md-none">
		   <div class="col-6 mb-4">
			   <div class="footer-navigation mb-3 d-flex flex-column gap-3">
				   <h4 class="footer-title">Navigation</h4>
				   <ul class="footer-nav-list">
					   <li>Home</li>
					   <li>Chi Siamo</li>
					   <li>Servizi</li>
					   <li>Portfolio</li>
					   <li>Blog</li>
					   <li>Contatti</li>
				   </ul>
			   </div>
		   </div>
		   <div class="col-6 mb-4">
			   <div class="footer-social d-flex flex-column gap-3">
				   <h4 class="footer-title">Social</h4>
				   <ul class="footer-social-list">
					   <li>Facebook</li>
					   <li>Instagram</li>
					   <li>LinkedIn</li>
					   <li>Twitter</li>
				   </ul>
			   </div>
		   </div>
	   </div>
		   <!-- Seconda row: social e contatti -->
		   <div class="row">
			   <div class="col-lg-3 col-md-6 mb-4 offset-lg-3 d-flex flex-column gap-5">
				   <div class="footer-social d-flex flex-column gap-3">
					   <h4 class="footer-title">Social</h4>
					   <ul class="footer-social-list">
						   <li>Facebook</li>
						   <li>Instagram</li>
						   <li>LinkedIn</li>
						   <li>Twitter</li>
					   </ul>
				   </div>
			   </div>
			   <div class="col-lg-6 col-md-6 mb-4 d-flex flex-column gap-5">
				   <div class="footer-contacts d-flex flex-column gap-3">
					   <h4 class="footer-title">Contatti</h4>
					   <ul class="footer-contacts-list">
						   <li>Progettazione e showroom: <a href="https://www.google.com/maps?q=Via+Roma+123,+Milano" target="_blank"> Via Roma 123, Milano</a></li>
						   <li>Telefono: <a href="tel:+390212345678">+39 02 1234 5678</a></li>
						   <li>Email: <a href="mailto:info@lesto.it">info@lesto.it</a></li>
						   <li>PEC: <a href="mailto:pec@lesto.it">pec@lesto.it</a></li>
					   </ul>
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
						Lesto Group S.A.S di Martino Accongiagioco & C. | Sede legale: Via Volterra,12 – 20146 – Milano (MI) | Pec: lestogroupsas@pro-pec.it | P.IVA: 12986630965
					</p>
				</div>
				<!-- Footer credit accanto al copyright su desktop -->
				<div class="col-md-2 text-end d-none d-md-block">
					<p class="footer-credit mb-0">@wndr</p>
				</div>
			</div>
			<!-- Divider sotto copyright solo su mobile -->
			<hr class="footer-divider border-2 opacity-75 d-block d-md-none m-0">
			<!-- Footer credit sotto solo su mobile -->
			<div class="w-100 text-center mt-2 d-block d-md-none">
				<p class="footer-credit mb-0">@wndr</p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
