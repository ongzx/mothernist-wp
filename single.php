<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <?php if (have_posts()) : ?>

    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>

    <!-- Single content area -->
    <?php while (have_posts()) : the_post(); ?>
      <section id="single-page" class="single-content">
        <?php echo get_template_part( '/includes/template/single-content-full' ); ?>
      </section>
    <?php endwhile; else: ?>
    <?php echo get_template_part( '/includes/template/page-not-found' ); ?>
    <?php endif; ?>
    <!-- end of Single content area -->

    <hr>

    <!-- related post area -->
    <section class="related-section">
      <?php echo get_template_part( '/includes/template/related-post' ); ?>
    </section>

  </div>
  <!-- /container -->

<?php get_footer(); ?>