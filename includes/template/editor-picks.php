<section id="editor-picks">

	<!-- post query -->
    <?php $slider_query = new WP_Query(
      array
      (
        'orderby' => 'rand',
        'order' => 'DESC' ,
        'post_type' => array('videos', 'articles'), 
        'post_status' => 'publish',
        'category_name' => 'editor-picks',
        'posts_per_page' => 5
      )
    ); 
    ?>

	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center text-uppercase">Editor Picks</h1>
		</div>
	</div>
	<div class="row">

	<?php

	    if ($slider_query->have_posts()) :

	      $counter = 0;

	      while($slider_query->have_posts()) : $slider_query->the_post(); ?>

	      	<?php 

	      		if ($counter == 0)
	      		{
	      			echo '<div class="col-sm-12">
	      				<div class="picks-img">
							<div class="overlay img-responsive"></div>
							'.get_the_post_thumbnail($post->ID,"full", array("class" => "img-responsive")).'
						</div>
						<div class="picks-desc text-left">
							<label><a href="'.get_the_permalink().'">'.get_the_title().'</a></label>
							<p>'.get_the_excerpt().'</p>
						</div></div>';
	      		}
	      		else 
	      		{
	      			echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 picks-item">
						<div class="picks-img">
							<div class="overlay img-responsive"></div>
							'.get_the_post_thumbnail($post->ID,"full", array("class" => "img-responsive")).'
						</div>
						<div class="picks-desc text-left">
							<label><a href="'.get_the_permalink().'">'.get_the_title().'</a></label>
							<p>'.get_the_excerpt().'</p>
						</div>
					</div>'; 
	      		}
	      		$counter++;
			?>

	      <?php endwhile; ?>
	      
	      <?php wp_reset_postdata(); 

	    else :
	      
	      echo '<p>Something must have been wrong!</p>';

	    endif;

    ?>

	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<button class="btn btn-lg general-btn text-center text-uppercase" >View more</button>
		</div>
	</div>
</section>