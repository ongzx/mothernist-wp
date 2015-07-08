<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo get_theme_title();?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Mothernist">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style type="text/css">
      #mc_embed_signup{
        background:#fff; 
        clear:left; 
        font:14px Helvetica,Arial,sans-serif; 
      }
    </style>
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

  <!-- start of Facebook SDK -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=219938928043354";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <!-- end of Facebook SDK -->


    <header id="header" itemscope itemtype="http://schema.org/WPHeader">

      <section class="row-fluid cover-image" style="text-align:center; padding-top:30px; padding-bottom:30px;">
        <img id="logo" src="<?php echo get_theme_logo(); ?>">
      </section>

      <nav class="navbar navbar-default navbar-static-top" itemscope itemtype="http://schema.org/SiteNavigationElement">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand visible-xs" href="<?php echo home_url(); ?>">
              <img id="logo" src="<?php echo get_theme_logo(); ?>">
            </a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <?php
              wp_nav_menu( array(
                'menu' => 'top_menu',
                'depth' => 2,
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'walker' => new wp_bootstrap_navwalker())
              );
            ?>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
    </header>