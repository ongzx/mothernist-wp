<?php
// no direct access
if (!current_user_can('publish_posts')) wp_die( __('You do not have sufficient permissions to access this page.') );
?>

<div id="wpss_help" class="wpss_results wrap">

  <div id="icon-plugins" class="icon32"></div>
  <h2>Wordpress Simple Survey - Help</h2>
  <hr />

  <p>
    Use the <strong>WordPress Simple Survey</strong> plugin to easily create surveys, quizzes, polls, and questionnaires and track the results. The jQuery-based plugin creates a seamless experience for the user; no loading and reloading of webpages. The browser-tested plugin uses responsive design, so it functions beautifully on any size screen. 
  </p>

  <p>
    Here's how it works: select how each question is weighted to determine the user's final score. When a quiz is submitted, you can have the results sent to a predefined email address, or simply log in to the WordPress backend to view, email and export submissions as a CSV file. Get creative! Once a quiz is submitted, you can send users to any custom URL based on their score. 
  </p>

  <p>Upgrade to the Extended Version for even more functions and features, like multiple response questions and free text options.</p>

  <ul>
    <li><a href="http://www.sailabs.co/products/wordpress-simple-survey/">Project Homepage</a></li>
    <li><a href="https://sailabs.zendesk.com/hc/en-us/categories/200014674-WordPress-Simple-Survey">Support</a></li>
    <li><a href="http://www.sailabs.co/products/wordpress-simple-survey/wordpress-simple-survey-extended-version/">Extended Version</a></li>
  </ul>

  <h2>Version 2.x and 3.x Compatibility</h2>

  <p>You asked, and we listened. WordPress Simple Survey 3.0 will now support many of the features you've requested on our support forums, including custom fields, drop-down questions, responsive design, and more.</p>

  <p>Since WPSS began in 2010, the plugin and WordPress itself have gone through many changes and revisions. To make these new and exciting features work best for you, we had to restructure the plugin's code base and database structure. Unlike previous updates, WPSS 3.0 will not be backwards compatible with earlier versions. This necessary change means a little extra work for you, but we'll make sure you don't get left behind. Visit our <a href="https://sailabs.zendesk.com/hc/en-us/categories/200014674-WordPress-Simple-Survey">support page</a> and read below to begin your transition to the new and improved WordPress Simple Survey plugin.</p>

  <ul>
    <li>To fully migrate to WordPress 3.0, you will have to setup your quizzes, questions, and answers again. With the new extended version, you can add free-text.</li>
    <li>If you update to the 3.0 version from the 2.0 version, you will lose access to your current data in the WordPress admin. Visit the WPSS <a href="https://sailabs.zendesk.com/hc/en-us/categories/200014674-WordPress-Simple-Survey">support page</a> to learn how to gain access to your old data.</li>
    <li>Still want to use the old WPSS (v. 2.2.9)? No problem. You can continue to use the old plugin, ask questions and get support; however, no new development will be merged into the old versions of WPSS.</li>
    <li>If you've mistakenly updated to the new WPSS free version, you can re-download WPSS 2.2.9 here: <a href="http://d5cdf270a78da9cea568-bbb5bab06bc688b4169e00bcc9c16055.r89.cf2.rackcdn.com/wordpress-simple-survey.zip">Last 2.x Branch Version - 2.2.9</a></li>
    <li>If you need a copy of the old 2.x extended branch files, please open a <a href="https://sailabs.zendesk.com/hc/en-us/requests/new">support ticket</a> and give the email address you used to purchase the extended version with Paypal or a Paypal transaction ID.</li>
    <li><strong>You can also use a tool like phpMyAdmin to gain access to your old data. The new branch of the plugin uses different tables.</strong></li>
    <li>Click here for more information about <a href="https://sailabs.zendesk.com/hc/en-us/articles/201113724">migrating from 2.x to 3.x</a></li>
  </ul>

  
  <h2>Features</h2>
  <table class="widefat">
    <thead>
      <tr>
        <th>Feature</th>
        <th class="wpss-center">Free</th>
        <th class="wpss-center">Extended</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th>Feature</th>
        <th class="wpss-center">Free</th>
        <th class="wpss-center">Extended</th>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td>Store quiz results in database</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>View summary of quiz results</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Email each quiz result to admin</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Create auto-response email to quiz takers</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Customizable email content and subject line to quiz takers</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Resposive design for mobile compatability </td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Compatability with all major browsers</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Single-answer questions</td>
        <td class="wpss-center">&#10004;</td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Multi-response questions</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Free input text boxes (one line of text)</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Free input textareas (multiple lines of text)</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Select boxes input type</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Custom field text input</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Custom field textareas</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Add images and media to questions</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Add images and media to answers</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Email-only field for gathering user's email address at end of quiz</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Custom fields for gathering miscellaneous information at end of quiz (name, contact info, etc.) </td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>WYSIWYG editor on questions and answers</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Create multiple quizzes</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Display end user their score at custom URL</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Display end user their answers at custom URL</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Export results in CSV format</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Delete results</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>
      <tr>
        <td>Randomize question order</td>
        <td class="wpss-center"></td>
        <td class="wpss-center">&#10004;</td>
      </tr>    
    </tbody>
  </table>  
  

  
  <hr />
  
  <h2 class="title">Creating A Quiz</h2>
  <ol>
    <li>Click 'Survey and Quizzes' and fill out a new quiz including the Quiz Options, Questions and Answers, and Routing-To information.</li>    
    <li>Put the shortcode for the quiz into a WordPress page or post. For eaxmple, use [wp_simple_survey id="1"] to insert the first created quiz into a page or post. The shortcode for each quiz is given on the index of quized on the admin.</li>
  </ol>
  <p>Routes can be split up in numerous ways:</p>
  <ol>
    <li>Multiple pages and multiple ranges.</li>      
    <li>Two pages and two ranges (Pass or Fail).</li>                
    <li>One page (Thanks for taking our survey).</li>                
  </ol>
    
  <hr />

  <h2>Tracking data</h2>
  <ul class="wpss_adminlist">
    <li>Each submission can be sent to an admin email address.</li>    
    <li>An Auto-Respond can be setup for each submission so that if a user enters a valid email address, they can be sent a message along with their score and answers.</li>         
    <li>Results can be stored in the database for later examination and export.</li>
  </ul>    
  <hr />
    
  <h2>Displaying Results to the User</h2>
  <p><strong>Automatic Response Email</strong></p>
  <p>The auto-response email can contain the user's score and anwsers by using the tags:</p>
  <table>
    <tr>
      <td>User's Score:</td> 
      <td><code>[score]</code></td>
    </tr>
    <tr>
      <td>User's Question and Chosen Answers:</td> 
      <td><code>[answers]</code></td>
    </tr>
    <tr>
      <td>Taken Quiz Title:</td> 
      <td><code>[quiztitle]</code></td>
    </tr>
    <tr>
      <td>URL the user was routed to:</td> 
      <td><code>[routed]</code></td>
    </tr>
    </tr>
  </table>
  <p><strong>Routed To Page</strong></p>
  <p>The user's landing page (the routed-to page after quiz completion) can contain the user's score and quiz summary by using the tags:</p>
  <p>
    <code>[<?php echo WPSS_Result::SHORTCODE_SCORE; ?>]</code> and <code>[<?php echo WPSS_Result::SHORTCODE_FULL_RESULTS; ?>]</code>
  </p>

  <hr />

    
    
    
  <h2>Common Issues</h2>
  <ol>
    <li>Multiple jQuery's being loaded - check your page source and look for multiple jquery.js being loaded. Web apps like WordPress have functions to ensure that only one version of a particular Javascript library is loaded. Unfortunately plugin and theme developers can't seem to understand this! See <a href="http://codex.wordpress.org/Function_Reference/wp_enqueue_script">http://codex.wordpress.org/Function_Reference/wp_enqueue_script</a></li>
  </ol>
    
  
  <hr />

</div><!-- End wrap -->
