document.addEventListener('DOMContentLoaded', function() {
  var grid = document.querySelector('.mosaico-cards');
  if(grid) {
    new Masonry(grid, {
      itemSelector: 'div', // oppure '.mosaico-cards > div'
      percentPosition: true,
      gutter: 16,
    });
    // Forza altezza e scroll dopo Masonry
    grid.style.height = '500px';
    grid.style.overflowY = 'auto';
  }

  // Gestione click per active su p.desktop-p-16 e h5
  function setActive(selector) {
    var items = document.querySelectorAll(selector);
    items.forEach(function(item) {
      item.addEventListener('click', function() {
        items.forEach(function(el) { el.classList.remove('active'); });
        item.classList.add('active');
      });
    });
  }
  setActive('.realizzazioni-container p.desktop-p-16');
  setActive('.realizzazioni-container h5');
});