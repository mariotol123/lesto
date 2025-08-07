<?php
/**
 * Template name: Home
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lesto-theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container p-0">
			<div class="content-section vh-100 d-flex flex-column align-items-center justify-content-center">
				<div class="row w-100 flex-grow-1 align-items-center">
					<!-- Colonna testo -->
					<div id="text-column" class="col-md-6 d-flex flex-column justify-content-center">
						<!-- Contenuto per "Nuovo locale" -->
						<div id="content-locale" class="content-box active">
							<h1 class="mb-4 w-75">Vuoi aprire un locale?</h1>
							<p class="page-description mb-4">Dal 1984 Lesto Group si occupa di consulenza, progettazione, vendita e assistenza di attrezzature professionali per ristoranti, hotel, pizzerie e bar..</p>
						</div>
						
						<!-- Contenuto per "Catena" -->
						<div id="content-franchise" class="content-box">
							<h1 class="mb-4 w-100">Vuoi aprire un format replicabile?</h1>
							<p class="page-description mb-4 w-50">Unisciti alla nostra rete di franchise e inizia la tua attività con un marchio consolidato.</p>
						</div>
					</div>
					
					<!-- Colonna icone social -->
					<div id="social-column" class="col-md-6 d-flex align-items-end justify-content-end position-relative">
						<div class="social-icons-container">
							<a href="#" class="social-link">
								<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect width="35" height="35" rx="17.5" fill="white" fill-opacity="0.01"/>
									<path d="M17.5 30.625C19.2236 30.625 20.9303 30.2855 22.5227 29.6259C24.1151 28.9663 25.562 27.9995 26.7808 26.7808C27.9995 25.562 28.9663 24.1151 29.6259 22.5227C30.2855 20.9303 30.625 19.2236 30.625 17.5C30.625 15.7764 30.2855 14.0697 29.6259 12.4773C28.9663 10.8849 27.9995 9.43799 26.7808 8.21922C25.562 7.00045 24.1151 6.03367 22.5227 5.37408C20.9303 4.71449 19.2236 4.375 17.5 4.375C14.019 4.375 10.6806 5.75781 8.21922 8.21922C5.75781 10.6806 4.375 14.019 4.375 17.5C4.375 20.981 5.75781 24.3194 8.21922 26.7808C10.6806 29.2422 14.019 30.625 17.5 30.625ZM17.5 30.625V14.5833C17.5 13.8098 17.8073 13.0679 18.3543 12.5209C18.9013 11.974 19.6431 11.6667 20.4167 11.6667H21.875M21.1458 18.2292H13.8542" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</a>
							<a href="#" class="social-link">
								<svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect width="35" height="35" rx="17.5" fill="white" fill-opacity="0.01"/>
									<path d="M21.875 5.10419H13.125C8.69518 5.10419 5.10413 8.69524 5.10413 13.125V21.875C5.10413 26.3048 8.69518 29.8959 13.125 29.8959H21.875C26.3047 29.8959 29.8958 26.3048 29.8958 21.875V13.125C29.8958 8.69524 26.3047 5.10419 21.875 5.10419Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M17.5 22.7588C20.4043 22.7588 22.7587 20.4043 22.7587 17.5C22.7587 14.5957 20.4043 12.2413 17.5 12.2413C14.5956 12.2413 12.2412 14.5957 12.2412 17.5C12.2412 20.4043 14.5956 22.7588 17.5 22.7588Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									<path d="M24.6371 11.865C25.4667 11.865 26.1392 11.1925 26.1392 10.3629C26.1392 9.53334 25.4667 8.86084 24.6371 8.86084C23.8075 8.86084 23.135 9.53334 23.135 10.3629C23.135 11.1925 23.8075 11.865 24.6371 11.865Z" fill="white"/>
								</svg>
							</a>
						</div>
					</div>
				</div>
				
				<!-- Buttons alla fine del div -->
				<div class="buttons-container mb-5">
					<button id="btn-franchise" class="btn btn-custom">
						<span>Catena</span>
					</button>
					<button id="btn-locale" class="btn btn-custom active">
						<span>Nuovo locale</span>
					</button>
				</div>
			</div>

			<div>
				<!-- Additional content can be added here -->
			</div>

			<div>

			</div>

			<div>
				<!-- Placeholder for future content -->
			</div>
		</div>
		
	</main><!-- #main -->

<!-- Iconify CDN -->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
	const buttons = document.querySelectorAll('.btn');
	const contentSection = document.querySelector('.content-section');
	const textColumn = document.getElementById('text-column');
	const socialColumn = document.getElementById('social-column');
	const contentLocale = document.getElementById('content-locale');
	const contentFranchise = document.getElementById('content-franchise');

	buttons.forEach(button => {
		button.addEventListener('click', function() {
			// Remove active class from all buttons
			buttons.forEach(btn => btn.classList.remove('active'));
			
			// Add active class to clicked button
			this.classList.add('active');
			
			// Add fade effect
			contentSection.classList.add('fade');
			
			setTimeout(() => {
				// Handle column layout changes and content visibility
				if (this.id === 'btn-franchise') {
					// Catena button - widen text column and show franchise content
					textColumn.className = 'col-md-8 d-flex flex-column justify-content-center';
					socialColumn.className = 'col-md-4 d-flex align-items-end justify-content-end position-relative';
					
					// Show franchise content, hide locale content
					contentLocale.classList.remove('active');
					contentFranchise.classList.add('active');
					
				} else if (this.id === 'btn-locale') {
					// Nuovo locale button - default columns and show locale content
					textColumn.className = 'col-md-6 d-flex flex-column justify-content-center';
					socialColumn.className = 'col-md-6 d-flex align-items-end justify-content-end position-relative';
					
					// Show locale content, hide franchise content
					contentFranchise.classList.remove('active');
					contentLocale.classList.add('active');
				}
				
				contentSection.classList.remove('fade');
			}, 150);
		});
	});
});
</script>

<?php
get_footer();
