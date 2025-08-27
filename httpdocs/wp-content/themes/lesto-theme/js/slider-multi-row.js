// slider-multi-row.js
// Splide carousel per loghi partner

document.addEventListener('DOMContentLoaded', function () {
  console.log('DOM loaded');
  
  const sliderElement = document.getElementById('sliderMultiRow');
  console.log('Slider element:', sliderElement);
  
  if (typeof Splide === 'undefined') {
    console.error('Splide non è caricato!');
    return;
  }
  
  if (sliderElement) {
    console.log('Inizializzo Splide...');
    
    const splide = new Splide('#sliderMultiRow', {
      type: 'loop',           // Carousel infinito
      perPage: 6,             // 6 loghi visibili su desktop
      perMove: 1,             // Sposta 1 elemento alla volta
      autoplay: true,         // Autoplay attivo
      interval: 50000,         // Cambia ogni 3 secondi
      pauseOnHover: true,     // Pausa quando si passa sopra col mouse
      arrows: false,          // Nascondo le frecce
      pagination: false,      // Nascondo i pallini
      gap: '3rem',            // Spazio tra gli elementi
      breakpoints: {
        991: {
          perPage: 3,         // 3 loghi su tablet
        },
        600: {
          perPage: 2,         // 2 loghi su mobile
        }
      }
    });
    
    splide.mount();
    console.log('Splide montato:', splide);
  } else {
    console.error('Elemento slider non trovato!');
  }
});
