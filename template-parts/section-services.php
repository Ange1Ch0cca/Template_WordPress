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


</div>
<div class="swiper-pagination"></div>
</div>

</div>
</section><!-- End Testimonials Section -->