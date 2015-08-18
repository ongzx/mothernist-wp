  <!-- Form for Edit and New Route -->
  <?php $action = ($route->new)? $util->admin_form_url('route', 'new', $quiz->id) : $_SERVER['REQUEST_URI'];?>
  <form method="post" action="<?php echo $action;?>">

    <!-- Route Form -->
    <div id="icon-tools" class="icon32"></div><h2>Route</h2>
    <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[name]">Route Name</label></th>
          <td>
            <input name="wpss[name]" type="text" value="<?php echo $route->name;?>" class="medium-text" required="required">
            <span class="description">Name for route like 'Passing' or 'Failing'.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[from_score]">From Score</label></th>
          <td>
            <input name="wpss[from_score]" type="number" value="<?php echo $route->from_score;?>" class="small-text" required="required">
            <span class="description">Lower bound on range (inclusive).</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[to_score]">To Score</label></th>
          <td>
            <input name="wpss[to_score]" type="number" value="<?php echo $route->to_score;?>" class="small-text" required="required">
            <span class="description">Upper bound on range (inclusive).</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[url]">URL</label></th>
          <td>
            <input name="wpss[url]" type="text" value="<?php echo $route->url;?>" class="regular-text" required="required">
            <br />
            <span class="description">Users scoring in this range are taken to this URL, example: <?php echo get_bloginfo('url');?>/results.</span>
          </td>
        </tr>
  
      </tbody>
    </table>

    <?php if($route->new):?>
      <input type="hidden" name="wpss_crud[route]" value="new" />
    <?php else:?>
      <input type="hidden" name="wpss[id]" value="<?php echo $route->id;?>" />
    <?php endif;?>
    <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />

    <div class="wpss-admin-nav">
      <p>
        <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
        <?php $button = ($route->new)? 'Create Route' : 'Update Route';?>
        <input class="button-primary" class="left" type="submit" name="save_route" value="<?php echo $button;?>" />&nbsp;
        <a class="button" href="<?php echo $util->admin_url('quiz', 'routes_index', $quiz->id);?>">&lsaquo; back</a>&nbsp;
      </p>
    </div>

  </form> 


