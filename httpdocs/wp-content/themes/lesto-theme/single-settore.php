<?php
/**
 * Template for single Settore (CPT: settore)
 *
 * @package lesto-theme
 */

get_header();
?>

<main class="main-settori single-cpt single-settore">
    <div class="settori-container">
        <div class="container pt-7xl d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <h2 class="m-0"><?php the_title(); ?></h2>
            <a class="btn btn-header-custom" href="<?php echo esc_url( get_post_type_archive_link( 'settore' ) ); ?>">Torna ai Settori</a>
        </div>
    </div>

    <hr class="footer-divider border-2 opacity-75 w-100">

    <div class="container py-5">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('row g-5 align-items-start'); ?>>
                <div class="col-12 col-lg-6">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="ratio ratio-16x9">
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
                    </div>
                </div>
            </article>

            <hr class="footer-divider border-2 opacity-75 w-100 mt-5">

            

            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer();
