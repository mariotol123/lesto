<?php
/**
 * Taxonomy template for Categoria Realizzazione
 *
 * @package lesto-theme
 */

get_header();

$term = get_queried_object();
?>

<main class="main-realizzazioni taxonomy-realizzazioni">
    <div class="realizzazioni-container">
        <div class="container pt-7xl d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <h2 class="m-0">Categoria: <?php echo esc_html($term->name); ?></h2>
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
                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="mosaico-img" alt="<?php the_title(); ?>" loading="lazy">
                            <?php endif; ?>
                            <p class="desktop-p-16"><?php the_title(); ?></p>
                        </a>
                        
                        <!-- Show client info if available -->
                        <?php 
                        $clients = get_the_terms(get_the_ID(), 'cliente_realizzazione');
                        if ($clients && !is_wp_error($clients)) : ?>
                            <div class="client-info mt-2">
                                <small>Cliente: 
                                    <?php foreach ($clients as $client) : ?>
                                        <span class="badge bg-secondary me-1"><?php echo esc_html($client->name); ?></span>
                                    <?php endforeach; ?>
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile;
            else : ?>
                <p>Nessuna realizzazione trovata in questa categoria.</p>
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
