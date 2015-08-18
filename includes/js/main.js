jQuery(document).ready(function(){


//Handle fixed position navbar
jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() > 180 && jQuery(window).width() > 800) {
       jQuery('nav').addClass('docked');
    }else
    if (jQuery(window).scrollTop() <= 0) {
      jQuery('nav').removeClass('docked');
    }
})


// Handle tv-series archive video
jQuery('.tv-list-slide a').click(function(evt){
    evt.preventDefault();

    jQuery('html,body').animate({
      scrollTop: jQuery(".featured-tv-series").offset().top
    }, 500);

    jQuery('.featured-tv-series').slick('unslick');
    jQuery('.featured-video').remove();

    var video = jQuery(this).attr("data-url");
    var poster = jQuery(this).attr("data-poster");
    var category = jQuery(this).attr("data-category");
    var title = jQuery(this).attr("data-title");

    var html = '<div class="featured-video" style="background:url('+poster+') no-repeat; background-size:cover; background-position:center center;">';
    html += '<div class="play-btn" ><i class="fa fa-play fa-5x"></i></div>';
    html += '<h1 class="tv-category text-center text-uppercase">'+category+'</h1>';
    html += '<h2 class="tv-title text-center">'+title+'</h2>';
    html += '<input type="hidden" id="videoUrl" value="'+video+'"><input type="hidden" id="videoPoster" value="'+poster+'">';
    html += '</div>';

    jQuery('.featured-tv-series').append(html);

});



/***** Handle video play on single page ********/

jQuery('.single-video .play-btn, .featured-video .play-btn, .course-video .play-btn').on('click',function(evt) {

    evt.preventDefault();

    var videoUrl = ""; 
    var videoPoster = "";
    videoUrl = jQuery(this).parent().find('#videoUrl').val();
    videoPoster = jQuery(this).parent().find('#videoPoster').val();

    init_hiro_player(videoUrl, videoPoster, jQuery(this).parent());

    jQuery(this).css('opacity', 1);
    jQuery(this).find('i').removeClass();
    jQuery(this).find('i').addClass('fa fa-spinner fa-spin fa-5x');
    
});

jQuery(document).on('click', '.featured-video .play-btn', function(evt) {

    evt.preventDefault();
    var videoUrl = ""; 
    var videoPoster = "";
    videoUrl = jQuery(this).parent().find('#videoUrl').val();
    videoPoster = jQuery(this).parent().find('#videoPoster').val();

    init_hiro_player(videoUrl, videoPoster, jQuery(this).parent());

    jQuery(this).css('opacity', 1);
    jQuery(this).find('i').removeClass();
    jQuery(this).find('i').addClass('fa fa-spinner fa-spin fa-5x');

});


jQuery(document).on("hiro_started", function (evt) {
    jQuery('.single-video .play-btn, .featured-video .play-btn').remove();
});

});