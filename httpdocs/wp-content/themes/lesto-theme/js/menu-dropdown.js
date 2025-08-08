// menu-dropdown.js
// Gestione dropdown menu header personalizzato

document.addEventListener('DOMContentLoaded', function() {
	var headerButtons = document.querySelector('.header-buttons');
	var buttons = {
		'settori-btn': [
			'Settore 1',
			'Settore 2',
			'Settore 3'
		],
		'servizi-btn': [
			'Servizio 1',
			'Servizio 2',
			'Servizio 3'
		],
		'realizzazioni-btn': [
			'Realizzazione 1',
			'Realizzazione 2',
			'Realizzazione 3'
		]
	};
	Object.keys(buttons).forEach(function(btnId) {
		var btn = document.getElementById(btnId);
		btn.addEventListener('click', function(e) {
			e.preventDefault();
			Object.keys(buttons).forEach(function(otherId) {
				var otherBtn = document.getElementById(otherId);
				if (otherBtn) {
					otherBtn.classList.remove('active');
				}
			});
			document.getElementById('main-buttons-container').classList.add('main-buttons-container');
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
			headerButtons.appendChild(closeImg);
			closeImg.addEventListener('click', function() {
				var oldDropdown = headerButtons.querySelector('.dropdown-list');
				if (oldDropdown) oldDropdown.remove();
				closeImg.remove();
				document.getElementById('main-buttons-container').classList.remove('main-buttons-container');
				Object.keys(buttons).forEach(function(otherId) {
					var otherBtn = document.getElementById(otherId);
					if (otherBtn) otherBtn.classList.remove('active');
				});
			});
			btn.classList.add('active');
			var oldDropdown = headerButtons.querySelector('.dropdown-list');
			if (oldDropdown) {
				oldDropdown.remove();
			}
			var dropdownList = document.createElement('ul');
			dropdownList.className = 'dropdown-list';
			dropdownList.style.margin = '25px 0 0 0';
			dropdownList.style.padding = '0';
			dropdownList.style.listStyle = 'none';
			buttons[btnId].forEach(function(voce) {
				var li = document.createElement('li');
				var a = document.createElement('a');
				a.href = '#';
				a.className = 'dropdown-link';
				a.style.textAlign = 'left';
				a.textContent = voce;
				li.appendChild(a);
				dropdownList.appendChild(li);
			});
			headerButtons.appendChild(dropdownList);
		});
	});
	document.addEventListener('click', function(e) {
		var oldDropdown = headerButtons.querySelector('.dropdown-list');
		if (oldDropdown && !headerButtons.contains(e.target)) {
			oldDropdown.remove();
			Object.keys(buttons).forEach(function(otherId) {
				var otherBtn = document.getElementById(otherId);
				if (otherBtn) {
					otherBtn.classList.remove('active');
				}
			});
			var closeImg = document.getElementById('dropdown-close-img');
			if (closeImg) closeImg.remove();
			document.getElementById('main-buttons-container').classList.remove('main-buttons-container');
			document.getElementById('main-buttons-container').classList.remove('main-buttons-container');
		}
	});
});
