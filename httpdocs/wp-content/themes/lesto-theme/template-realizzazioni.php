<?php
/**
 * Template name: Realizzazioni
 *
 * @package lesto-theme
 */

get_header();
?>

<main class="main-realizzazioni archive-realizzazioni">
    <div class="realizzazioni-container">
        <div class="container pt-7xl d-flex justify-content-between">
            <h2 class="">Realizzazioni</h2>
            <!-- Button desktop - visibili solo su desktop -->
            <div class="d-flex align-items-center gap-4 d-none d-md-flex">
                <h5 class="filter-toggle active" data-filter="categorie">CATEGORIE</h5>
                <h5 class="filter-toggle" data-filter="clienti">CLIENTI</h5>
            </div>
        </div>
        <hr class="footer-divider border-2 opacity-75 w-100">
        
        <!-- Button mobile - visibili solo su mobile sotto l'hr -->
        <div class="container d-flex d-md-none gap-4 mt-4 justify-content-center">
            <h5 class="filter-toggle active mobile-filter-btn" data-filter="categorie">CATEGORIE</h5>
            <h5 class="filter-toggle mobile-filter-btn" data-filter="clienti">CLIENTI</h5>
        </div>
        
        <!-- Due colonne sotto l'hr -->
        <div class="container mt-4 pb-10xl">
            <div class="row">
                <!-- Sidebar filtri -->
                <div class="col-md-3 d-flex flex-column gap-3">
                    <div id="filter-categorie" class="filter-section active">
                        <p class="desktop-p-16 filter-item active" data-term="all">Tutte le realizzazioni</p>
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'categoria_realizzazione',
                            'hide_empty' => false, // Mostra anche le categorie vuote
                        ));
                        
                        if ($categories && !is_wp_error($categories)) :
                            foreach ($categories as $category) : ?>
                                <p class="desktop-p-16 filter-item" data-term="<?php echo esc_attr($category->slug); ?>" data-taxonomy="categoria_realizzazione">
                                    <?php echo esc_html($category->name); ?>
                                </p>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                    
                    <div id="filter-clienti" class="filter-section" style="display: none;">
                        <?php
                        $clients = get_terms(array(
                            'taxonomy' => 'cliente_realizzazione',
                            'hide_empty' => false, // Mostra anche i clienti vuoti
                        ));
                        
                        if ($clients && !is_wp_error($clients)) :
                            foreach ($clients as $client) : ?>
                                <p class="desktop-p-16 filter-item" data-term="<?php echo esc_attr($client->slug); ?>" data-taxonomy="cliente_realizzazione">
                                    <?php echo esc_html($client->name); ?>
                                </p>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                </div>
                
                <!-- Grid delle realizzazioni -->
                <div class="col-md-9">
                    <div class="mosaico-cards" id="realizzazioni-grid">
                        <?php
                        $realizzazioni_query = new WP_Query(array(
                            'post_type' => 'realizzazione',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));

                        if ($realizzazioni_query->have_posts()) :
                            while ($realizzazioni_query->have_posts()) : $realizzazioni_query->the_post();
                                // Get categories and clients for data attributes
                                $categories = get_the_terms(get_the_ID(), 'categoria_realizzazione');
                                $clients = get_the_terms(get_the_ID(), 'cliente_realizzazione');
                                
                                $cat_slugs = array();
                                $client_slugs = array();
                                
                                if ($categories && !is_wp_error($categories)) {
                                    foreach ($categories as $cat) {
                                        $cat_slugs[] = $cat->slug;
                                    }
                                }
                                
                                if ($clients && !is_wp_error($clients)) {
                                    foreach ($clients as $client) {
                                        $client_slugs[] = $client->slug;
                                    }
                                }

                                // Get ACF gallery
                                $galleria = get_field('galleria_realizzazioni');
                                
                                if ($galleria) :
                                    foreach ($galleria as $item) : ?>
                                        <div class="mosaico-cards__item" 
                                             data-categories="<?php echo esc_attr(implode(' ', $cat_slugs)); ?>"
                                             data-clients="<?php echo esc_attr(implode(' ', $client_slugs)); ?>">
                                            <a href="<?php the_permalink(); ?>" style="text-decoration: none;">
                                                <img src="<?php echo esc_url($item['immagine']['sizes']['large']); ?>" 
                                                     class="mosaico-img" 
                                                     alt="<?php echo esc_attr($item['titolo']); ?>">
                                                <p class="desktop-p-16"><?php echo esc_html($item['titolo']); ?></p>
                                            </a>
                                        </div>
                                    <?php endforeach;
                                else : 
                                    // Fallback to featured image
                                    ?>
                                    <div class="mosaico-cards__item" 
                                         data-categories="<?php echo esc_attr(implode(' ', $cat_slugs)); ?>"
                                         data-clients="<?php echo esc_attr(implode(' ', $client_slugs)); ?>">
                                        <a href="<?php the_permalink(); ?>" style="text-decoration: none;">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php the_post_thumbnail('large', array('class' => 'mosaico-img', 'alt' => get_the_title())); ?>
                                            <?php else : ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.jpg" class="mosaico-img" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                            <p class="desktop-p-16"><?php the_title(); ?></p>
                                        </a>
                                    </div>
                                <?php endif;
                            endwhile;
                            wp_reset_postdata();
                        else : ?>
                            <p>Nessuna realizzazione trovata.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add CSS transitions to grid items
    const style = document.createElement('style');
    style.textContent = `
        .mosaico-cards__item {
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 1;
            transform: scale(1);
        }
        .mosaico-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
    `;
    document.head.appendChild(style);
    
    // Toggle tra categorie e clienti
    const filterToggles = document.querySelectorAll('.filter-toggle');
    const filterSections = document.querySelectorAll('.filter-section');
    
    filterToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const filterType = this.dataset.filter;
            
            // Remove active class from all toggles
            filterToggles.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Hide all filter sections
            filterSections.forEach(section => {
                section.style.display = 'none';
                section.classList.remove('active');
            });
            
            // Show selected filter section
            const targetSection = document.getElementById('filter-' + filterType);
            if (targetSection) {
                targetSection.style.display = 'block';
                targetSection.classList.add('active');
            }
            
            // Reset all filters
            resetFilters();
        });
    });
    
    // Filter functionality
    const filterItems = document.querySelectorAll('.filter-item');
    const gridItems = document.querySelectorAll('.mosaico-cards__item');
    
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const term = this.dataset.term;
            const taxonomy = this.dataset.taxonomy;
            
            // Remove active class from all filter items in current section
            const currentSection = this.closest('.filter-section');
            currentSection.querySelectorAll('.filter-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // Filter grid items with smooth animation
            if (term === 'all') {
                gridItems.forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 50);
                    }, 150);
                });
            } else {
                gridItems.forEach(item => {
                    const itemData = taxonomy === 'categoria_realizzazione' ? 
                                   item.dataset.categories : 
                                   item.dataset.clients;
                    
                    if (itemData && itemData.includes(term)) {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'block';
                            setTimeout(() => {
                                item.style.opacity = '1';
                                item.style.transform = 'scale(1)';
                            }, 50);
                        }, 150);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            }
        });
    });
    
    function resetFilters() {
        // Show all items with animation
        gridItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.8)';
            setTimeout(() => {
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 50);
            }, 150);
        });
        
        // Reset active filter items
        filterItems.forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.filter-item[data-term="all"]').forEach(item => {
            item.classList.add('active');
        });
    }
});
</script>

<?php get_footer(); ?>
