document.addEventListener('DOMContentLoaded', function() {
  var grid = document.querySelector('.mosaico-cards');
  if(grid) {
    new Masonry(grid, {
      itemSelector: '.mosaico-img',
      percentPosition: true,
      gutter: 16,
    });
  }
});