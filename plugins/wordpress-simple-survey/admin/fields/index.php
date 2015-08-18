<?php defined('WPSS_PATH') or die();?>

<?php $quiz = new WPSS_Quiz((int) $_GET['id']);?>
<?php $util = new WPSS_Util();?>
<?php $fields = new WPSS_Field(array('quiz_id'=>$quiz->id));?>


<!-- Admin fields index -->
<div class="wrap wpss">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left"><?php echo $quiz->title;?> Fields</h2>
  <div class="clear"></div>
  <hr />

  <p class="wpss-breadcrumb">
    <a href="<?php echo $util->admin_url('','','');?>">Quizzes</a> &raquo; <a href="<?php echo $util->admin_url('quiz', 'edit', $quiz->id);?>"><?php echo $quiz->title;?></a> &raquo; <a class="current">Fields</a>
  </p>

  <p>Fields are simple user related questions asked before submitting the quiz like Name or Email Address.</p>

  <table class="widefat">
  <thead>
    <tr>
      <th>Field Name</th>
      <th>Edit</th>
      <th>Required</th>
      <th>Type</th>
      <th>Shortcode</th>
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
      <?php foreach($fields->fields as $field):?>
        <tr>
          <td><?php echo substr(strip_tags($field->name), 0, 50);?></td>
          <td><a href="<?php echo $util->admin_url('field', 'edit', $field->id);?>">Edit</a></td>
          <td>
            <code><?php echo ($field->required)? '*':'&nbsp;';?></code>
          </td>
          <td>
            <?php foreach( WPSS_Field::field_types() as $f): ?>
              <?php if( $f['value'] == $field->meta_type): ?>
                <?php echo $f['name']; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </td>
          <td>
            <code>[wp_ss_field_<?php echo $field->id?>]</code>
          </td>
          <td>
            <form method="post" action="<?php echo $util->admin_form_url('field','delete', $field->id);?>">
              <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
              <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />
              <input type="hidden" name="wpss[id]" value="<?php echo $field->id;?>" />
              <input class="button-secondary" type="submit" name="wpss[delete]" value="Delete" onclick="return confirm('Are you sure you want to delete this field? You will not be able to regenerate this field without upgrading to the extended version.')">
            </form>
          </td>
        </tr>
      <?php endforeach;?>
  </tbody>
  </table>
  <p>
    <span class="description">Upgrade to the extended version to add new custom fields.</span></br />
    <span class="description">Use the shortcodes to put the user's field answers in the auto-response email.
  </p>

  <div class="wpss-admin-nav">
    <p>
      <a class="button-primary" href="#" onclick="alert('You must upgrade to the extended version in order to use this feature.');">+ Add New Field</a>&nbsp;
      <a class="button" href="<?php echo $util->admin_url('','');?>">&lsaquo; back</a>&nbsp;
    </p>
  </div>



</div>
