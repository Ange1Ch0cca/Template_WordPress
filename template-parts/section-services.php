<!-- ======= My Services Section ======= -->
<section id="services" class="services">
  <div class="container">

    <div class="section-title">
      <span>Nuestros Servicios</span>
      <h2>Nuestros Servicios</h2>
      <p>Descubre cómo nuestras soluciones en desarrollo de software, páginas web y diseño gráfico digital pueden impulsar tu negocio al siguiente nivel.</p>
    </div>

    <div class="row">
      <?php
      // Crear una nueva consulta para obtener todas las entradas
      $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1 // Obtener todas las entradas
      ));

      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box mb-3">
              <div class="icon"><?php the_excerpt(); ?></div>
              <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
              <p class="description"><?php the_content(); ?></p>
            </div>
          </div>
      <?php endwhile;
        wp_reset_postdata();
      else :
        echo '<p>No se encontraron entradas.</p>';
      endif;
      ?>
    </div>


  </div>
</section><!-- End My Services Section -->

<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
  <div class="container position-relative">
    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">

        <!-- Aquí irán los testimonios extraídos de WordPress -->
        <?php
        // Obtener los comentarios de WordPress
        $args = array(
          'post_type' => 'comment',  // Tipo de post: comentarios
          'status'    => 'approve',  // Solo comentarios aprobados
          'number'    => 5,          // Número máximo de comentarios a mostrar
          'type'      => 'comment',  // Tipo de objeto del comentario
          'parent'    => 0,          // Solo comentarios principales (no respuestas)
          'fields'    => 'ids',      // Obtener solo los IDs de los comentarios
        );
        $comments_query = new WP_Comment_Query;
        $comments = $comments_query->query($args);

        // Si hay comentarios, mostrar cada uno como un testimonio
        if ($comments) {
          foreach ($comments as $comment_id) {
            $comment = get_comment($comment_id);  // Obtener el objeto del comentario
            $author_name = $comment->comment_author;  // Nombre del autor del comentario
            $content = $comment->comment_content;  // Contenido del comentario
        ?>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <!-- No se incluye la imagen, solo texto -->
                <h3><?php echo esc_html($author_name); ?></h3>
                <h4><?php echo esc_html('Cliente'); ?></h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                  <?php echo esc_html($content); ?>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->
        <?php
          }
        }
        ?>
        <!-- Fin de los testimonios extraídos de WordPress -->

      </div><!-- End swiper-wrapper -->
    </div><!-- End testimonials-slider -->
  </div><!-- End container -->
</section><!-- End testimonials section -->


</div>
<div class="swiper-pagination"></div>
</div>

</div>
</section><!-- End Testimonials Section -->