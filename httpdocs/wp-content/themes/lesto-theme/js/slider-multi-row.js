// slider-multi-row.js
// Slider drag to scroll + loop infinito solo con mouse premuto

document.addEventListener('DOMContentLoaded', function() {
  const slider = document.getElementById('sliderMultiRow');
  const sliderInner = document.getElementById('sliderMultiRowInner');
  if (!slider || !sliderInner) return;

  let isDown = false;
  let startX;
  let scrollLeft;

  slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
  });

  slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
  });

  slider.addEventListener('mousemove', (e) => {
    if(!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2;
    slider.scrollLeft = scrollLeft - walk;
  });

  // Disabilita scroll con rotella e tastiera
  slider.addEventListener('wheel', (e) => {
    e.preventDefault();
  }, { passive: false });
  slider.addEventListener('keydown', (e) => {
    e.preventDefault();
  });

  // Loop infinito
  slider.addEventListener('scroll', () => {
    const maxScroll = sliderInner.scrollWidth / 2;
    if (slider.scrollLeft >= maxScroll) {
      slider.scrollLeft = slider.scrollLeft - maxScroll;
    } else if (slider.scrollLeft <= 0) {
      slider.scrollLeft = slider.scrollLeft + maxScroll;
    }
  });

  // Imposta scroll iniziale al centro
  slider.scrollLeft = sliderInner.scrollWidth / 4;
});
