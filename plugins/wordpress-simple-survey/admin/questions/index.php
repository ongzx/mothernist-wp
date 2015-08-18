<?php defined('WPSS_PATH') or die();?>

<?php $quiz = new WPSS_Quiz((int) $_GET['id']);?>
<?php $util = new WPSS_Util();?>
<?php $question_util = new WPSS_Question();?>


<!-- Admin question index -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?> Questions</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a class="current">Questions</a>
  </p>

  <table class="widefat">
  <thead>
    <tr>
      <th>Question</th>
      <th>Edit</th>
      <th>Type</th>
      <th>Order</th>
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
    </tr>
  </tfoot>
    <tbody>
      <?php foreach($quiz->questions->questions as $question):?>
        <tr>
          <td>
            <?php echo wpss_text_preview( $question['question']->question, 50 );?>
          </td>
          <td>
            <?php if(!$quiz->new):?>
              <a href="<?php echo $util->admin_url('question', 'edit', $question['question']->id);?>">Edit</a>
            <?php endif;?>
          </td>
          <td>
            <?php if(!$quiz->new):?>
              <?php echo ucwords($question_util->get_safe_type($question['question']->type));?>
            <?php endif;?>
          </td>
          <td>
            <?php if(!$quiz->new):?>
              <?php echo $question['question']->display_order;?>
            <?php endif;?>
          </td>
          <td>
            <?php if(!$quiz->new):?>
                <form method="post" action="<?php echo WPSS_DELETE_QUESTION.$question['question']->id;?>">
                  <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
                  <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />
                  <input type="hidden" name="wpss[id]" value="<?php echo $question['question']->id;?>" />
                  <input class="button-secondary" type="submit" name="wpss[delete]" value="Delete" onclick="return confirm('Are you sure you want to delete this question?')">
                </form>
            <?php endif;?>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>
  </table>




  <div class="wpss-admin-nav">
    <p>
      <a class="button-primary" href="<?php echo $util->admin_url('question','new',$quiz->id);?>">+ Add New Question</a>&nbsp;
      <a class="button" href="<?php echo $util->admin_url('','');?>">&lsaquo; back</a>&nbsp;
      <span class="description right">Questions associated with the quiz.</span>

    </p>
  </div>



</div>
