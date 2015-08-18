<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>

    <div class="container">
      <section id="content-area">
        <div class="row">
          
          <div class="col-sm-8">
            <div class="row event-ads">
              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("event-header") ) : ?>
              <?php endif; ?>
            </div>
            <!-- events listing -->
            <?php echo get_template_part( '/includes/template/event-lists' ); ?>
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