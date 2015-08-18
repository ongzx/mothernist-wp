<div class="container">
  <div class="row">
    <div class="col-sm-12 breadcrumbs-section">
      <?php if(is_category()) { ?>
        <h4>Browsing Category </h4>
        <h2 class="text-uppercase"><?php single_cat_title( '', true ); ?></h2>
      <?php } else if (is_archive()) { ?>
        <h4>Browsing Category </h4>
        <h2 class="text-uppercase">
          <?php 
            $obj = get_post_type_object( get_post_type( get_the_ID()  )) ;
            echo $obj->labels->singular_name;
          ?>
        </h2>
      <?php } else { ?>
        <h4>Currently Browsing </h4>
        <div class="breadcrumbs text-left text-uppercase" xmlns:v="http://rdf.data-vocabulary.org/#">
          <?php if(function_exists('bcn_display'))
          {
              bcn_display();
          }?>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<hr>