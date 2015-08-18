<section id="content-list" class="content-list-container">

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>
 	<div class="row content-list">
		<div class="col-sm-12">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><h2 class="text-center text-uppercase"><?php the_title(); ?></h2></a>
		</div>
		<div class="col-sm-12 text-center ">
			<div class="single-image">
		      	<?php 
			      echo '<a class="img-hover-link" href="'. get_the_permalink().'">';
			      echo custom_link_overlay();
			      if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			        the_post_thumbnail(array(1024, 512), array('class' => 'img-responsive'));
			      } 
			      echo '</a>';
	      		?>
	      	</div>
	    </div>
	    <div class="col-sm-12 content-list-desc">
	    	<?php the_excerpt(); ?>
	    </div>
	    <div class="col-sm-12 text-center content-list-cta">
	    	<a href="<?php the_permalink() ?>" class="default-link-border">Continue Reading</a>
	    </div>
	</div>


<?php endwhile; else: ?>
<?php echo get_template_part( '/includes/template/page-not-found' ); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php wp_pagenavi(); ?>


</section>

