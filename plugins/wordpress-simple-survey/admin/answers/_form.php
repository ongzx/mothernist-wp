  
  <div id="icon-tools" class="icon32"></div><h2>Question</h2>
  <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="question">Question Preview</label></th>
          <td><pre><?php echo wpss_text_preview( $question->question ); ?></pre></td>
        </tr>
  
      </tbody>
  </table>
  <div class="clear"></div>


  <!-- Form for Edit and New Answer -->
  <?php $action = ($answer->new)? WPSS_NEW_ANSWER.'&question_id='.$question->id : $_SERVER['REQUEST_URI'];?>
  <form method="post" action="<?php echo $action;?>">

    <!-- Answer Form -->
    <div id="icon-page" class="icon32"></div><h2>Answer</h2>
    <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[answer]">Answer</label></th>
          <td>
            <textarea name="wpss[answer]" style="width:100%;height:100px;"><?php echo $answer->answer;?></textarea>
            <span class="description">Answer format.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[weight]">Weight</label></th>
          <td>
            <input name="wpss[weight]" type="number" value="<?php echo $answer->weight;?>" class="small-text">
            <span class="description">Weight for this answer.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[display_order]">Order</label></th>
          <td>
            <input name="wpss[display_order]" type="number" value="<?php echo $answer->display_order;?>" class="small-text">
            <span class="description">Display order rank.</span>
          </td>
        </tr>

      </tbody>
    </table>

    <?php if($answer->new):?>
      <input type="hidden" name="wpss_crud[answer]" value="new" />
    <?php else:?>
      <input type="hidden" name="wpss[id]" value="<?php echo $answer->id;?>" />
    <?php endif;?>
    <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />
    <input type="hidden" name="wpss[question_id]" value="<?php echo $question->id;?>" />


    <div class="wpss-admin-nav">
      <p>
        <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
        <?php $button = ($answer->new)? 'Create Answer' : 'Update Answer';?>
        <input class="button-primary" class="left" type="submit" name="save_answer" value="<?php echo $button;?>" />&nbsp;
        <a class="button" href="<?php echo $util->admin_url('question', 'edit', $question->id);?>">&lsaquo; back</a>&nbsp;
      </p>
    </div>

  </form> 

