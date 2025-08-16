<?php
/**
 * Taxonomy template for Cliente Realizzazione
 *
 * @package lesto-theme
 */

get_header();

$term = get_queried_object();
?>

<main class="main-realizzazioni taxonomy-realizzazioni">
    <div class="realizzazioni-container">
        <div class="container pt-7xl d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <h2 class="m-0">Cliente: <?php echo esc_html($term->name); ?></h2>
            <div class="breadcrumb">
                <a href="<?php echo get_post_type_archive_link('realizzazione'); ?>">Tutte le realizzazioni</a>
                <span> / </span>
                <span><?php echo esc_html($term->name); ?></span>
            </div>
        </div>
        
        <?php if ($term->description) : ?>
            <div class="container">
                <p class="taxonomy-description"><?php echo esc_html($term->description); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <hr class="footer-divider border-2 opacity-75 w-100">

    <div class="container mt-4 pb-10xl">
        <div class="mosaico-cards">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post(); ?>
                    <div class="mosaico-cards__item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large', array('class' => 'mosaico-img', 'alt' => get_the_title())); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="mosaico-img" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <p class="desktop-p-16"><?php the_title(); ?></p>
                        </a>
                        
                        <!-- Show category info if available -->
                        <?php 
                        $categories = get_the_terms(get_the_ID(), 'categoria_realizzazione');
                        if ($categories && !is_wp_error($categories)) : ?>
                            <div class="category-info mt-2">
                                <small>Categoria: 
                                    <?php foreach ($categories as $category) : ?>
                                        <span class="badge bg-primary me-1"><?php echo esc_html($category->name); ?></span>
                                    <?php endforeach; ?>
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile;
            else : ?>
                <p>Nessuna realizzazione trovata per questo cliente.</p>
            <?php endif; ?>
        </div>
        
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '&laquo; Precedente',
            'next_text' => 'Successivo &raquo;',
        ));
        ?>
    </div>
    
    <hr class="footer-divider border-2 opacity-75 w-100">
</main>

<?php get_footer(); ?>
