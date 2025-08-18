// four-section-persist.js
// Rende persistente l'apertura delle row nella four-section dopo il primo hover o click

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.four-section .row').forEach(function(row) {
    row.addEventListener('mouseenter', function() {
      row.classList.add('aperto');
    });
    row.addEventListener('click', function() {
      row.classList.add('aperto');
    });
  });
});
