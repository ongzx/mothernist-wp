<?php defined('WPSS_PATH') or die();?>

<?php $util = new WPSS_Util();?>
<?php $field = new WPSS_Field((int) $_GET['id']);?>
<?php $quiz = new WPSS_Quiz($field->quiz_id);?>

<!-- Admin fields#edit -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?>, Editing Field</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'fields_index', $quiz->id);?>">Fields</a> &raquo; <a class="current">Edit</a>
  </p>

  <?php include( WPSS_PATH . "admin/fields/_form.php" );?>

</div>
