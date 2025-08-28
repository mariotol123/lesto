<?php
/**
 * Template name: Contatti
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lesto-theme
 */

get_header();
?>

<!-- Main content area -->
<main class="servizi-consulenza-container">
	<h1 class="container pt-7xl h2">Contatti</h1>
	<hr class="footer-divider border-2 opacity-75 w-100">
	<div class="container py-3">
		<div class="row">
			<!-- Colonna 1: -->
			<div class="col-md-6 d-flex align-items-start gap-4 colonna-1 mt-5">
				<div class="d-flex flex-column gap-4">
					<div class="d-flex align-items-start gap-4">
						<img src="/wp-content/themes/lesto-theme/images/contatti.png" alt="Contatti" loading="lazy">
						<div>
							<h5>Ufficio progettazione e Showroom</h5>
							<p class="desktop-p">Paragrafo 2 di esempio per i contatti.</p>
						</div>
					</div>
					<div class="d-flex align-items-start gap-4">
						<img src="/wp-content/themes/lesto-theme/images/contatti.png" alt="Contatti" loading="lazy">
						<div>
							<h5>ufficio amministrativo e ricezione merci</h5>
							<p class="desktop-p">Paragrafo tecnico di esempio.</p>
						</div>
					</div>
					<div class="d-flex align-items-start gap-4">
						<img src="/wp-content/themes/lesto-theme/images/contatti.png" alt="Contatti" loading="lazy">
						<div>
							<h5>contatti</h5>
							<p class="desktop-p">Telefono: +39 0382.935884</p>
							<p class="desktop-p">Email: info@lestogroup.com</p>
						</div>
					</div>
					<div class="d-flex align-items-start gap-4">
						<img src="/wp-content/themes/lesto-theme/images/contatti.png" alt="Contatti" loading="lazy">
						<div>
							<h5>assistenza tecnica</h5>
							<p class="desktop-p">Telefono: +39 335.1296432</p>
						</div>
					</div>
					<div class="d-flex align-items-start gap-4">
						<img src="/wp-content/themes/lesto-theme/images/contatti.png" alt="Contatti" loading="lazy">
						<div>
							<h5>ufficio Commerciale</h5>
							<p class="desktop-p">Telefono: +39 335.1296433</p>
						</div>
					</div>
					<h6 class="mt-5">Seguici anche sui nostri canali social</h6>
					<div class=" d-flex align-items-center gap-4 mt-3">
						<a href="https://www.facebook.com/Lestogroup/" class="social-link">
							<img src="/wp-content/themes/lesto-theme/images/svg-fb.svg" alt="Facebook" loading="lazy">
						</a>
						<a href="https://www.instagram.com/lestogroup/" class="social-link">
							<img src="/wp-content/themes/lesto-theme/images/svg-ig.svg" alt="Instagram" loading="lazy">
						</a>
						<a href="https://twitter.com/lestogroup" class="social-link">
							<img src="/wp-content/themes/lesto-theme/images/svg-twitter.svg" alt="Twitter" loading="lazy">
						</a>

					</div>
				</div>
			</div>
			<!-- Colonna 2: Form di contatto -->
			<div class="col-md-6 form-container mt-3">
				<form id="contactForm" class=" d-flex flex-column p-4 header-buttons">
					<div>
						<h3 class="m_h3">Richiedi Un Preventivo</h3>
						<p class="desktop-p mb-3">Compila il form, ti risponderemo entro 24h!</p>
					</div>

					<!-- Campo Nome -->
					<div class="mb-3">
						<label for="nome" class="form-label mb-1 desktop-p-16 mx-5">Nome</label>
						<input type="text" id="nome" name="nome" class="form-control header-buttons" required>
					</div>

					<!-- Campo Telefono -->
					<div class="mb-3">
						<label for="telefono" class="form-label mb-1 desktop-p-16 mx-5">Telefono</label>
						<input type="tel" id="telefono" name="telefono" class="form-control header-buttons" required>
					</div>

					<!-- Campo E-mail -->
					<div class="mb-3">
						<label for="email" class="form-label mb-1 desktop-p-16 mx-5">E-mail</label>
						<input type="email" id="email" name="email" class="form-control header-buttons" required>
					</div>

					<!-- Campo Messaggio con SVG e pulsante incassato -->
					<div class="mb-3">
						<label for="messaggio" class="form-label mb-1 desktop-p-16 mx-5">Messaggio</label>
						<div class="textarea-container">
							<div class="svg-background">
								<svg id="curvedbg" class="textarea-svg" viewBox="0 0 745 202" preserveAspectRatio="none">
									<path d="M30 0.5H715C731.292 0.5 744.5 13.7076 744.5 30V121.5C744.5 137.792 731.292 151 715 151H684.098C669.876 151 658.348 162.529 658.348 176.75C658.348 190.419 647.268 201.5 633.599 201.5H30C13.7076 201.5 0.5 188.292 0.5 172V30C0.500002 13.7076 13.7076 0.500001 30 0.5Z" stroke="rgba(255,255,255)" stroke-width="1" fill="transparent"/>
								</svg>
							</div>
							<textarea id="messaggio" name="messaggio" class="textarea-field form-control header-buttons" required></textarea>
							<button type="submit" id="submit" class="submit-btn">Invia</button>
						</div>
					</div>

					<!-- Checkbox privacy -->
					<div class="form-check mt-4 d-flex gap-4">
						<input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
						<label for="privacy" class="form-check-label m_p1">
							Confermo di aver preso visione della <span class="link">privacy policy</span> e acconsento al trattamento dei dati personali ai sensi dell'art. 13 del D.Lgs 196/2003 e dell'art. 13 del Regolamento UE 679/2016 per ricevere risposta
						</label>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	</div>

</main>

<?php

get_footer();
