  <!-- Form for Edit and New Field -->
  <?php $action = ($field->new)? $util->admin_form_url('field', 'new', $quiz->id) : $_SERVER['REQUEST_URI'];?>
  <form method="post" action="<?php echo $action;?>">

    <!-- Field Form -->
    <div id="icon-tools" class="icon32"></div><h2>Field</h2>
    <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[name]">Field Name</label></th>
          <td>
            <input name="wpss[name]" type="text" value="<?php echo $field->name;?>" class="medium-text" required="required"><br />
            <span class="description">Label for field, example: Email, First Name, Special Code.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[required]">Required?</label></th>
          <td>
            <input name="wpss[required]" type="hidden" value="0">
            <label>
              <input name="wpss[required]" type="checkbox" value="1" <?php echo $field->required == 1 ? "checked":"";?>>
              <span class="description">Input required to submit quiz.</span>
            </label>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[meta_type]">Type?</label></th>
          <td>
            <select name="wpss[meta_type]">
              <?php foreach(WPSS_Field::field_types() as $type): ?>
                <option value="<?php echo $type['value']?>" <?php echo ($type['value'] == $field->meta_type)? 'selected':'' ?> required="required">
                  <?php echo $type['name'];?>
                </option>
              <?php endforeach; ?>
            </select>

            <span class="description">
              Input field type. <br />
              "Email Address (Quiz Taker)" can be used when needing to send the end user their quiz results.
              <br />
              Upgrade to the extended version to add drop-down boxes and textareas.
            </span>
          </td>
        </tr>
  
  
      </tbody>
    </table>

    <?php if($field->new):?>
      <input type="hidden" name="wpss_crud[field]" value="new" />
    <?php else:?>
      <input type="hidden" name="wpss[id]" value="<?php echo $field->id;?>" />
    <?php endif;?>
    <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />

    <div class="wpss-admin-nav">
      <p>
        <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
        <?php $button = ($field->new)? 'Create Field' : 'Update Field';?>
        <input class="button-primary" class="left" type="submit" name="save_field" value="<?php echo $button;?>" />&nbsp;
        <a class="button" href="<?php echo $util->admin_url('quiz', 'fields_index', $quiz->id);?>">&lsaquo; back</a>&nbsp;
      </p>
    </div>

  </form> 


