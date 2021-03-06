<?php defined('WPSS_PATH') or die();?>

<?php $util = new WPSS_Util();?>
<?php $route = new WPSS_Route((int) $_GET['id']);?>
<?php $quiz = new WPSS_Quiz($route->quiz_id);?>

<!-- Admin routes#new -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?>, Editing Route <?php echo $route->name;?></h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'routes_index', $quiz->id);?>">Routes</a> &raquo; <a class="current">Edit</a>
  </p>

  <?php include( WPSS_PATH . "admin/routes/_form.php" );?>

</div>
