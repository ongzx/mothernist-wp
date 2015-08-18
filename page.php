<?php get_header(); ?>

  <div class="container-fluid no-pad">
    <?php echo get_template_part( '/includes/template/featured-asktherapist' ); ?>
    <?php echo get_template_part( '/includes/template/featured-slider' ); ?>
  </div>

  <?php echo get_template_part( '/includes/template/tv-series' ); ?>

  <div class="container" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <section id="content-area">
      <div class="row">
        <div class="col-sm-8">
          <!-- tv-series -->
          <?php echo get_template_part( '/includes/template/video-courses-slider' ); ?>

          <hr>

          <!-- top articles -->
          <?php echo get_template_part( '/includes/template/top-articles' ); ?>

        </div>
        <div class="col-sm-4">
          <!-- sidebar widget -->
          <?php get_sidebar(); ?>
        </div>
      </div>
    </section>

  </div><!-- /container -->

<?php get_footer(); ?>
