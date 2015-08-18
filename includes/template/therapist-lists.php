<section id="therapist-list" class="therapist-list-container">

<?php $counter = 1; ?>

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

	<?php $feat_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>

 	<div class="col-sm-12 no-pad one-col-list">
 		<div class="col-sm-12 text-left question-title">
			<h2 class="text-left">Question: <?php echo get_the_excerpt(); ?></h2>
			<p>By <?php echo get_post_meta( get_the_ID(), 'name', true ); ?></p>
		</div>
		<div class="col-sm-12 text-left question-answer">
			<?php the_content();?>
		</div>
	</div>

<?php endwhile; else: ?>
<?php echo get_template_part( '/includes/template/page-not-found' ); ?>
<?php endif; ?>
<?php wp_reset_query(); ?>

<?php wp_pagenavi(); ?>


</section>

