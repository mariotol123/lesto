// Sincronizza animazione immagine e div nella four-section

document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.four-section .row').forEach(row => {
    const img = row.querySelector('.img-four-section');
    const col = row.querySelector('.col-md-4');

    if (img && col) {
      row.addEventListener('mouseenter', () => {
        img.style.transition = 'clip-path 1s cubic-bezier(0.4,0,0.2,1), opacity 0.3s';
        img.style.clipPath = 'inset(0 0 0 0)';
        img.style.opacity = '1';
        setTimeout(() => {
          col.style.transition = 'height 1s cubic-bezier(0.4,0,0.2,1)';
          col.style.height = '100%';
        }, 1000);
      });
      row.addEventListener('mouseleave', () => {
        img.style.clipPath = 'inset(0 0 60% 0)';
        img.style.opacity = '0.7';
        col.style.height = '60px';
      });
    }
  });
});
