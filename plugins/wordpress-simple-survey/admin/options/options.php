<?php
defined('WPSS_PATH') or die();

wpss_save_options();

$custom_css = get_option('wpss_custom_css');
$email_header_compatibility = get_option('wpss_email_header_compatibility', 'pass_explicitly_to_wp_mail');

?>
<div class="wrap wpss wpss_settings">
  <img class="left" src="<?php echo WPSS_URL.'assets/images/wpss_admin.png'?>" />
  <h2 class="left">WPSS Options</h2>
  <div class="clear"></div>
  <hr />

  <form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">

    <h2>Tweaking plugin display styles</h2>
  
    <p>The <a href="http://www.sailabs.co/products/wordpress-simple-survey/">WordPress Simple Survey</a> plugin is designed to look great with whatever theme you're using, but some site owners may want to tweak some of the styles output by the plugin. Enter your custom CSS directly into the box provided below. Use your browser's development tools, such as Firebug, to get the classes and IDs for the items you want to style.</p>
  
    <textarea name="wpss[custom_css]" class="large-text code" rows="15"><?php echo $custom_css;?></textarea>
    <p class="description">The parent CSS class for all quizzes is: &nbsp;&nbsp; .wpss{ }</p>
    <p class="description">Each quiz gets a unique CSS ID containing the quiz's numeric ID as well, for example: &nbsp;&nbsp; #wpss_quiz_1{ }</p>
    <p class="description">Also note that while this dynamic CSS box is great for testing, it is considered best practice to move all CSS in a static stylesheet.</p>
    <div class="clear"></div>



    <h2>Mailer Headers</h2>

    <p>Some email plugins overwrite WordPress's native emailing functionality <a target='_blank' href='http://codex.wordpress.org/Function_Reference/wp_mail'>wp_mail()</a>. WordPress Simple Survey uses wp_mail() to send quiz results. This option toggles how email headers are set in this plugin to allow for more compatibility with special email plugins and MTAs.</p>

    <?php $ehc = $email_header_compatibility;?>
    <select name='wpss[email_header_compatibility]'>
      <option value='pass_explicitly_to_wp_mail' <?php echo $ehc == 'pass_explicitly_to_wp_mail' ? 'selected' : '' ?>>
        Pass explicitly to wp_mail() (default)
      </option>
      <option value='set_with_callbacks' <?php echo $ehc == 'set_with_callbacks' ? 'selected' : '' ?>>
        Set with callbacks
      </option>
      <option value='do_not_set_headers' <?php echo $ehc == 'do_not_set_headers' ? 'selected' : '' ?>>
        Do not set headers (compatibility mode)
      </option>
    </select>

    <div class="clear"></div>
  
    <br />
    <input class="button-primary" class="left" type="submit" name="save_options" value="Save Options" />&nbsp;
  </form>

</div>
