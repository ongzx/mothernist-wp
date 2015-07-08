<?php get_header(); ?>
  
  <div class="container-fluid no-pad">
    <?php echo get_template_part( '/includes/template/featured-slider' ); ?>
  </div>

  <div class="container" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <?php echo get_template_part( '/includes/template/promo-area' ); ?>

    <section id="content-area">
      <div class="row">
        <div class="col-sm-8">
          <!-- editor picks -->
          <?php echo get_template_part( '/includes/template/editor-picks' ); ?>
        </div>
        <div class="col-sm-4">
          <!-- sidebar widget -->
          <?php get_sidebar(); ?> 
        </div>
      </div>
    </section>

  </div><!-- /container -->

<?php get_footer(); ?>