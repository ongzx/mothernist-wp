=== Wordpress Simple Survey ===
Contributors: richardroyal
Donate link: http://www.sailabs.co/products/wordpress-simple-survey/
Tags: survey, quiz, poll, exam, test, questionnaire, responsive, personality quiz, product survey
Requires at least: 3.8.0
Tested up to: 4.1.1
Stable tag: 3.0.0

Use this plugin to easily create surveys and graded quizzes. You can track the results and guide users to different locations based on their scores.

== Description ==

Use the WordPress Simple Survey plugin to easily create surveys, quizzes, polls, and questionnaires and track the results. The plugin creates a seamless experience for the user; no loading and reloading of webpages. The browser-tested plugin uses responsive design, so it functions beautifully on any size screen. 

Here's how it works: select how each question is weighted to determine the user's final score. When a quiz is submitted, you can have the results sent to a predefined email address, or simply log in to the WordPress backend to view, email and export submissions as a CSV file. Get creative! Once a quiz is submitted, you can send users to any custom URL based on their score. 

Upgrade to the Extended Version for even more functions and features, like multiple response questions and free text options. 

* [Project Homepage](http://www.sailabs.co/products/wordpress-simple-survey/)
* [Support](https://sailabs.zendesk.com/hc/en-us/categories/200014674-WordPress-Simple-Survey)
* [Extended Version](http://www.sailabs.co/products/wordpress-simple-survey/wordpress-simple-survey-extended-version/)

= Product Demos =

* [Personality Quiz Demo](http://product-demo.wp-simple-survey.sailabs.co/)
* [Arithmetic Exam Demo](http://product-demo.wp-simple-survey.sailabs.co/arithmetic-quiz)
* [Product Survey Demo](http://product-demo.wp-simple-survey.sailabs.co/product-survey)

= Features =

We offer a free version of WPSS, as well as an extended paid version. Your purchase allows us to continue developing and improving the plugin, while providing free support through our Zen Desk support forum.

Free Version

* Store quiz results in database
* View summary of quiz results
* Email each quiz result to admin
* Create auto-response email to quiz takers
* Customizable email content and subject line to quiz takers
* Responsive design for mobile compatibility
* Compatibility with all major browsers
* Single-answer questions

Extended Version

* Multi-response questions
* Free input text boxes (one line of text)
* Free input textareas (multiple lines of text)
* Select boxes input type
* Custom field text input
* Custom field textareas
* Add images and media to questions
* Add images and media to answers
* Email-only field for gathering user's email address at end of quiz
* Custom fields for gathering miscellaneous information at end of quiz (name, contact info, etc.) 
* Add custom field values to auto-response email
* WYSIWYG editor on questions and answers
* Create multiple quizzes
* Display end user their score at custom URL
* Display end user their answers at custom URL
* Export results in CSV format
* Delete results
* Randomize question order
* Allow quiz taker to chose admin recipient

== Installation ==

1. Upload plugin to the 'wp-content/plugins/' directory. Ensure that there is only one WPSS folder and it is named "wordpress-simple-survey".
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Once activated the new menu item: Surveys/Quizzes, is created on the admin sidebar.
4. For each quiz, configure the options, add questions with answer, then configure the routes and numeric ranges.
5. Put the quizzes shortcode in a page or post. Each shortcode will look like: [wp_simple_survey id="1"].
6. Do not paste from MS Word without cleaning the text or the output may look malencodded.
7. If you are upgrading to the extended version, upload the new file directly over the old files then deactivate and reactivate the plugins. You will not lose any data.

== Frequently Asked Questions ==

= How do I make the quiz show up in my content? =

Add the string: [wp_simple_survey id="1"] to a page or post.

= How are results tracked? =

You have the option to store the results for each quiz. The full results (including the question and answer text) are stored in your database. If you later make changes to the questions or answers, the previous results are still stored with the questions and answers unchanged.

= I don't want the user to be immediately directed to the end page. How can I create a buffer page? =

Create a buffer page. Instead of linking a score range to the end page, send users to a buffer page that explains their scores. Include a link to the end page from that buffer page. 

= What type of quizzes can I create? =

The plugin is most commonly used in two ways: quizzes and surveys.

Quiz-Type: Route users to either a "Passing" or "Failing" page. 

Survey-Type: Route users to a custom URL based on their score range. 

Note: Both quizzes and surveys can be set up to record user email addresses. The ability to collect contact information means you can use the plugin in creative ways. A college professor can easily record the students who passed or failed. Market researchers can email potential customers based on their survey responses, etc.

== Screenshots ==

1. Standard question
2. Question with a photo
3. Require email address to see results/have them emailed to you
4. Route to page based on results 
5. Quiz options
6. Routes
7. Editing a question
8. Editing an answer
9. Use the built-in WordPress editor to easily format or add photos to your questions

== Changelog ==

= 3.3.0 =
* Minified JS and CSS assets.

= 3.2.1 =
* Added global options for handling email headers, explicitly send to wp_mail, set with callbacks, or set no email headers.

= 3.2.0 =
* Improved admin page authorization.

= 3.1.0 =
* Added ability to put custom field answers into the auto-response email via shortcodes.

= 3.0.2 =
* Fixed minor bug in saving results without custom fields on some server configurations.
* Fixed minor bug with MySQL and NOT NULL values for some WAMP servers.
* Fixed minor bug with outputting score on admin.

= 3.0.1 =
* Fixed IE8 browser compatibility issue.
* Fixed issue with T_DOUBLE_COLON/T_PAAMAYIM_NEKUDOTAYIM static function calls.
* Added route name to results index on admin.

= 3.0.0 =
* Note: The 3.x branch is not backwards compatible with the 2.x branch. Please read all documentation before migrating.
* Improved plugin structure to allow features to be merged in more easily.
* Changed Results data structure for recording quiz results to fix performance issue.
* Cleaned HTML output structure to be less intrusive and removed all traces of jQuery-UI.
* Quiz output is now Responsive.
* Allowed control of email subject line.
* Improved automatic WP User account integration for quiz takers.
* Added dynamic CSS box feature to make it easier to style plugin.
* Updated TinyMCE calls to use new WP API.
* Note: The 3.x branch is not backwards compatible with the 2.x branch. Please read all documentation before migrating.

= 2.2.9 =
* Worked on fixing SSL bug for queued assets. 

= 2.2.8 =
* Linked to quizzes by name instead of ID on Admin.

= 2.2.7 =
* Buffered variables to remove remaining WP_DEBUG warnings on some setups.

= 2.2.6 =
* Added full paths to include statements to avoid issues with PHP path issues on specific hosts.

= 2.2.5 =
* Forced UTF support through dbDelta function.

= 2.2.4 =
* Added new WordPress TinyMCE API to email textarea and question textarea (Extended Version now has media manager with textareas).

= 2.2.3 =
* Added htmlspecialchars to results preview. Linked to new support forums and plugin site.

= 2.2.2 =
* Added empty buffers to inputs of some extra functions.

= 2.2.1 = 
* Changed folder structure. Fixed quiz results display to remove HTML tags.

= 2.2.0 = 
* Added separate JS plugin file for ui.widget and ui.progressbar for better JS compatability. Cleaned up CSS and markup.

= 2.1.0 =
* Added admin control for add_filter priority

= 2.0.3 =
* Inserted code to prevent errors on foreach for uninitialized variables

= 2.0.2 =
* Reluctantly added ability to turn of properly imported jQuery do to harded imports in poorly written themes and plugins. API? What's that?

= 2.0.0 =
* Rewrote plugin allowing for multiple quizzes, better storage of answers, custom fields, and much more

= 1.5.3 =
* Fixed Next button bug on submit slide click trigger

= 1.5.2 =
* Changed function name for more compatability

= 1.5.1 =
* Gave Admin function calls less generic names for more compatability
* Changed jQuery Tools import function on backend, to execute only when needed, for more capatibility

= 1.5.0 =
* Added Auto-Respond Functionality 
* Changed php::mail() function to wp_mail() function from WP API
* Modified Admin look and feel

= 1.4.1 =
* Improved CSS to reset spacing and padding on more themes

= 1.4 =
* Improved mail() function and admin CSS

= 1.3 =
* Fixed bug in function that registers WPSS Menus in backend.

= 1.2 =
* Improved import method for all javascript libraries. WPSS is now using WP native versions of jQuery & jQuery-UI core. These import in noConflict() mode which is taken advantage of by the plugin. This ensures fewer conflict with existing plugins and themes. Checkform JS method is also updated (by name only); it is now wpss_checkForm(form), this also reduces conflict with existing themes' and plugins' checkform methods. 

= 1.1 =
* Changed jQueryUI import method to ensure that only one copy is being registered

= 1.0 =
* Originating version.

== Upgrade Notice ==

= 3.3.0 =
* Contains new compressed JS and CSS assets. You may need to clear your browser cache. If you have edited the plugin's CSS and JS files directly, you will need to manually merge your changed into the new files.

= 3.0.0 =
* WARNING: The 3.x branch is not backwards compatible with the 2.x branch. If you choose to upgrade you will have to re-setup your quizzes and questions. You will also lose direct access to your stored results but they will still exist in the database. Please read all the documentation before upgrading.

= 2.2.5  =
* Table collations and charsets are now UTF. However, existing databases cannot easily be changed through the plugin. If you need UTF characters, you will have to delete your WPSS database tables and then deactivate and then activate the plugin to generate new tables with UTF collation.

= 2.2.1  =
* Because the folder structure has changed, you may need to delete the 'wordpress-simple-survey' folder and replace with this update. You will not lose any data.

= 2.0.0 =
* When upgrading to 2.0.0 from 1.5, quizzes will have to be re-inserted

= 1.4 =
* Improved mail() function and admin CSS

= 1.3 =
* Fixed bug in function that registers WPSS Menus in backend.

= 1.2 =
* Improved import method for all javascript libraries. WPSS is now using WP native versions of jQuery & jQuery-UI core. These import in noConflict() mode which is taken advantage of by the plugin. This ensures fewer conflict with existing plugins and themes. Checkform JS method is also updated (by name only); it is now wpss_checkForm(form), this also reduces conflict with existing themes' and plugins' checkform methods. 

= 1.1 =
* Changed jQueryUI import method to ensure that only one copy is being registered

= 1.0 =
* None
