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
            <h2 class="m-0"><?php the_title(); ?></h2>
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
                    <?php if ( has_excerpt() ) : ?>
                        <p class="desktop-p mb-3"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                    <div class="entry-content w-100">
                        <?php the_content(); ?>
                        <button class="btn btn-header-custom d-flex justify-content-center mt-3">Contattaci per un
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
    <hr class="footer-divider border-2 opacity-75 w-100">
</main>

<?php get_footer();
