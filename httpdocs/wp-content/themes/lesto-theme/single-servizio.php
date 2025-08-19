<?php
/**
 * Template for single Servizio (CPT: servizio)
 *
 * @package lesto-theme
 */

get_header();
?>

<main class="main-settori single-cpt single-servizio">
    <div class="settori-container">
        <div class="container pt-7xl d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <?php 
                    $titolo_single_page = get_field('titolo_single_page');
                    if ( $titolo_single_page ) : ?>
                        <h1 class="mb-2 h3"><?php echo esc_html( $titolo_single_page ); ?></h1>
                    <?php endif; ?>
        </div>
    </div>

    <hr class="footer-divider border-2 opacity-75 w-100">

    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('row g-3 align-items-start'); ?>>
                <div class="col-12 col-lg-6">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid w-100 h-100 object-fit-cover' ) ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column align-items-start">
                    <?php 
                    $titolo_accordion = get_field('titolo_accordion');
                    if ( $titolo_accordion ) : ?>
                        <h3 class="mb-2 m_h5 titolo-accordion-single"><?php echo esc_html( strtoupper( $titolo_accordion ) ); ?></h3>
                    <?php endif; ?>
                    <div class="entry-content w-100">
                        <?php the_content(); ?>
                        <button class="btn btn-header-custom d-flex justify-content-center mt-4">Contattaci per un
                    preventivo</button>
                    </div>
                </div>
            </article>

            

            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>

        <?php endwhile; endif; ?>
    </div>
    <hr class="footer-divider border-2 opacity-75 w-100 d-none d-md-block">
</main>

<?php get_footer();
