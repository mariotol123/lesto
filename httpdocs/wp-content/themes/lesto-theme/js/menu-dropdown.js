// menu-dropdown.js
console.log('DEBUG: menu-dropdown.js caricato');
// Gestione dropdown menu header personalizzato

document.addEventListener('DOMContentLoaded', function() {
	var row = document.querySelector('.row.align-items-center');
	var logoCol = document.querySelector('.col-4.col-md-5.d-flex.align-items-center.justify-content-between');
	var headerButtons = document.querySelector('.header-buttons');
	var mainButtonsContainer = headerButtons.querySelector('.main-buttons-container');
	
	// Cache per i dati dei post
	var postsCache = {};
	
	// Funzione per caricare i post via AJAX
	function loadPosts(postType, callback) {
		console.log('DEBUG: Caricamento post per tipo:', postType);
		
		if (postsCache[postType]) {
			console.log('DEBUG: Dati trovati nella cache:', postsCache[postType]);
			callback(postsCache[postType]);
			return;
		}
		
		var formData = new FormData();
		formData.append('action', 'lesto_get_cpt_posts');
		formData.append('post_type', postType);
		formData.append('nonce', lestoTheme.nonce);
		
		console.log('DEBUG: Invio richiesta AJAX per:', postType);
		console.log('DEBUG: URL AJAX:', lestoTheme.ajaxUrl);
		
		fetch(lestoTheme.ajaxUrl, {
			method: 'POST',
			body: formData
		})
		.then(response => {
			console.log('DEBUG: Risposta ricevuta:', response);
			return response.json();
		})
		.then(data => {
			console.log('DEBUG: Dati ricevuti:', data);
			if (data.success) {
				postsCache[postType] = data.data;
				console.log('DEBUG: Post salvati nella cache:', data.data);
				callback(data.data);
			} else {
				console.error('Errore nel caricamento dei post:', data);
				callback([]);
			}
		})
		.catch(error => {
			console.error('Errore AJAX:', error);
			callback([]);
		});
	}
	
	var buttons = {
		'settori-btn': {
			postType: 'settore',
			fallback: ['Settoreeeeee 1', 'Settore 2', 'Settore 3']
		},
		'servizi-btn': {
			postType: 'servizio', 
			fallback: ['Servizio 1', 'Servizio 2', 'Servizio 3']
		},
		'realizzazioni-btn': {
			postType: null, // Nessun CPT ancora, usa solo fallback
			fallback: ['Realizzazione 1', 'Realizzazione 2', 'Realizzazione 3']
		},
		// Versioni mobile
		'settori-btn-mobile': {
			postType: 'settore',
			fallback: ['Settoreeeeee 1', 'Settore 2', 'Settore 3']
		},
		'servizi-btn-mobile': {
			postType: 'servizio', 
			fallback: ['Servizio 1', 'Servizio 2', 'Servizio 3']
		},
		'realizzazioni-btn-mobile': {
			postType: null, // Nessun CPT ancora, usa solo fallback
			fallback: ['Realizzazione 1', 'Realizzazione 2', 'Realizzazione 3']
		}
	};
	// Gestione click con delegazione eventi per supportare elementi dinamici
	document.addEventListener('click', function(e) {
		// Controlla se l'elemento cliccato o un suo genitore ha un ID tra quelli dei bottoni
		var clickedElement = e.target.closest('[id]');
		if (!clickedElement) return;
		
		var btnId = clickedElement.id;
		
		// Se è uno dei nostri bottoni
		if (buttons[btnId]) {
			e.preventDefault();
			console.log('DEBUG: Click su bottone:', btnId);
			
			var btn = clickedElement;
			var isMobile = btnId.includes('-mobile');
			
			// Per bottoni mobile, gestiamo diversamente
			if (isMobile) {
				handleMobileButtonClick(btn, btnId);
			} else {
				handleDesktopButtonClick(btn, btnId);
			}
		}
		
		// Gestione chiusura dropdown (codice esistente)
		var oldDropdown = headerButtons ? headerButtons.querySelector('.dropdown-list') : null;
		var closeImg = document.getElementById('dropdown-close-img');
		if (oldDropdown && headerButtons && !headerButtons.contains(e.target)) {
			oldDropdown.remove();
			Object.keys(buttons).forEach(function(otherId) {
				if (!otherId.includes('-mobile')) { // Solo desktop per questa logica
					var otherBtn = document.getElementById(otherId);
					if (otherBtn) {
						otherBtn.classList.remove('active');
					}
				}
			});
			if (closeImg) closeImg.remove();
			if (mainButtonsContainer) mainButtonsContainer.classList.remove('active');
			if (row) row.classList.add('align-items-center');
			if (logoCol) logoCol.classList.add('align-items-center');
		}
	});
	
	// Funzione per gestire click sui bottoni desktop
	function handleDesktopButtonClick(btn, btnId) {
		// Rimuovi active da tutti i bottoni desktop
		Object.keys(buttons).forEach(function(otherId) {
			if (!otherId.includes('-mobile')) {
				var otherBtn = document.getElementById(otherId);
				if (otherBtn) {
					otherBtn.classList.remove('active');
				}
			}
		});
		
		// Rimuovi dropdown e close precedenti
		if (headerButtons) {
			var oldDropdown = headerButtons.querySelector('.dropdown-list');
			if (oldDropdown) oldDropdown.remove();
			var oldClose = document.getElementById('dropdown-close-img');
			if (oldClose) oldClose.remove();
			if (mainButtonsContainer) mainButtonsContainer.classList.remove('active');
		}

		// Aggiungi classe active al bottone cliccato
		btn.classList.add('active');
		console.log('DEBUG: Click su Menu Dropdown desktop');
		if (mainButtonsContainer) mainButtonsContainer.classList.add('active');
		if (row) row.classList.remove('align-items-center');
		if (logoCol) logoCol.classList.remove('align-items-center');

		// Crea dropdown per desktop
		createDesktopDropdown(btnId);
	}
	
	// Funzione per gestire click sui bottoni mobile
	function handleMobileButtonClick(btn, btnId) {
		console.log('DEBUG: Click su bottone mobile:', btnId);
		
		// Per ora solo log, qui potresti aggiungere logica specifica per mobile
		// Ad esempio, navigare direttamente alla pagina o aprire un sottomenu
		if (buttons[btnId].postType) {
			loadPosts(buttons[btnId].postType, function(posts) {
				console.log('DEBUG: Post caricati per mobile:', posts);
				// Qui potresti implementare la navigazione o altro comportamento per mobile
			});
		}
	}
	
	// Funzione per creare dropdown desktop
	function createDesktopDropdown(btnId) {
		// Funzione per creare il dropdown
		function createDropdown(items) {
			console.log('DEBUG: Creazione dropdown con items:', items);
			
			var dropdownList = document.createElement('ul');
			dropdownList.className = 'dropdown-list';
			dropdownList.style.margin = '25px 0 0 0';
			dropdownList.style.padding = '0';
			dropdownList.style.listStyle = 'none';
			
			items.forEach(function(item) {
				var li = document.createElement('li');
				var a = document.createElement('a');
				
				// Se l'item è un oggetto con url, usa quello, altrimenti fallback
				if (typeof item === 'object' && item.url) {
					a.href = item.url;
					a.textContent = item.title;
					console.log('DEBUG: Link creato con URL reale:', item.title, item.url);
				} else {
					a.href = '#';
					a.textContent = typeof item === 'string' ? item : item.title;
					console.log('DEBUG: Link fallback creato:', a.textContent);
				}
				
				a.className = 'dropdown-link';
				a.style.textAlign = 'left';
				li.appendChild(a);
				dropdownList.appendChild(li);
			});
			
			if (headerButtons) headerButtons.appendChild(dropdownList);
		}
		
		// Carica i post dinamicamente o usa fallback
		if (buttons[btnId].postType) {
			loadPosts(buttons[btnId].postType, function(posts) {
				var items = posts.length > 0 ? posts : buttons[btnId].fallback;
				createDropdown(items);
			});
		} else {
			createDropdown(buttons[btnId].fallback);
		}

		// Crea bottone close
		var closeImg = document.createElement('img');
		closeImg.src = lestoTheme.menuCloseImg;
		closeImg.alt = 'Chiudi';
		closeImg.id = 'dropdown-close-img';
		closeImg.style.position = 'absolute';
		closeImg.style.right = '3px';
		closeImg.style.bottom = '3px';
		closeImg.style.width = '32px';
		closeImg.style.height = '32px';
		closeImg.style.cursor = 'pointer';
		if (headerButtons) headerButtons.appendChild(closeImg);
		
		closeImg.addEventListener('click', function() {
			var oldDropdown = headerButtons ? headerButtons.querySelector('.dropdown-list') : null;
			if (oldDropdown) oldDropdown.remove();
			closeImg.remove();
			var activeBtn = document.getElementById(btnId);
			if (activeBtn) activeBtn.classList.remove('active');
			if (mainButtonsContainer) mainButtonsContainer.classList.remove('active');
			if (row) row.classList.add('align-items-center');
			if (logoCol) logoCol.classList.add('align-items-center');
		});
	}
	var hamburger = document.getElementById('hamburger-menu');
    if (hamburger) {
        hamburger.addEventListener('click', function(e) {
            console.log('DEBUG: click su hamburger-menu');
            e.preventDefault();
            if (document.getElementById('mobile-menu')) return;
            // Cambia hamburger in X
            hamburger.src = '/wp-content/themes/lesto-theme/images/Vector.png';
            var mobileMenu = document.createElement('div');
			mobileMenu.className = 'header-buttons-mobile';
            mobileMenu.id = 'mobile-menu';
            mobileMenu.style.position = 'fixed';
            mobileMenu.style.top = '10rem';
            mobileMenu.style.left = '5%';
            mobileMenu.style.width = '90%';
            mobileMenu.style.zIndex = '99999';
            mobileMenu.style.padding = '0 0';
            mobileMenu.innerHTML = `
                <div id="mobile-menu-list" style="display:flex;flex-direction:column;justify-content:space-between;align-items:flex-start;height:50vh;">
   	                 <div id="menu-main-buttons" style="display:flex;flex-direction:column;align-items:flex-start;">
                        <button type="button" class="btn btn-header-custom" id="settori-btn-mobile" style="width:auto!important;min-width:0!important;max-width:fit-content!important;padding:10px 20px;margin:0 0 0;text-align:left;flex-shrink:0;"><span>Settori</span></button>
                        <button type="button" class="btn btn-header-custom" id="servizi-btn-mobile" style="width:auto!important;min-width:0!important;max-width:fit-content!important;padding:10px 20px;margin:0 0 0;text-align:left;flex-shrink:0;"><span>Servizi</span></button>
                        <button type="button" class="btn btn-header-custom" id="realizzazioni-btn-mobile" style="width:auto!important;min-width:0!important;max-width:fit-content!important;padding:10px 20px;margin:0 0 0;text-align:left;flex-shrink:0;"><span>Realizzazioni</span></button>
                    </div>
                    <div id="menu-contatti-button" style="display:flex;justify-content:space-between;gap:10px; width:100%;">
                        <button type="button" class="btn btn-header-custom" id="contatti-btn-mobile" style="width:auto!important;min-width:0!important;max-width:fit-content!important;padding:10px 20px;margin:0 0 0;text-align:left;flex-shrink:0;">
                            <span>Contatti</span>
                        </button>
						<div class="" style="display:flex;align-items:center;gap:10px; margin-right: 10px; margin-bottom: 10px;">
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
            `;
            document.body.appendChild(mobileMenu);
            document.body.style.overflow = 'hidden';
            // Chiudi menu cliccando di nuovo sull'hamburger (ora X)
            hamburger.addEventListener('click', function closeMenu() {
                if (document.getElementById('mobile-menu')) {
                    mobileMenu.remove();
                    document.body.style.overflow = '';
                    // Ripristina hamburger
                    hamburger.src = '/wp-content/themes/lesto-theme/images/Vector (1).png';
                    hamburger.removeEventListener('click', closeMenu);
                }
            });
            // Chiudi menu cliccando fuori
            mobileMenu.addEventListener('click', function(ev) {
                if (ev.target === mobileMenu) {
                    mobileMenu.remove();
                    document.body.style.overflow = '';
                    hamburger.src = '/wp-content/themes/lesto-theme/images/Vector (1).png';
                }
            });
        });
    }
});
