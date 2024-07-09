<?php get_header(); ?>

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <h1><?php bloginfo('name'); ?></h1>
        <h2><?php bloginfo('description'); ?></h2>
        <a href="#about" class="btn-scroll scrollto" title="Scroll Down"><i class="bx bx-chevron-down"></i></a>
    </div>
</section><!-- End Hero -->

<main id="main">


    <main id="main">
    <?php get_template_part('template-parts/section-about'); ?>
    <?php get_template_part('template-parts/section-resume'); ?>
    <?php get_template_part('template-parts/section-services'); ?>
    <?php get_template_part('template-parts/section-portfolio'); ?>
    <?php get_template_part('template-parts/section-pricing'); ?>
    <?php get_template_part('template-parts/section-contact'); ?>
    </main>

<?php get_footer(); ?>
