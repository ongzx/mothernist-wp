  <!-- Form for Edit and New Question -->
  <?php $action = ($question->new)? WPSS_NEW_QUESTION.'&quiz_id='.$quiz->id : $_SERVER['REQUEST_URI'];?>
  <form method="post" action="<?php echo $action;?>">

    <!-- Question Form -->
    <div id="icon-tools" class="icon32"></div><h2>Question</h2>

    <textarea name="wpss[question]" style="width:100%; height:200px;"><?php echo $question->question;?></textarea>


    <table class="form-table">
      <tbody>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[type]">Question Type</label></th>
          <td>
            <select name="wpss[type]">
              <option value="0" selected>Only allow one Answer</option>
            </select>
            <span class="description">Answer format.</span><br />
            <span class="description">Upgrade to the extended version to allow multiple answers including free input.</span>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"><label for="wpss[display_order]">Order</label></th>
          <td>
            <input name="wpss[display_order]" type="number" value="<?php echo $question->display_order;?>" class="small-text">
            <span class="description">Question order.</span>
          </td>
        </tr>
  
      </tbody>
    </table>

    <?php if($question->new):?>
      <input type="hidden" name="wpss_crud[question]" value="new" />
    <?php else:?>
      <input type="hidden" name="wpss[id]" value="<?php echo $question->id;?>" />
    <?php endif;?>
    <input type="hidden" name="wpss[quiz_id]" value="<?php echo $quiz->id;?>" />

    <div class="wpss-admin-nav">
      <p>
        <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
        <?php $button = ($question->new)? 'Create Question' : 'Update Question';?>
        <input class="button-primary" class="left" type="submit" name="save_question" value="<?php echo $button;?>" />&nbsp;
        <a class="button" href="<?php echo $util->admin_url('quiz', 'questions_index', $quiz->id);?>">&lsaquo; back</a>&nbsp;
      </p>
    </div>

  </form> 

  <hr />


  <!-- Answers table -->
  <?php if(!$question->new && !$question->is_free_answer_type() ): ?>
    <div id="icon-edit-pages" class="icon32"></div><h2>Answers</h2>
    <table class="form-table">
      <tbody>
    
        <tr valign="top">
          <th scope="row"><label for="wpss[answers]">Answers</label></th>
          <td>
            <table class="widefat">
            <thead>
              <tr>
                <th>&nbsp;&nbsp;Answer Preview</th>
                <th>Edit</th>
                <th>Weight</th>
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
              <?php foreach($question->answers as $answer):?>
                <tr>
                  <td><?php echo wpss_text_preview( $answer->answer );?></td>
                  <td><a href="<?php echo $util->admin_url('answer','edit',$answer->id);?>">Edit</a></td>
                  <td><?php echo $answer->weight;?></td>
                  <td><?php echo $answer->display_order;?></td>
                  <td>
                    <form method="post" action="<?php echo WPSS_DELETE_ANSWER.$answer->id;?>">
                      <?php wp_nonce_field("wpss_crud", "wpss_crud"); ?>
                      <input type="hidden" name="wpss[question_id]" value="<?php echo $answer->question_id; ?>" />
                      <input type="hidden" name="wpss[id]" value="<?php echo $answer->id; ?>" />
                      <input class="button-secondary" type="submit" name="wpss[<?php echo $answer->id;?>]" value="Delete" onclick="return confirm('Are you sure you want to delete this answer?')" />
                    </form>
                  </td>
                </tr>
              <?php endforeach;?>
            </tbody>
            </table>
          </td>
        </tr>
  
        <tr valign="top">
          <th scope="row"></th>
          <td>
            <div class="wpss-admin-nav">
              <?php if(!$question->new):?>
                <p>
                  <a class="button-primary" href="<?php echo $util->admin_url('answer','new',$question->id);?>">+ Add New Answer</a>&nbsp;
                </p>
              <?php else:?>
                <span class="description">Save the question to start adding answers.</span>
              <?php endif;?>
            </div>
          
          </td>
        </tr>
  
      </tbody>
    </table>
  <?php elseif(!$question->new && ( $question->type == "3" || $question->type == "4")): ?>
    <p><em>You have chosen free input as your question type so there are no answers to setup.</em></p>
  <?php endif; ?>
