<?php get_header(); ?>

<style>
    /* Barra gris encima de la sección de Breadcrumbs */
    .grey-bar {
        background-color: #f2f2f2;
        /* Gris claro */
        height: 20px;
        /* Altura de la barra */
        width: 100%;
        /* Ancho completo */
    }

    /* Centrar el botón en la tarjeta */
    .card .btn {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

<!-- Barra Gris -->
<div class="grey-bar"></div>

<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?php the_title(); ?></h2>
            <ol>
                <li><a href="<?php echo home_url(); ?>">Inicio</a></li>
                <li><a href="/wordpress/#portfolio">Portafolio</a></li>
                <li><?php the_title(); ?></li>
            </ol>
        </div>
    </div>
</section><!-- Breadcrumbs Section -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php
                        $product_gallery = get_post_meta(get_the_ID(), '_product_image_gallery', true);
                        $gallery_ids = explode(',', $product_gallery);
                        if ($gallery_ids) {
                            foreach ($gallery_ids as $attachment_id) {
                                $image_url = wp_get_attachment_image_url($attachment_id, 'large');
                                echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
                            }
                        } else {
                            echo '<div class="swiper-slide"><img src="' . get_the_post_thumbnail_url(get_the_ID(), 'large') . '" alt=""></div>';
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Información del Proyecto</h3>
                    <ul>
                        <?php
                        $terms = get_the_terms(get_the_ID(), 'product_cat');
                        if ($terms && !is_wp_error($terms)) {
                            $terms_names = array();
                            foreach ($terms as $term) {
                                $terms_names[] = esc_html($term->name);
                            }
                            echo '<li><strong>Categoría</strong>: ' . implode(', ', $terms_names) . '</li>';
                        }
                        ?>
                        <li><strong>Cliente</strong>: <?php echo get_the_excerpt(); ?></li>
                        <?php
                        // Obtener el objeto del producto
                        $product = wc_get_product(get_the_ID());

                        // Obtener el valor del atributo "project_url"
                        $project_url = $product->get_attribute('project_url');

                        // Obtener la fecha de publicación del producto
                        $publication_date = get_the_date('d F, Y', $product->get_id());
                        ?>
                        <li><strong>Fecha del Proyecto</strong>: <?php echo esc_html($publication_date); ?></li>
                        <?php
                        // Obtener el valor del atributo "project_url"
                        $project_url = $product->get_attribute('project_url');
                        ?>
                        <li><strong>URL del Proyecto</strong>:
                            <?php if ($project_url) : ?>
                                <a href="<?php echo esc_url($project_url); ?>"><?php echo esc_html($project_url); ?></a>
                            <?php else : ?>
                                <span>No se proporcionó ninguna URL</span>
                            <?php endif; ?>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <?php
                        // Obtener el nombre del producto
                        $product_name = $product->get_name();

                        // Construir el mensaje de WhatsApp
                        $whatsapp_message = "Hola, quiero cotizar mi proyecto. Me interesa el diseño del portafolio: " . $product_name;

                        // Construir el enlace de WhatsApp
                        $whatsapp_link = "https://api.whatsapp.com/send?phone=+51906829934&text=" . urlencode($whatsapp_message);
                        ?>
                        <a target="_blank" style="color: white;" href="<?php echo esc_url($whatsapp_link); ?>" class="btn btn-info w-100 text-center text-uppercase"><i class='bx bxl-whatsapp'></i>Cotizar para mi Negocio</a>
                    </div>
                </div>
                <div class="portfolio-description">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_content(); ?></p>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Productos Similares</h3>
            </div>
        </div>
        <div class="row mt-3">
            <?php
            $current_product_id = get_the_ID();
            $product_categories = wp_get_post_terms($current_product_id, 'product_cat');
            $category_ids = array();

            if ($product_categories && !is_wp_error($product_categories)) {
                foreach ($product_categories as $category) {
                    $category_ids[] = $category->term_id;
                }

                $related_args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 4, // Número de productos a mostrar
                    'post__not_in' => array($current_product_id),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'term_id',
                            'terms' => $category_ids,
                        ),
                    ),
                );

                $related_query = new WP_Query($related_args);

                if ($related_query->have_posts()) {
                    while ($related_query->have_posts()) {
                        $related_query->the_post();
            ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card" style="width: 100%;">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title(); ?>">
                                <?php } else { ?>
                                    <img src="<?php echo wc_placeholder_img_src(); ?>" class="card-img-top" alt="Placeholder">
                                <?php } ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php the_title(); ?></h5>
                                    <p class="card-text"><?php the_content(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-info mt-auto">Ver más</a>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>No hay productos similares.</p>';
                }
            }
            ?>
        </div>
    </div>

</section><!-- End Portfolio Details Section -->

<?php get_footer(); ?>