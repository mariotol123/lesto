<?php
/**
 * Template part for displaying realizzazioni
 *
 * @package lesto-theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mosaico-cards__item'); ?>>
    <a href="<?php the_permalink(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('large', array('class' => 'mosaico-img', 'alt' => get_the_title())); ?>
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="mosaico-img" alt="<?php the_title(); ?>">
        <?php endif; ?>
        <p class="desktop-p-16"><?php the_title(); ?></p>
    </a>
    
    <!-- Display taxonomy terms -->
    <div class="taxonomy-info mt-2">
        <?php 
        $categories = get_the_terms(get_the_ID(), 'categoria_realizzazione');
        if ($categories && !is_wp_error($categories)) : ?>
            <div class="categories mb-1">
                <small>
                    <?php foreach ($categories as $category) : ?>
                        <span class="badge bg-primary me-1"><?php echo esc_html($category->name); ?></span>
                    <?php endforeach; ?>
                </small>
            </div>
        <?php endif; ?>
        
        <?php 
        $clients = get_the_terms(get_the_ID(), 'cliente_realizzazione');
        if ($clients && !is_wp_error($clients)) : ?>
            <div class="clients">
                <small>
                    <?php foreach ($clients as $client) : ?>
                        <span class="badge bg-secondary me-1"><?php echo esc_html($client->name); ?></span>
                    <?php endforeach; ?>
                </small>
            </div>
        <?php endif; ?>
    </div>
</article>
