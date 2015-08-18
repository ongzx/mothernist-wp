  <!-- For for Edit and New Quiz -->
  <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">


    <!-- Basic Quiz Options -->
    <div id="icon-tools" class="icon32"></div><h2>Basic Options</h2>
    <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[title]">Name</label></th>
          <td>
            <input name="wpss[title]" type="text" value="<?php echo $quiz->title;?>" class="regular-text" required="required">
            <span class="description">Quiz or Survey name.</span>
          </td>
        </tr>
  
        <?php if($quiz->new != true):?>
          <tr valign="top">
            <th scope="row"><label for="wpss[shortcode]">Shortcode</label></th>
            <td>
              <code>[wp_simple_survey id="<?php echo $quiz->id;?>"]</code>
              <br />
              <span class="description">Put this shortcode into pages and posts to display the quiz.</span>
            </td>
          </tr>
        <?php endif;?>

        <tr valign="top">
          <th scope="row"><label for="wpss[show_title]">Show Title on Frontend?</label></th>
          <td>
            <input name="wpss[show_title]" type="hidden" value="0" />
            <input name="wpss[show_title]" type="checkbox" value="1" <?php echo $quiz->show_title ? "checked" : ""; ?> />
            <span class="description">Optionally show/hide title on the frontend.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[store_results]">Store Quiz Results?</label></th>
          <td>
            <input name="wpss[store_results]" type="hidden" value="0">
            <input name="wpss[store_results]" type="checkbox" value="1" <?php echo $quiz->store_results? "checked":"";?>>
            <span class="description">Store quiz results in the database.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[send_admin_email]">Email Results?</label></th>
          <td>
            <input name="wpss[send_admin_email]" type="checkbox" value="1" <?php echo $quiz->send_admin_email? "checked":"";?>>
            <span class="description">Send each submission via email.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[admin_email_addr]">Email Address</label></th>
          <td>
            <input name="wpss[admin_email_addr]" type="email" value="<?php echo $quiz->admin_email_addr;?>" class="regular-text">
            <span class="description">Email results to this address.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[submit_txt]">Submit Text</label></th>
          <td>
            <?php wp_editor( $quiz->submit_txt, 'submit_txt', array('textarea_name'=>"wpss[submit_txt]", 'teeny'=>true) ); ?>
            <span class="description">Text displayed above the submit-quiz button.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[submit_button_txt]">Submit Button Text</label></th>
          <td>
            <input name="wpss[submit_button_txt]" type="text" value="<?php echo $quiz->submit_button_txt;?>" class="regular-text">
            <span class="description">Text for the actual submit button.</span>
          </td>
        </tr>

      </tbody>
    </table>



    <!-- Advanced options -->
    <div id="icon-options-general" class="icon32"></div><h2>Advanced Options</h2>
    <table class="form-table">
      <tbody>

        <tr valign="top">
          <th scope="row"><label for="wpss[send_user_email]">Auto-Respond to Users?</label></th>
          <td>
            <input name="wpss[send_user_email]" type="hidden" value="0" />
            <input name="wpss[send_user_email]" type="checkbox" value='1' <?php echo $quiz->send_user_email? "checked":"";?>>
            <span class="description">Automatically send email to quiz taker via inputted email address fields.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[user_email_content]">Auto-Respond Email Content</label></th>
          <td>
            <?php wp_editor($quiz->user_email_content, 'user_email_content', array('textarea_name'=>"wpss[user_email_content]", 'teeny'=>true));?>
            <span class="description">Content for automated email. Can use shortcodes:</span>
            <span>[routed], [score], [quiztitle], and [answers]</span><br />
            <span class="description">
              Can also use shortcodes shown on the Fields menu for this quiz to insert custom field answers from the quiz taker.
            </span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[user_email_subject]">Auto-Response Email Subject Line</label></th>
          <td>
            <input name="wpss[user_email_subject]" type="text" value="<?php echo $quiz->user_email_subject;?>" class="regular-text">
            <span class="description">Email subject line to quiz taker.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[user_email_from_name]">Mail-From Name</label></th>
          <td>
            <input name="wpss[user_email_from_name]" type="text" value="<?php echo $quiz->user_email_from_name;?>" class="regular-text">
            <span class="description">Not allowed on all shared hosting platforms.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[user_email_from_address]">Mail-From Email Address</label></th>
          <td>
            <input name="wpss[user_email_from_address]" type="text" value="<?php echo $quiz->user_email_from_address;?>" class="regular-text">
            <span class="description">Not allowed on all shared hosting platforms.</span>
          </td>
        </tr>

        <tr valign="top">
          <th scope="row"><label for="wpss[question_order]">Question Order</label></th>
          <td>
            <select name="wpss[question_order]">
              <option value='display_order' selected>Use Display Order</option>
            </select>
            <br />
            <span class="description">Upgrade to the extended version to use randomized order.</span>
          </td>
        </tr>

      </tbody>
    </table>


    <?php if($quiz->new):?>
      <input type="hidden" name="wpss_crud[quiz]" value="new" />
    <?php else:?>
      <input type="hidden" name="wpss[id]" value="<?php echo $quiz->id;?>" />
    <?php endif;?>
    <div class="wpss-admin-nav">
      <p>
        <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
        <?php $button = ($quiz->new)? 'Create Quiz' : 'Update Quiz';?>
        <input class="button-primary" class="left" type="submit" name="save_quiz" value="<?php echo $button;?>" />&nbsp;
        <a class="button" href="<?php echo $util->admin_url('', '', '');?>">&lsaquo; back</a>&nbsp;
      </p>
    </div>


  </form> 
