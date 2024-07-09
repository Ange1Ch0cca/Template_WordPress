<section id="portfolio" class="portfolio">
    <div class="container">

        <div class="section-title">
          <span>Portafolio</span>
          <h2>Portafolio</h2>
          <p>Explora nuestro trabajo destacado en desarrollo de software, diseño web y gráfico digital. Descubre cómo podemos ayudarte a alcanzar tus objetivos.</p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center">
            <li data-filter="*" class="filter-active"><?php _e('Todo', 'your-text-domain'); ?></li>
            <?php
            // Obtener todas las categorías de los productos
            $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
            ));

            foreach ($product_categories as $category) {
                echo '<li data-filter=".filter-' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</li>';
            }
            ?>
        </ul>

        <div class="row portfolio-container">
            <!-- Portfolio Items -->
            <?php
            // Fetch portfolio items from the database
            $args = array(
                'post_type' => 'product', // Cambiar para productos
                'posts_per_page' => 9,
                'orderby' => 'rand' // Ordenar aleatoriamente para variar las categorías
            );
            $portfolio_query = new WP_Query($args);

            if ($portfolio_query->have_posts()) :
                while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                    $product_categories = wp_get_post_terms(get_the_ID(), 'product_cat'); // Obtener las categorías del producto
                    $portfolio_filter_class = '';
                    if ($product_categories && !is_wp_error($product_categories)) {
                        foreach ($product_categories as $category) {
                            $portfolio_filter_class .= ' filter-' . $category->slug;
                        }
                    }
            ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?php echo esc_attr($portfolio_filter_class); ?>">
                        <div class="portfolio-img">
                            <?php 
                            // Mostrar la imagen destacada del producto
                            echo woocommerce_get_product_thumbnail('medium', array('class' => 'img-fluid'));
                            ?>
                        </div>
                        <div class="portfolio-info">
                            <h4><?php the_title(); ?></h4>
                            <p>
                                <?php 
                                if ($product_categories && !is_wp_error($product_categories)) {
                                    $first_category = $product_categories[0];
                                    echo esc_html($first_category->name);
                                }
                                ?>
                            </p>
                            <a href="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="<?php the_title(); ?>"><i class="bx bx-plus"></i></a>
                            <a href="<?php the_permalink(); ?>" class="details-link" title="<?php _e('More Details', 'your-text-domain'); ?>"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
            ?>
                <p><?php _e('No se encontraron productos', 'your-text-domain'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
jQuery(document).ready(function($) {
    $('#portfolio-flters li').on('click', function() {
        $('#portfolio-flters li').removeClass('filter-active');
        $(this).addClass('filter-active');

        var selectedFilter = $(this).data('filter');
        $('.portfolio-item').hide();

        if (selectedFilter == '*') {
            $('.portfolio-item').fadeIn();
        } else {
            $(selectedFilter).fadeIn();
        }
    });
});
</script>
