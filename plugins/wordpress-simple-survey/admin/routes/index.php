<?php defined('WPSS_PATH') or die();?>

<?php $quiz = new WPSS_Quiz((int) $_GET['id']);?>
<?php $util = new WPSS_Util();?>
<?php $routes = new WPSS_Route(array('quiz_id'=>$quiz->id));?>


<!-- Admin routes index -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?> Routes</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a class="current">Routes</a>
  </p>

  <p>Routes link quiz taker scoring ranges to landing pages.</p>

  <table class="widefat">
    <thead>
      <tr>
        <th>Route Name</th>
        <th>Edit</th>
        <th>From</th>
        <th>To</th>
        <th>URL</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach($routes->routes as $route):?>
        <tr>
          <td><?php echo substr(strip_tags($route->name), 0, 50);?></td>
          <td><a href="<?php echo $util->admin_url('route', 'edit', $route->id);?>">Edit</a></td>
          <td><?php echo $route->from_score;?></td>
          <td><?php echo $route->to_score;?></td>
          <td><?php echo $route->url;?></td>
          <td>
            <form method="post" action="<?php echo $util->admin_form_url('route','delete', $route->id);?>">
              <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
              <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />
              <input type="hidden" name="wpss[id]" value="<?php echo $route->id;?>" />
              <input class="button-secondary" type="submit" name="wpss[delete]" value="Delete" onclick="return confirm('Are you sure you want to delete this route?')">
            </form>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>
  </table>

  
  <p class="description">
    Upgrade to the extended version to show the user their exact score and their results on their landing page using the shortcodes.
  </p>

  <div class="wpss-admin-nav">
    <p>
      <a class="button-primary" href="<?php echo $util->admin_url('route','new',$quiz->id);?>">+ Add New Route</a>&nbsp;
      <a class="button" href="<?php echo $util->admin_url('','');?>">&lsaquo; back</a>&nbsp;
      <span class="description right">Add new route for this quiz.</span>
    </p>
  </div>



</div>
