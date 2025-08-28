<?php
/**
 * Template for single Realizzazione (CPT: realizzazione)
 *
 * @package lesto-theme
 */

get_header();
?>

<main class="single-cpt single-realizzazione">
    <div class="settori-container border-bottom">
        <div class="container pt-8xl d-flex align-items-center justify-content-between gap-3 flex-wrap pb-4">
            <h1 class="m-0 h3 titolo-realizzazione">Titolo realizzazione</h1>
            <img src="<?php echo get_template_directory_uri(); ?>/images/freccia-realizzazioni.svg" alt="Freccia realizzazioni" class="freccia-realizzazioni">
            
            <!-- Display categories and clients -->
           
        </div>
    </div>

    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <!-- Colonna sinistra con contenuto testuale -->
            <div class="col-lg-4 col-md-12">
                <div class="realizzazione-content d-flex flex-column gap-2">
                    <p class="h5">CLIENTE</p>
                    <h5 class="h4 mb-2">CLIENTE</h5>
                    
                    <p class="desktop-p-16">Settore cliente</p>
                    
                    <p class="desktop-p">Voluptatem officia dolor repellat. Illo voluptatibus similique est non. Quis assumenda quia quod est. Voluptatem quia quo sunt ab iure id.</p>
                    
                    <p class="desktop-p-16">Location</p>
                    <p class="desktop-p">Voluptatem officia dolor repellat.</p>
                    
                    <p class="desktop-p-16">Richieste cliente</p>
                    <p class="desktop-p">Il cliente aveva necessità di creare una zona cottura a vista all'interno del Teatro, con l'impossibilità di creare una canna fumaria dato che l'Arredoluce è protetto dalle Belle Arti</p>
                    
                    <p class="desktop-p-16">ESIGENZE PARTICOLARI</p>
                    <p class="desktop-p">Abbiamo realizzato un impianto senza canna fumaria, creando una centralina a carboni attivi completamente su misura, per gestire la velocità dell'aria e raggiungere un grado di filtrazione degli odori perfetta.</p>
                </div>
            </div>
            
            <!-- Colonna destra con immagine -->
            <div class="col-lg-4 col-md-12">
                <div class="realizzazione-image d-flex flex-column">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/professional kitchen.png" alt="Professional Kitchen" class="img-fluid">
                    <div class="d-flex justify-content-end mt-auto w-auto">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-sinistra.svg" alt="Freccie immagine realizzazioni" class="freccie-img-realizzazioni">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/arrow-destra.svg" alt="Freccie immagine realizzazioni" class="freccie-img-realizzazioni">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
