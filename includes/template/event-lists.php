<section id="event-list" class="event-list-container">

<?php $counter = 1; ?>

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<?php $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>

 	<div class="two-col-list">

 		<?php if ($counter%2 == 0) {//even number?>
 			<div class="col-sm-6 col-xs-12 text-center event-detail">
				<h3 class="text-center text-uppercase"><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<a class="default-link-black text-uppercase">Event Over</a>
			</div>
			<div class="col-sm-6 col-xs-12 single-image no-pad " style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">
	
			</div>
 		<?php } else { ?>
 			<div class="col-sm-6 col-xs-12 single-image no-pad" style="background:url(<?php echo $feat_img['0']; ?>) no-repeat; background-size:cover; background-position:center center;">
			
			</div>
			<div class="col-sm-6 col-xs-12 text-center event-detail">
				<h3 class="text-center text-uppercase"><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<a class="default-link-black text-uppercase">Event Over</a>
			</div>
 		<?php } 
 			$counter++;
 		?>
	</div>

<?php endwhile; else: ?>
<?php echo get_template_part( '/includes/template/page-not-found' ); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php wp_pagenavi(); ?>


</section>

