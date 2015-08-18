<?php defined('WPSS_PATH') or die();?>

<?php $util = new WPSS_Util();?>
<?php $question = new WPSS_Question((int) $_GET['id']);?>
<?php $quiz = new WPSS_Quiz($question->quiz_id);?>
<?php $answer = new WPSS_Answer('new');?>

<!-- Admin answers#new -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?>, New Answer</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'questions_index', $quiz->id);?>">Questions</a> &raquo; <a href="<?php echo $util->admin_url('question', 'edit', $question->id);?>">Question</a> &raquo; <a class="current">New Answer</a>
  </p>

  <?php include( WPSS_PATH . "admin/answers/_form.php");?>

</div>
