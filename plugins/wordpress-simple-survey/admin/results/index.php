<?php defined('WPSS_PATH') or die();?>

<?php $quiz = new WPSS_Quiz((int) $_GET['id']); ?>
<?php $util = new WPSS_Util(); ?>

<?php $page = empty($_GET['wpss_results_page']) ? 1 : (int) $_GET['wpss_results_page']; ?>
<?php $offset = ($page - 1) * WPSS_Result::PAGED; ?>
<?php $results = WPSS_Result::where( array( 'quiz_id' => $quiz->id), $offset ); ?>

<!-- Admin question index -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?> Results</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a class="current">Results</a>
  </p>

  <table class="widefat">
    <thead>
      <tr>
        <th>id</th>
        <th>View</th>
        <th>Fields</th>
        <th>Score</th>
        <th>Route</th>
        <th>IP Address</th>
        <th>Submitted At</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>id</th>
        <th>View</th>
        <th>Fields</th>
        <th>Score</th>
        <th>Route</th>
        <th>IP Address</th>
        <th>Submitted At</th>
        <th>Delete</th>
      </tr>
    </tfoot>
    <tbody>
      <?php foreach( $results as $n => $result ): ?>
          <tr>
            <td>
              <?php echo $result->id;?>
            </td>
            <td>
              <strong>
                <a class="row-title" href="<?php echo $util->admin_url('result', 'show', $result->id);?>">Show</a>
              </strong>
            </td>
            <td>
              <?php echo WPSS_Result::custom_field_values_preview( $result->data['field_results'] ); ?>
            </td>
            <td>
              <?php echo $result->score;?>
            </td>
            <td>
              <?php if( !empty($result->data['route_results']) && !empty($result->data['route_results']['name']) ): ?>
                <?php echo $result->data['route_results']['name']; ?>
              <?php endif;?>
            </td>
            <td>
              <?php echo $result->ip_address;?>
            </td>
            <td>
              <?php echo $result->submitted_at;?>
            </td>
            <td>
              <form method="post" action="<?php echo WPSS_DELETE_RESULT.$result->id;?>">
                <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
                <input type="hidden" name="wpss[result_id]" value="<?php echo $result->id;?>" />
                <input class="button-secondary" type="submit" name="wpss[delete]" value="Delete" onclick="return confirm('Are you sure you want to delete this result?')">
              </form>
            </td>
          </tr>
      <?php endforeach;?>
    </tbody>
  </table>



  <!-- Pagination -->
  <div class="tablenav bottom">
  
    <div class="alignleft actions bulkactions">
      <a class="button-primary" href="#" onclick="alert('Upgrade to the extended version to use this feature.')">Export all results for this quiz</a>&nbsp;
      <a class="button" href="<?php echo $util->admin_url('','');?>">&lsaquo; back</a>&nbsp;
    </div>
  
    <div class="alignleft actions"></div>
  
    <div class="tablenav-pages">
      <span class="displaying-num"><?php echo WPSS_Result::count( $quiz->id );?> items</span>
      <span class="pagination-links">
        <a class="first-page <?php echo $page == 1 ? 'disabled' : '';?>" href="<?php echo $util->admin_url('quiz', 'results_index', $quiz->id);?>">&laquo;</a>
        <a class="prev-page <?php echo $page == 1 ? 'disabled' : '';?>" href="<?php echo $util->admin_url('quiz', 'results_index', $quiz->id);?>&wpss_results_page=<?php echo $page - 1;?>">&lsaquo;</a>

        <span class="paging-input"><?php echo $page;?> of <span class="total-pages"><?php echo WPSS_Result::pages($quiz->id);?></span></span>
  
        <a class="next-page <?php echo $page == WPSS_Result::pages($quiz->id) ? 'disabled' : '';?>" href="<?php echo $util->admin_url('quiz', 'results_index', $quiz->id);?>&wpss_results_page=<?php echo $page + 1;?>">&rsaquo;</a>
        <a class="last-page <?php echo $page == WPSS_Result::pages($quiz->id) ? 'disabled' : '';?>" href="<?php echo $util->admin_url('quiz', 'results_index', $quiz->id);?>&wpss_results_page=<?php echo WPSS_Result::pages($quiz->id);?>">&raquo;</a>
      </span>
    </div>
    <br class="clear">
  </div>

</div>
