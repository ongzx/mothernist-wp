/***** Getting list of Instagram Feed ********/
var userFeed = new Instafeed({
    get: 'user',
    userId: 1365498628,
    accessToken: '1365498628.467ede5.3ecfc7d8689e4b3f878d19c24c60bbc0',
    // limit: 30,
    // template: '<div><a class="animation" href="{{link}}"><img src="{{image}}" /></a></div>',
    after: function()
    {
    	// jQuery('#loading').hide();
        jQuery('.instafeed').slick({
            dots: false,
            arrows: false,
            infinite: true,
            variableWidth: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 2000,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            easing: 'easeInOut'
        });
    }
});
userFeed.run();
