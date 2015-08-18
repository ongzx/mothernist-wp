<?php defined('WPSS_PATH') or die();?>

<?php $util = new WPSS_Util();?>
<?php $result = WPSS_Result::find( (int) $_GET['id'] ); ?>

<!-- Result Show -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left">Result: <?php echo $result->id;?></h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url( 'quiz', 'results_index', $result->quiz->id );?>">Results</a> &raquo; 
    <a class="current" href="">Result <?php echo $result->id;?></a>
  </p>


  <h2>Submission</h2>
  <table class="form-table">
    <tbody>
  
      <tr valign="top">
        <th scope="row">Quiz</th>
        <td><?php echo $result->quiz->title;?></td>
      </tr>
  
      <tr>
        <th scope="row">Score</th>
        <td><?php echo $result->score;?></td>
      </tr>

      <tr>
        <th scope="row">Started</th>
        <td><?php echo $result->started_at;?></td>
      </tr>

      <tr>
        <th scope="row">Submitted</th>
        <td><?php echo $result->submitted_at;?></td>
      </tr>

      <tr>
        <th scope="row">Route</th>
        <td><?php echo $result->data['route_results']['name'];?></td>
      </tr>

      <tr>
        <th scope="row">Routed To</th>
        <td><?php echo $result->data['route_results']['url'];?></td>
      </tr>

      <?php if( !empty($result->data['meta']['has_wp_user']) && $result->data['meta']['has_wp_user'] == true  ): ?>
        <tr>
          <th scope="row">WP Username</th>
          <td><?php echo $result->data['meta']['wp_user_login'];?></td>
        </tr>

        <tr>
          <th scope="row">WP First Name</th>
          <td><?php echo $result->data['meta']['wp_first_name'];?></td>
        </tr>

        <tr>
          <th scope="row">WP Last Name</th>
          <td><?php echo $result->data['meta']['wp_last_name'];?></td>
        </tr>

        <tr>
          <th scope="row">WP Roles</th>
          <td><?php echo $result->data['meta']['wp_roles'];?></td>
        </tr>

        <tr>
          <th scope="row">WP Email</th>
          <td><?php echo $result->data['meta']['wp_user_email'];?></td>
        </tr>

        <tr>
          <th scope="row">WP User ID</th>
          <td><?php echo $result->data['meta']['wp_user_id'];?></td>
        </tr>
      <?php endif; ?>

    </tbody>
  </table>
  <hr />

  <h2>Fields</h2>
  <table class="form-table">
    <tbody>
  
      <?php foreach( $result->data['field_results'] as $field ): ?>
        <tr valign="top">
          <th scope="row"><?php echo $field['field_text']; ?></th>
          <td><?php echo sanitize_text_field( $field['answer'] );?></td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
  <hr />


  <h2>Answers</h2>
  <table class="form-table">
    <tbody>
  
      <?php foreach( $result->data['full_results'] as $i => $answer ): ?>
        <tr valign="top">
          <th scope="row">Question #<?php echo $i+1;?>:</th>
          <td>
            <?php echo wpss_text_preview( $answer['question_text'], 100 ); ?><br />
            <?php echo wpss_text_preview( $answer['answer']['answer_text'], 100 ); ?><br />
            Score: <?php echo empty($answer['answer']['score']) ? '' : $answer['answer']['score'] ; ?>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
  <hr />


  <form method="post" action="<?php echo WPSS_DELETE_RESULT.$result->id;?>">
    <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
    <input type="hidden" name="wpss[result_id]" value="<?php echo $result->id;?>" />

    <p>
      <a class="button" href="<?php echo $util->admin_url( 'quiz', 'results_index', $result->quiz->id );?>">‹ Back</a>
      <input class="button-secondary" type="submit" name="wpss[delete]" value="Delete" onclick="return confirm('Are you sure you want to delete this result?')">
    </p>
  </form>


  <?php if( 1 == 2 ): ?>
    <pre>
      <?php var_dump($result); ?>
    </pre>
  <?php endif; ?>

</div>
