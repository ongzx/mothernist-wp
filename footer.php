<?php global $mothernist_config; ?>

<div class="container-fluid no-pad" style="overflow:hidden;">
	<h1 class="text-center text-uppercase">Follow Us on Instagram @Mothernist</h1>
	<?php 
		if (function_exists('instaslick_display')) {
		    echo instaslick_display();
		}
	?>
</div>

<footer>
	<div class="container-fluid footer-menu">
		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-3 col-xs-12 text-left footer-logo">
					<a href="<?php echo get_home_url(); ?>">
			          <img id="footer-logo" src="<?php echo get_theme_logo_footer(); ?>">
			        </a>
				</div>
				<div class="col-md-6 col-sm-5 col-xs-12 no-pad footer-menu-col">
			        <?php 
			        	wp_nav_menu( 
			        		array(
				                'menu' => 'footer-menu',
				                'depth' => 1,
				                'container' => false,
				                'menu_class' => 'footer-nav',
				                'walker' => new wp_bootstrap_navwalker()
		                	)
	              		); 
	              	?>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 text-right footer-social">
					<?php echo get_social_link(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid footer-copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 text-center">
					<label class="text-white"><?php echo get_footer_copyright(); ?></label>
				</div>
			</div>
		</div>
	</div>
	
</footer>

<?php wp_footer(); ?>
    
</body>
</html>