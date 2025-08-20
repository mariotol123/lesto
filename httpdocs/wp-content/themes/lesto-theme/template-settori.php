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
        <h1 class="container pt-7xl h2">Settori</h1>
    </div>
    <hr class="footer-divider border-2 opacity-75 w-100">
    <div class="container py-3">
        <div class="row">
            <div class="col-md-4 d-flex flex-column align-items-start">
                <h5>dalla progettazione alla manutenzione, la tua cucina professionale.</h5>
                <p class="mt-3 desktop-p page-description-settori">La tua cucina, al livello di performance che si merita. Dal 1984 Lesto Group
                    si occupa
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

    <div class="pb-8xl pt-md-8xl container">
        <?php
        // Get all settori
        $settori = get_posts(array(
            'post_type' => 'settore',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));
        ?>
        
        <!-- Mobile: tab scrollable h6 -->
        <div class="accordion-mobile-tabs d-flex d-md-none mb-2" style="overflow-x:auto; white-space:nowrap; gap:1rem;">
            <?php foreach ($settori as $index => $settore) : 
                $titolo_accordion = get_field('titolo_accordion', $settore->ID);
            ?>
                <h6 class="accordion-mobile-tab <?php echo $index === 0 ? 'active' : ''; ?>" data-tab="<?php echo $index; ?>">
                    <?php echo $titolo_accordion ? esc_html($titolo_accordion) : esc_html($settore->post_title); ?>
                </h6>
            <?php endforeach; ?>
        </div>
        <!-- Desktop: accordion originale -->
        <div class="accordion-container buttons d-none d-md-flex flex-column align-items-start">
            <?php foreach ($settori as $index => $settore) : 
                $sottotitolo = get_field('sottotitolo', $settore->ID);
                $titolo_accordion = get_field('titolo_accordion', $settore->ID);
                $sottotitolo_accordion = get_field('sottotitolo_accordion', $settore->ID);
                $riassunto_accordion = get_field('riassunto_accordion', $settore->ID);
                $immagine = get_the_post_thumbnail_url($settore->ID, 'full');
                if (!$immagine) {
                    $immagine = '/wp-content/themes/lesto-theme/images/Rectangle 1.png';
                }
                $icona = get_field('icona', $settore->ID);
            ?>
            <div class="buttons <?php echo $index === 0 ? 'active' : ''; ?>">
                <button class="accordion-button btn btn-header-custom d-flex align-items-center <?php echo $index === 0 ? 'active' : ''; ?>" type="button">
                    <?php if ($icona) : ?>
                        <img class="icon" src="<?php echo esc_url($icona['url']); ?>" alt="<?php echo esc_attr($icona['alt']); ?>" />
                    <?php else : ?>
                        <img class="icon" src="/wp-content/themes/lesto-theme/images/Group 1.png" alt="icon" />
                    <?php endif; ?>
                    <span><?php echo $titolo_accordion ? esc_html($titolo_accordion) : esc_html($settore->post_title); ?></span>
                </button>
                <div class="accordion-content" style="display:<?php echo $index === 0 ? 'block' : 'none'; ?>;">
                    <h3 class="mb-3"><?php echo $titolo_accordion ? esc_html($titolo_accordion) : esc_html($settore->post_title); ?></h3>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo esc_url($immagine); ?>" alt="<?php echo esc_attr($settore->post_title); ?>" class="img-fluid" />
                        </div>
                        <div class="col-md-6 d-flex flex-column align-items-start">
                            <h5 class="mb-2 m_h5"><?php echo $sottotitolo_accordion ? esc_html($sottotitolo_accordion) : 'Soluzioni su misura per la tua azienda'; ?></h5>
                            <p class="mb-3 mt-3 desktop-p"><?php echo $riassunto_accordion ? nl2br(esc_html($riassunto_accordion)) : wp_trim_words($settore->post_content, 30, '...'); ?></p>
                            <a href="<?php echo esc_url(get_permalink($settore->ID)); ?>" class="btn btn-header-custom mt-2">Scopri i dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- Mobile: contenuti accordion -->
        <div class="accordion-mobile-contents d-block d-md-none mb-5">
            <?php foreach ($settori as $index => $settore) : 
                $sottotitolo = get_field('sottotitolo', $settore->ID);
                $titolo_accordion = get_field('titolo_accordion', $settore->ID);
                $sottotitolo_accordion = get_field('sottotitolo_accordion', $settore->ID);
                $riassunto_accordion = get_field('riassunto_accordion', $settore->ID);
                $immagine = get_the_post_thumbnail_url($settore->ID, 'full');
                if (!$immagine) {
                    $immagine = '/wp-content/themes/lesto-theme/images/Rectangle 1.png';
                }
            ?>
            <div class="accordion-mobile-content <?php echo $index === 0 ? '' : 'd-none'; ?>" data-tab="<?php echo $index; ?>">
                <!-- Contenuto <?php echo $titolo_accordion ? esc_html($titolo_accordion) : esc_html($settore->post_title); ?> -->
                <img src="<?php echo esc_url($immagine); ?>" alt="<?php echo esc_attr($settore->post_title); ?>" class="img-fluid accordion-mobile-img mb-3" />
                <div class="row">
                    <div class="col-12 d-flex flex-column align-items-start mt-3">
                        <h5 class="mb-2 m_h5"><?php echo $sottotitolo_accordion ? esc_html($sottotitolo_accordion) : 'Soluzioni su misura per la tua azienda'; ?></h5>
                        <p class="mb-3 desktop-p"><?php echo $riassunto_accordion ? nl2br(esc_html($riassunto_accordion)) : wp_trim_words($settore->post_content, 30, '...'); ?></p>
                        <a href="<?php echo esc_url(get_permalink($settore->ID)); ?>" class="btn btn-header-custom d-flex justify-content-center w-100">Scopri i dettagli</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="preventivo-video-wrapper">
        <video class="preventivo-bg-video" autoplay loop muted playsinline>
            <source src="/wp-content/themes/lesto-theme/videos/6613032-hd_1920_1080_25fps (1).mp4" type="video/mp4">
            Il tuo browser non supporta il video di sfondo.
        </video>
        <div class="container preventivo-container py-5">
            <div class="row">
                <div class="col-md-6">
                    <h3>Contattaci per <br>un preventivo gratuito</h3>
                    <h5 class="preventivo-mobile-title d-block d-md-none mt-3 mb-10xl">IL NOSTRO SHOWROOM DINAMICO</h5>
                    <h4 class="mt-5">Ti risponderemo entro 24h</h4>
                    <button class="btn btn-custom d-block d-md-none mt-4 w-100">Scopri di più</button>
                </div>
                <div class="col-md-6 d-none d-md-flex justify-content-end align-items-end">
                    <button class="btn btn-custom">Scopri di più</button>
                </div>
            </div>
        </div>
    </div>



    <script>
    // Desktop accordion (già presente)
    document.querySelectorAll(".accordion-button").forEach(btn => {
        btn.addEventListener("click", () => {
            const content = btn.nextElementSibling;
            const isVisible = content.style.display === "block";
            document.querySelectorAll(".accordion-content").forEach(c => c.style.display = "none");
            document.querySelectorAll(".accordion-button").forEach(b => {
                if (b.parentElement) b.parentElement.classList.remove("active");
                b.classList.remove("active");
            });
            if (!isVisible) {
                content.style.display = "block";
                if (btn.parentElement) btn.parentElement.classList.add("active");
                btn.classList.add("active");
            } else {
                if (btn.parentElement) btn.parentElement.classList.remove("active");
                btn.classList.remove("active");
            }
        });
    });

    // Mobile tab switcher
    document.querySelectorAll('.accordion-mobile-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Attiva solo il tab cliccato
            document.querySelectorAll('.accordion-mobile-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            // Mostra solo il contenuto corrispondente
            const idx = this.getAttribute('data-tab');
            document.querySelectorAll('.accordion-mobile-content').forEach((c, i) => {
                if (c.getAttribute('data-tab') === idx) {
                    c.classList.remove('d-none');
                } else {
                    c.classList.add('d-none');
                }
            });
        });
    });
    </script>

    <!-- styles spostati in main.scss -->


</main>

<?php

get_footer();
