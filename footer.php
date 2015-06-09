<?php global $mothernist_config; ?>

<hr>
	<footer>
		<div class="row-fluid">
			<div class="col-sm-6">
				<?php echo $mothernist_config['opt-footer-left']; ?>
			</div>
			<div class="col-sm-6">
				<?php echo stripslashes($mothernist_config['opt-footer-right']); ?>
			</div>
		</div>
	
	</footer>
    
    <?php wp_footer(); ?>
    
  </body>
</html>