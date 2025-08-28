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
            hamburger.src = '/wp-content/themes/lesto-theme/images/x-menu.svg';
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
							<img src="/wp-content/themes/lesto-theme/images/svg-fb.svg" alt="Facebook" width="35" height="35"/>
						</a>
						<a href="#" class="social-link">
							<img src="/wp-content/themes/lesto-theme/images/svg-ig.svg" alt="Instagram" width="35" height="35"/>
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
                    hamburger.src = '/wp-content/themes/lesto-theme/images/hamburger.svg';
                    hamburger.removeEventListener('click', closeMenu);
                }
            });
            // Chiudi menu cliccando fuori
            mobileMenu.addEventListener('click', function(ev) {
                if (ev.target === mobileMenu) {
                    mobileMenu.remove();
                    document.body.style.overflow = '';
                    hamburger.src = '/wp-content/themes/lesto-theme/images/hamburger.svg';
                }
            });
        });
    }
});
