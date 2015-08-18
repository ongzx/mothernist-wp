<?php get_header(); ?>
  
  <div class="container-fluid no-pad" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <?php echo get_template_part( '/includes/template/breadcrumbs' ); ?>
    
    <div class="container">
      <section id="contributor-section">
        <div class="row">
          <div class="col-sm-12 featured-contributor">
            <!-- featured contributor -->
            <?php 
              $featured_query = new WP_Query(
                array
                (
                  'post_type' => array('contributors'), 
                  'post_status' => 'publish',
                  'featured' => 'yes',
                  'posts_per_page' => 1
                )
              ); 

              if ($featured_query->have_posts()) :

              while($featured_query->have_posts()) : $featured_query->the_post();

              $query_tag =  types_render_field("tag", array("output"=>"raw")); 

            ?>


              <?php echo get_template_part( '/includes/template/featured-contributor' ); ?>

              <?php endwhile; ?>
              <?php wp_reset_postdata(); 

              else :
                echo get_template_part( '/includes/template/page-not-found' ); 
              endif;
            ?>
          </div>
        </div>

        <!-- CONTRIBUTED BY CONTRIBUTORS -->
        <?php echo get_template_part('/includes/template/contributed-post'); ?>


        <!-- LIST OF CONTRIBUTORS -->
        <div class="row">
          <div class="col-sm-12">
            <h1 class="text-uppercase">Contributors</h1>
          </div>
        </div>
        

        <div class="row contributor-list">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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