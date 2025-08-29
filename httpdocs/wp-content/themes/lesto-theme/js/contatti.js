// lestoform.js
// Gestisce l'animazione del bottone Invia e l'incavatura SVG su hover

document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('submit');
    const svg = document.getElementById('curvedbg');
    const path = svg ? svg.querySelector('path') : null;
    if (!button || !svg || !path) return;

    // Path originale e path "hover" (modifica solo la parte destra incavata)
    const originalD = path.getAttribute('d');
    
    // Path per mobile (più allargato di base e meno squadrato)
    const mobileD = 'M30 0.5H715C731.292 0.5 744.5 13.7076 744.5 30V121.5C744.5 137.792 731.292 151 715 151H630C615 151 604 162.529 604 176.75C604 190.419 593 201.5 579.5 201.5H30C13.7076 201.5 0.5 188.292 0.5 172V30C0.5 13.7076 13.7076 0.5 30 0.5Z';
    
    // Funzione per aggiornare il path in base alle dimensioni
    function updatePathForDevice() {
        const isMobile = window.innerWidth <= 768;
        if (isMobile) {
            path.setAttribute('d', mobileD);
        } else {
            path.setAttribute('d', originalD);
        }
        return isMobile;
    }
    
    // Imposta il path iniziale
    let currentIsMobile = updatePathForDevice();
    
    // Listener per il resize della finestra
    window.addEventListener('resize', function() {
        currentIsMobile = updatePathForDevice();
    });
    
    // hoverD: la "pancia" destra (incavatura) rientra verso sinistra
    // Modifica solo i valori da H684.098 in poi, spostando la curva verso sinistra
    const hoverD =
        'M30 0.5H715C731.292 0.5 744.5 13.7076 744.5 30V121.5C744.5 137.792 731.292 151 715 151H660C645 151 634 162.529 634 176.75C634 190.419 623 201.5 609.5 201.5H30C13.7076 201.5 0.5 188.292 0.5 172V30C0.5 13.7076 13.7076 0.5 30 0.5Z';

     // Aggiungi transizione CSS per l'SVG path
    path.style.transition = 'd 1s cubic-bezier(.3,1,.3,1)';

    // Animazione SVG e bottone
    button.addEventListener('mouseenter', function() {
        // Allarga il bottone verso sinistra
        button.style.transform = 'translateX(0px) scaleX(1)';
        button.style.transition = 'all 1s cubic-bezier(.4,1.5,.5,1)';
        // Modifica la curva SVG (rientra solo la "pancia" destra)
        path.setAttribute('d', hoverD);
    });
    button.addEventListener('mouseleave', function() {
        button.style.transform = '';
        button.style.transition = 'all 1 ease';
        // Ripristina transizione per il mouseleave
        path.style.transition = 'd 1s ease';
        // Usa il path corretto a seconda del device
        path.setAttribute('d', currentIsMobile ? mobileD : originalD);
    });
});
