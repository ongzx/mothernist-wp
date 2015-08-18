<!-- 
  query and get top 3 category 
  only require category title, category permalink, background image
-->

<?php 
  $args = array(
    'type'                     => 'post',
    'child_of'                 => 0,
    'parent'                   => '',
    'orderby'                  => 'name',
    'order'                    => 'ASC',
    'hide_empty'               => 1,
    'hierarchical'             => 1,
    'exclude'                  => '',
    'include'                  => '',
    'number'                   => '3',
    // 'taxonomy'                 => 'category',
    'pad_counts'               => false 

  ); 

  $featured_categories = get_categories( $args ); 

?> 

<section id="promo-area" class="site-section">
  <div class="row">

  <?php 
    foreach($featured_categories as $category) { 


      echo '<div class="col-sm-4">';
      echo '<div class="promo-item" >';
      echo '<a href="'.get_category_link( $category->term_id ).'" class="promo-link" ></a>';
      echo '<div class="promo-overlay" >';
      echo '<label>'.$category->name .'</label>';
      echo '</div></div></div>';
      
      // echo '<p>Category: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </p> ';
      // echo '<p> Description:'. $category->description . '</p>';
      // echo '<p> Post Count: '. $category->count . '</p>';  
    } 

  ?>

    <!-- <div class="col-sm-4">
      <div class="promo-item" >
        <a href="http://solopine.com/redwood/about-me/" class="promo-link" ></a>
        <div class="promo-overlay" >
            <label>About Me</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="promo-item" >
        <a href="http://solopine.com/redwood/about-me/" class="promo-link" ></a>
        <div class="promo-overlay" >
            <label>About Me</label>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="promo-item">
        <a href="http://solopine.com/redwood/about-me/" class="promo-link" ></a>
        <div class="promo-overlay" >
            <label>About Me</label>
        </div>
      </div>
    </div> -->
  </div>
</section>