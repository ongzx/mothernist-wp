<?php defined('WPSS_PATH') or die();?>

<!-- Admin quiz index -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left">Setup Surveys and Quizzes</h2>
  <div class="clear"></div>
  <hr />

  <?php $quizzes = new WPSS_Quiz();?>
  <?php $util = new WPSS_Util();?>

  <p><strong>Welcome to the new WordPress Simple Survey!</strong> It has been a while since we last updated and you will want to read through all the <a href="http://wordpress.org/plugins/wordpress-simple-survey/" target="_blank">documentation</a> and WPSS admin help page.</p>
  <p>If you have mistakenly upgraded to the new branch and would like to revert to the old and keep using your old quizzes, you have not lost any of your data, you will just need to re-upload to older WPSS files over the new. Read through the documentation for links to the old files.</p>

  <table class="widefat">
  <thead>
    <tr>
      <th>Name</th>
      <th>Options</th>
      <th>Shortcode</th>
      <th>Questions</th>
      <th>Routes</th>
      <th>Fields</th>
      <th>Results</th>
      <!--
      <th>Print</th>
      -->
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
      <th></th>
      <!--
      <th></th>
      -->
    </tr>
  </tfoot>
  <tbody>
    <?php foreach($quizzes->quizzes as $quiz): ?>
      <tr>
        <td><strong><?php echo $quiz->title;?></strong></td>
        <td><a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>">Edit</a></td>
        <td>
          <code>[wp_simple_survey id="<?php echo $quiz->id;?>"]</code>
        </td>
        <td><a href="<?php echo $util->admin_url('quiz', 'questions_index', $quiz->id);?>">Edit</a></td>
        <td><a href="<?php echo $util->admin_url('quiz', 'routes_index', $quiz->id);?>">Edit</a></td>
        <td><a href="<?php echo $util->admin_url('quiz', 'fields_index', $quiz->id);?>">Edit</a></td>
        <td>
          <a href="<?php echo $util->admin_url('quiz', 'results_index', $quiz->id);?>">Show (<?php echo WPSS_Result::count( $quiz->id )?>)</a>
        </td>
        <!--
        <td><a href="<?php echo site_url().'/?wpss-routing=print&quiz_id='.$quiz->id;?>" target="_blank">Print</a></td>
        -->
      </tr>
    <?php endforeach;?>
  </tbody>
  </table>

  <p>Don't see a feature you need? Check out the <a target='_blank' href="http://labs.saidigital.co/products/wordpress-simple-survey/wordpress-simple-survey-extended-version/">WordPress Simple Survey Extended version</a> and keep the <a target="_blank" href="https://sailabs.zendesk.com/hc/en-us/categories/200014674-WordPress-Simple-Survey">feature requests</a> coming!</p>

  <div class="wpss-admin-nav">
    <p>
      <a class="button-primary" href="#" onclick="alert('You must upgrade to the extended version in order to use this feature.');">+ Create New</a>&nbsp;
    </p>
  </div>


</div>
