<?php
/**
 * Template for single Realizzazione (CPT: realizzazione)
 *
 * @package lesto-theme
 */

get_header();
?>

<main class="main-settori single-cpt single-realizzazione">
    <div class="settori-container">
        <div class="container pt-7xl d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <h2 class="m-0"><?php the_title(); ?></h2>
            
            <!-- Display categories and clients -->
           
        </div>
    </div>

    <hr class="footer-divider border-2 opacity-75 w-100">

    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('row g-3 align-items-start'); ?>>
                <div class="col-12 col-lg-6">
                    <?php 
                    $galleria = get_field('galleria_realizzazioni');
                    if ($galleria) : ?>
                        <!-- Galleria ACF -->
                        <div class="galleria-realizzazione">
                            <?php foreach ($galleria as $index => $item) : ?>
                                <div class="galleria-item <?php echo $index === 0 ? 'active' : ''; ?>" style="<?php echo $index === 0 ? '' : 'display: none;'; ?>">
                                    <img src="<?php echo esc_url($item['immagine']['sizes']['large']); ?>" 
                                         class="img-fluid w-100 h-100 object-fit-cover" 
                                         alt="<?php echo esc_attr($item['titolo']); ?>">
                                    <p class="mt-2 text-center"><strong><?php echo esc_html($item['titolo']); ?></strong></p>
                                </div>
                            <?php endforeach; ?>
                            
                            <?php if (count($galleria) > 1) : ?>
                                <!-- Navigation buttons -->
                                <div class="galleria-nav mt-3 d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-outline-primary" onclick="prevImage()">‹ Precedente</button>
                                    <span class="align-self-center" id="image-counter">1 / <?php echo count($galleria); ?></span>
                                    <button class="btn btn-sm btn-outline-primary" onclick="nextImage()">Successiva ›</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php elseif ( has_post_thumbnail() ) : ?>
                        <!-- Fallback to featured image -->
                        <div class="">
                            <?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid w-100 h-100 object-fit-cover' ) ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column align-items-start">
                    <?php if ( has_excerpt() ) : ?>
                        <p class="desktop-p mb-3"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                    
                </div>
            </article>

            <script>
            let currentImageIndex = 0;
            const totalImages = <?php echo $galleria ? count($galleria) : 1; ?>;

            function showImage(index) {
                const items = document.querySelectorAll('.galleria-item');
                items.forEach((item, i) => {
                    item.style.display = i === index ? 'block' : 'none';
                });
                document.getElementById('image-counter').textContent = `${index + 1} / ${totalImages}`;
            }

            function nextImage() {
                currentImageIndex = (currentImageIndex + 1) % totalImages;
                showImage(currentImageIndex);
            }

            function prevImage() {
                currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
                showImage(currentImageIndex);
            }
            </script>

            <?php
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
            ?>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
