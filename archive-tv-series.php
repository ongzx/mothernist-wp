<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>

    <div class="container">
      <section id="content-area">

        <div class="row featured-tv-series">
          <?php echo get_template_part('/includes/template/featured-tv-series'); ?>
        </div>

        <?php echo get_template_part('/includes/template/tv-series-list'); ?>
      </section>
    </div>

  </div>

  <!-- /container -->

<?php get_footer(); ?>