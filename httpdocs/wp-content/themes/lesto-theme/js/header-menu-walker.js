// header-menu-walker.js

document.addEventListener('DOMContentLoaded', function() {
    var row = document.querySelector('.row.align-items-center');
    var logoCol = document.querySelector('.col-4.col-md-5.d-flex.align-items-center.justify-content-between');
    var headerButtons = document.querySelector('.header-buttons');
    var mainButtonsContainer = headerButtons ? headerButtons.querySelector('.main-buttons-container') : null;

    // Gestione click sui bottoni del menu
    var buttonStates = {}; // Tiene traccia dello stato di ogni bottone
    
    document.addEventListener('click', function(e) {
        var clickedButton = e.target.closest('.btn-header-custom');
        if (!clickedButton) {
            // Se si clicca fuori dai bottoni, chiudi eventuali dropdown aperti e resetta stati
            closeAllDropdowns();
            resetAllButtonStates();
            return;
        }

        var buttonId = clickedButton.id;
        
        // Se è il bottone contatti, non fare nulla (gestione normale del link)
        if (buttonId === 'contatti-btn') {
            return;
        }

        e.preventDefault();
        
        // Inizializza lo stato del bottone se non esiste
        if (!buttonStates[buttonId]) {
            buttonStates[buttonId] = { dropdownOpen: false, clickCount: 0 };
        }
        
        var state = buttonStates[buttonId];
        var dropdown = findDropdownForButton(clickedButton);
        
        if (!dropdown) return;
        
        if (!state.dropdownOpen) {
            // Primo click: apri dropdown
            closeAllDropdowns();
            resetAllButtonStates();
            openDropdown(clickedButton, dropdown);
            buttonStates[buttonId] = { dropdownOpen: true, clickCount: 1 };
        } else {
            // Secondo click: naviga al link
            var url = clickedButton.getAttribute('data-url');
            if (url && url !== '') {
                closeAllDropdowns();
                resetAllButtonStates();
                window.location.href = url;
            }
        }
    });

    function resetAllButtonStates() {
        buttonStates = {};
    }

    function findDropdownForButton(button) {
        // Il dropdown dovrebbe essere nel wrapper del menu item
        var menuItemWrapper = button.closest('.menu-item');
        if (menuItemWrapper) {
            var dropdown = menuItemWrapper.querySelector('.dropdown-generale');
            return dropdown;
        }
        
        return null;
    }

    function openDropdown(button, dropdown) {
        // Attiva il bottone
        button.classList.add('active');
        
        // Invece di mostrare il dropdown esistente, creiamo uno nuovo come in menu-dropdown.js
        // Prima nascondi il dropdown originale del WordPress Walker
        dropdown.style.display = 'none';
        
        // Crea un nuovo dropdown dinamico con gli stessi stili di dropdown-list
        var dropdownList = document.createElement('ul');
        dropdownList.className = 'dropdown-list';
        dropdownList.style.margin = '25px 0 0 0';
        dropdownList.style.padding = '0';
        dropdownList.style.listStyle = 'none';
        
        // Copia i link dal dropdown originale al nuovo dropdown
        var originalLinks = dropdown.querySelectorAll('.dropdown-link');
        originalLinks.forEach(function(originalLink) {
            var li = document.createElement('li');
            var a = document.createElement('a');
            a.href = originalLink.href;
            a.textContent = originalLink.textContent;
            a.className = 'dropdown-link';
            a.style.textAlign = 'left';
            li.appendChild(a);
            dropdownList.appendChild(li);
        });
        
        // Aggiungi il nuovo dropdown a headerButtons (come fa dropdown-list)
        if (headerButtons) {
            headerButtons.appendChild(dropdownList);
        }
        
        // Attiva il container
        if (mainButtonsContainer) {
            mainButtonsContainer.classList.add('active');
        }
        
        // Rimuovi align-items-center dalle righe
        if (row) row.classList.remove('align-items-center');
        if (logoCol) logoCol.classList.remove('align-items-center');
        
        // Aggiungi l'immagine di chiusura se non esiste già
        addCloseButton(button, dropdown);
    }

    function closeAllDropdowns() {
        // Rimuovi la classe active da tutti i bottoni
        var allButtons = document.querySelectorAll('.btn-header-custom');
        allButtons.forEach(function(btn) {
            btn.classList.remove('active');
        });
        
        // Nascondi tutti i dropdown originali del WordPress Walker
        var allDropdowns = document.querySelectorAll('.dropdown-generale');
        allDropdowns.forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });
        
        // Rimuovi tutti i dropdown dinamici creati (come fa menu-dropdown.js)
        var dynamicDropdowns = document.querySelectorAll('.dropdown-list');
        dynamicDropdowns.forEach(function(dropdown) {
            dropdown.remove();
        });
        
        // Disattiva il container
        if (mainButtonsContainer) {
            mainButtonsContainer.classList.remove('active');
        }
        
        // Ripristina align-items-center
        if (row) row.classList.add('align-items-center');
        if (logoCol) logoCol.classList.add('align-items-center');
        
        // Rimuovi il bottone di chiusura
        removeCloseButton();
        
        // Resetta gli stati dei bottoni
        resetAllButtonStates();
    }

    function addCloseButton(button, dropdown) {
        // Rimuovi eventuali bottoni di chiusura esistenti
        removeCloseButton();
        
        // Crea bottone close con gli stessi stili di menu-dropdown.js
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
        
        // Aggiungi a headerButtons (come fa menu-dropdown.js)
        if (headerButtons) {
            headerButtons.appendChild(closeImg);
        }
        
        closeImg.addEventListener('click', function(e) {
            e.stopPropagation();
            closeAllDropdowns();
        });
    }

    function removeCloseButton() {
        var existingClose = document.getElementById('dropdown-close-img');
        if (existingClose) {
            existingClose.remove();
        }
    }

    // Menu mobile (mantengo la stessa logica del file originale)
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
            
            // Genera il menu mobile da WordPress se disponibile
            var mobileMenuHTML = generateMobileMenu();
            mobileMenu.innerHTML = mobileMenuHTML;
            
            document.body.appendChild(mobileMenu);
            document.body.style.overflow = 'hidden';
            
            // Chiudi menu cliccando di nuovo sull'hamburger (ora X)
            function closeMenu() {
                if (document.getElementById('mobile-menu')) {
                    mobileMenu.remove();
                    document.body.style.overflow = '';
                    // Ripristina hamburger
                    hamburger.src = '/wp-content/themes/lesto-theme/images/Vector (1).png';
                    hamburger.removeEventListener('click', closeMenu);
                }
            }
            
            hamburger.addEventListener('click', closeMenu);
            
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

    function generateMobileMenu() {
        // Cerca di ottenere i menu items dal DOM del menu desktop
        var mainButtons = document.querySelector('.menu-main-group');
        var contattiButton = document.querySelector('.menu-contatti-item .btn-header-custom');
        var menuItems = [];
        var contattiItem = null;
        
        // Ottieni i bottoni principali
        if (mainButtons) {
            var buttons = mainButtons.querySelectorAll('.btn-header-custom');
            buttons.forEach(function(button) {
                var span = button.querySelector('span');
                if (span) {
                    menuItems.push({
                        text: span.textContent,
                        id: button.id + '-mobile'
                    });
                }
            });
        }
        
        // Ottieni il bottone contatti dal menu desktop
        if (contattiButton) {
            var contattiSpan = contattiButton.querySelector('span');
            if (contattiSpan) {
                contattiItem = {
                    text: contattiSpan.textContent,
                    id: contattiButton.id + '-mobile'
                };
            }
        }
        
        // Se non ci sono menu items, usa fallback
        if (menuItems.length === 0) {
            menuItems = [
                { text: 'Settori', id: 'settori-btn-mobile' },
                { text: 'Servizi', id: 'servizi-btn-mobile' },
                { text: 'Realizzazioni', id: 'realizzazioni-btn-mobile' }
            ];
        }
        
        // Se non c'è il bottone contatti, usa fallback
        if (!contattiItem) {
            contattiItem = { text: 'Contatti', id: 'contatti-btn-mobile' };
        }
        
        var menuButtonsHTML = '';
        menuItems.forEach(function(item) {
            menuButtonsHTML += `<button type="button" class="btn btn-header-custom btn-small" id="${item.id}" style="width:auto!important;min-width:0!important;max-width:fit-content!important;margin:0 0 0;text-align:left;flex-shrink:0;"><span>${item.text}</span></button>`;
        });
        
        return `
            <div id="mobile-menu-list" style="display:flex;flex-direction:column;justify-content:space-between;align-items:flex-start;height:50vh;">
                <div id="menu-main-buttons" style="display:flex;flex-direction:column;align-items:flex-start;">
                    ${menuButtonsHTML}
                </div>
                <div id="menu-contatti-button" style="position:relative; width:100%;">
                    <button type="button" class="btn btn-header-custom btn-small" id="${contattiItem.id}" style="width:auto!important;min-width:0!important;max-width:fit-content!important;margin:0;text-align:left;flex-shrink:0;">
                        <span>${contattiItem.text}</span>
                    </button>
                    <div class="" style="position:absolute;bottom: 5px;right:5px;display:flex;align-items:center;gap:10px;">
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
    }
});
