<section id="top-articles">

	<!-- post query -->
    <?php $slider_query = new WP_Query(
      array
      (
        'orderby' => 'rand',
        'order' => 'DESC' ,
        'post_type' => array('videos', 'articles'), 
        'post_status' => 'publish',
        // 'category_name' => 'editor-picks',
        'featured' => 'yes',
        'posts_per_page' => 6
      )
    ); 
    ?>

	<div class="row">
		<div class="col-sm-12 section-header">
			<h1 class="text-center text-uppercase">Top Articles</h1>
		</div>
	</div>
	<div class="row">

	<?php

	    if ($slider_query->have_posts()) :

	      $counter = 0;

	      while($slider_query->have_posts()) : $slider_query->the_post(); ?>

	      	<?php 

      			echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 picks-item">
					<div class="picks-img">
						<a href="'.get_the_permalink().'" class="img-hover-link" >'
						.custom_link_overlay().''.get_the_post_thumbnail($post->ID,"full", array("class" => "img-responsive")).'
					</div></a>
					<div class="picks-desc text-center">
						<a href="'.get_the_permalink().'"><label class="text-center text-uppercase">'.get_the_title().'</label></a>
						<p class="text-center text-small text-date"><span>'.get_the_date().'</span></p>
					</div>
				</div>'; 

			?>

	      <?php endwhile; ?>
	      
	      <?php wp_reset_postdata(); 

	    else :
	      
	    	echo get_template_part( '/includes/template/page-not-found' ); 

	    endif;

    ?>

	</div>
</section>