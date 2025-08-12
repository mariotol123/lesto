<?php
/**
 * Template name: Settori
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lesto-theme
 */

get_header();
?>

<!-- Main content area -->
<main class="main-settori">
    <div class="settori-container">
        <h2 class="container pt-7xl">Settori</h2>
    </div>
    <hr class="footer-divider border-2 opacity-75 w-100">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-4 d-flex flex-column align-items-start">
                <h5>dalla progettazione alla manutenzione, la tua cucina professionale.</h5>
                <p class="mt-3">La tua cucina, al livello di performance che si merita. Dal 1984 Lesto Group si occupa
                    di consulenza, progettazione, vendita e assistenza di attrezzature professionali per ristoranti,
                    hotel, pizzerie, gastronomie e bar.</p>
            </div>
            <div class="col-md-8 d-flex justify-content-center align-items-center">
                <img src="/wp-content/themes/lesto-theme/images/img-settori.png" alt="Immagine Settori"
                    class="img-fluid img-overflow" />
            </div>
        </div>
    </div>


    <hr class="footer-divider border-2 opacity-75 w-100">

   <div class="pt-8xl pb-8xl container">
    <div class="accordion-container header-buttons d-flex flex-column align-items-start">

        <div class="header-buttons">
            <button class="accordion-button btn btn-header-custom d-flex align-items-center" type="button">
                <img class="icon" src="/wp-content/themes/lesto-theme/images/Group 1.png" alt="icon" />
                <span>Cucine</span>
            </button>
            <div class="accordion-content" style="display:none;">
                <p>Contenuto relativo alle cucine...</p>
            </div>
        </div>

        <div class="header-buttons">
            <button class="accordion-button btn btn-header-custom" type="button">
                Arrebo bar
            </button>
            <div class="accordion-content" style="display:none;">
                <p>Contenuto relativo agli Arrebo bar...</p>
            </div>
        </div>

        <div class="header-buttons">
            <button class="accordion-button btn btn-header-custom" type="button">
                Cucine aziendali
            </button>
            <div class="accordion-content" style="display:none;">
                <p>Contenuto relativo alle cucine aziendali...</p>
            </div>
        </div>

        <div class="header-buttons">
            <button class="accordion-button btn btn-header-custom" type="button">
                Lestowatt
            </button>
            <div class="accordion-content" style="display:none;">
                <p>Contenuto relativo a Lestowatt...</p>
            </div>
        </div>

    </div>
</div>

<script>
document.querySelectorAll(".accordion-button").forEach(btn => {
    btn.addEventListener("click", () => {
        const content = btn.nextElementSibling;
        const isVisible = content.style.display === "block";
        // Chiude tutti
        document.querySelectorAll(".accordion-content").forEach(c => c.style.display = "none");
        // Rimuove la classe active da tutti i genitori
        document.querySelectorAll(".accordion-button").forEach(b => {
            if (b.parentElement) b.parentElement.classList.remove("active");
        });
        // Apre solo quello cliccato
        if (!isVisible) {
            content.style.display = "block";
            if (btn.parentElement) btn.parentElement.classList.add("active");
        } else {
            if (btn.parentElement) btn.parentElement.classList.remove("active");
        }
    });
});
</script>


</main>

<?php

get_footer();
