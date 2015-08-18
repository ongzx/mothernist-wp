jQuery(document).ready(function($){
	
	$('.quick-preview a').on('click', function(e) {
		e.preventDefault();

		$(this).toggleClass('expanded');
		$( $(this).attr('href') ).toggleClass('expanded');
	});
	
});