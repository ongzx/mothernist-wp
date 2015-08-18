<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>
    
    <div class="container">
      <section id="content-area">
        <div class="row">
          <div class="col-sm-8">
            <!-- editor picks -->
            <?php echo get_template_part( '/includes/template/category-lists' ); ?>
          </div>
          <div class="col-sm-4">
            <!-- sidebar widget -->
            <?php get_sidebar(); ?> 
          </div>
        </div>
      </section>
    </div>

  </div>

  <!-- /container -->

<?php get_footer(); ?>