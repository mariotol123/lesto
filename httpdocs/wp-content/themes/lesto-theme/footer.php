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
			<div class="row">
				<!-- Prima colonna: Logo -->
				<div class="col-lg-3 mb-4">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Livello_1.png" alt="Footer Logo" class="footer-logo">
				</div>
				
				<!-- Seconda colonna: Navigation e Social -->
				<div class="col-lg-3 col-md-6 mb-4 d-flex flex-column gap-5">
					<div class="footer-navigation mb-3 d-flex flex-column gap-3">
						<h4 class="footer-title">Navigation</h4>
						<ul class="footer-nav-list">
							<li>Home</a></li>
							<li>Chi Siamo</li>
							<li>Servizi</li>
							<li>Portfolio</li>
							<li>Blog</li>
							<li>Contatti</li>
						</ul>
					</div>
					
					<div class="footer-social d-flex flex-column gap-3">
						<h4 class="footer-title">Social</h4>
						<ul class="footer-social-list">
							<li>Facebook</a></li>
							<li>Instagram</a></li>
							<li>LinkedIn</a></li>
							<li>Twitter</a></li>
						</ul>
					</div>
				</div>
				
				<!-- Terza colonna: Informazioni Aziendali e Contatti -->
				<div class="col-lg-6 col-md-6 mb-4 d-flex flex-column gap-5">
					<div class="footer-company mb-3 d-flex flex-column gap-3">
						<h4 class="footer-title">Informazioni aziendali</h4>
						<ul class="footer-company-list">
							<li>Lesto Srl</li>
							<li>P.IVA: <a href="https://www.example.com/piva" target="_blank">12345678901</a></li>
							<li>Cod. Fisc.: <a href="https://www.example.com/codfisc" target="_blank">12345678901</a></li>
							<li>REA: <a href="https://www.example.com/rea" target="_blank">MI-1234567</a></li>
							<li><a href="<?php echo home_url('/privacy/'); ?>" class="text-uppercase">Privacy Policy</a></li>
							<li><a href="<?php echo home_url('/terms/'); ?>" class="text-uppercase">Termini e Condizioni</a></li>
						</ul>
					</div>
					
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
