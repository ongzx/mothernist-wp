<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>
    
    <div class="container">
      <section id="contributor-section">
        <div class="row">
          <div class="col-sm-12 featured-contributor">
            <!-- featured contributor -->
            <?php $query_tag =  types_render_field("tag", array("output"=>"raw")); ?>
            <?php echo get_template_part( '/includes/template/featured-contributor' ); ?>
          </div>
        </div>

        <!-- CONTRIBUTED POST BY CONTRIBUTOR -->
        <?php echo get_template_part('/includes/template/contributed-post'); ?>

        <div class="row">
          <div class="col-sm-12">
            <h1 class="text-uppercase">Contributors</h1>
          </div>
        </div>

        <!-- DO QUERY FOR LIST OF CONTRIBUTORS -->
        <div class="row contributor-list">
          <?php 
            $contributor_query = new WP_Query(
              array
              (
                'post_type' => array('contributors'), 
                'post_status' => 'publish',
                'posts_per_page' => -1
              )
            ); 
          ?>
          <?php if ($contributor_query->have_posts()) : while ($contributor_query->have_posts()) : $contributor_query->the_post(); ?>
          <?php echo get_template_part('/includes/template/contributor-list'); ?>
          <?php endwhile; else: ?>
          <?php echo get_template_part( '/includes/template/page-not-found' ); ?>
          <?php endif; ?>
        </div>

      </section>
    </div>

  </div>

  <!-- /container -->

<?php get_footer(); ?>