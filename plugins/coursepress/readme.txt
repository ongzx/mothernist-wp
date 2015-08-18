﻿=== Plugin Name ===
Contributors: wpmudev
Tags: elearning, lms, education, courses, lessons, assignments, students, teachers
Requires at least: 4.1
Tested up to: 4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CoursePress turns WordPress into a powerful online learning platform.

== Description ==

CoursePress turns WordPress into a powerful online learning platform. Set up online courses by creating learning units with quiz elements, video, audio etc. You can also assess student work, sell your courses and much much more.

= The easy way to create, manage and sell online courses in WordPress. =
CoursePress makes it easy to quickly create courses in WordPress and display them from a beautiful interface. It’s the perfect solution for selling and sharing your knowledge.

[youtube https://www.youtube.com/watch?v=HXzOBRYVjDw&list=UULgqhMisF-ykzHZzuMEfV4Q&hd=1]

= It's all in the box =
With options for building video-driven courses, letting participants upload and download content, quiz creation, sharing audio and course discussion boards baked right in – CoursePress has everything you need to produce top-notch content. Entice new students to register by sharing a course preview and overview complete with a video preview.

= Options for both free and paid courses =
Whether you want to share courses for free, or sell them, we've included tools for accepting free-students, manual payments and automated credit card payments.

= Manage courses like a pro =
CoursePress features tools for managing everything – grading, marking, assessments, reporting (including automatic grading and reporting), student & instructor management and everything else you'd expect from a complete Learning Management System.

= Integrates with almost every theme =
Use the official built-in CoursePress theme to get rolling quickly or the complete widget and shortcode catalog that covers every aspect of the plugin, allowing you to easily use it with any WordPress theme.

= Level-up with CoursePress Pro =

While CoursePress is suitable for offering a few courses, you may have bigger goals for your site. [CoursePress Pro](http://premium.wpmudev.org/project/coursepress-pro "Create, manage and sell online courses in WordPress") takes the features you love from CoursePress and unlocks the ability to create an unlimited number of courses. Plus get over 12 payment gateways making it even easier to accept payments for your premium content.

Check out all the goodies bundled in CoursePress Pro:

* Unlimited Course creation (Limit 2 for CoursePress)
* Manage and develop everything from tutorials to a full online school
* Intuitive tools for course promotion and marketing
* Entice new students with a course ‘teaser’ – including previews of video, course elements  and a description
* Add over a dozen payment gateways for accepting payments for premium courses (The standard version only offers PayPal, Simplify and manual payments)
* Both automated and manual assessment and reporting features – including automatic grading
* Offer free courses and attract new users
* Complete media integration for quickly adding video and audio content
* Out-of-the-box setup using the included ‘CoursePress’ theme – or dynamically integrate with any theme using shortcodes
* Interactive discussion boards to help develop a more robust learning environment
* Allow students to download and upload quiz files or any other file types
* Provide a complete course description, promotional video and image – let your students know exactly what they are registering for
* Offer genuinely assessed certification
* Live [Chat](https://premium.wpmudev.org/project/wordpress-chat-plugin/ "The best stand-alone live chat WordPress plugin") integration for real-time interaction
* And it works great with Multisite

Easily add beautiful courses to your WordPress install or Multisite network.

== Installation ==

= To Install =

* Download the CoursePress plugin file
* Unzip the file into a folder on your hard drive
* Upload the /coursepress/ folder to the /wp-content/plugins/ folder on your site
* Visit your Dashboard -> Plugins and Activate it there.

= To Set Up And Configure CoursePress = 

You can find [in-depth setup and usage instructions with screenshots here »](http://premium.wpmudev.org/project/coursepress-pro/#usage "CoursePress plugin installation and usage help")

== Screenshots ==

1. All the elements you need to create a great course
2. Your courses have never looked so good
3. Real-time interaction with Chat
4. Will your course have a six figure launch?
5. Offer certification with your courses with grading, marking and assessment tools
6. Display and promote your courses however you like
7. Massively customizable
8. Over a 13 payment gateways

== Changelog ==

= 1.2.5.4 =
* Fixed issue with marking a order as paid with Manual Payments
* Fixed issue with Virtual pages
* Added additional hooks for developers
* Integration with WooCommerce (CoursePress > Settings > WooCommerce Integration)

= 1.2.5.3 =
* Security Update: Fixed possible WordPress XSS bug
* Fixed clearfix div
* Fixed broken virtual pages

= 1.2.5.2 =
* Fix missing class error for CoursePress Standard.

= 1.2.5.1 =
* Added basic certificate functionality to CoursePress Pro (templates planned for future release).
* Added additional capabilities for instructors
* Added formatting to the instructor single page
* Changed default 'subscriber' role for students to be actual default WordPress role set
* Fixed issue with enrolling a student to a paid course (paid via PayPal chained payments)
* Fixed issue with mandatory, assessable and limit attempts options (if once checked then unchecked)
* Fixed issue with uncompleted course even if unit elements (answer fields) were completed
* Fixed issue: Course Pre-Requisite still showing after required course completed
* Fixed theme translation issues
* Fixed issue with instructor profile pages when instructor username contains space
* Fixed issue with Course Structure links when course starts in the future
* Fixed "unit_page_title_tag_class" shortcode attribute to output valid HTML class
* Fixed issues with courses bulk actions
* Fixed issue with previewing a unit (when user needs to pass all mandatory assessments option is checked)
* Fixed issue with Order Complete Page MarketPress message
* Fixed issue with displaying 1970 date on the course calendar when clicking on the previous link
* Fixed issue with course order when Post Order Number is selected as an course order option
* Fixed issue with login and signup popup links
* Fixed issue with admin discussions pagination
* Fixed instructors courses list properly with pagination (10 courses+)
* Removed ping backs from courses (implementation on the feature request list).
* Fixed conflicts with BuddyPress Groups.
* Fixed issue with loading CoursePress styles on other admin pages.
* Fixed issue with broken file downloads in Units (sites using PHP 5.6+).
* Fixed issue where non-embeddable videos (e.g. some YouTube videos) shows nothing. Now it will show a clickable link.
* Added ability to hide related videos for YouTube videos.
* Fixed RTL issue causing horizontal scroll bug on Course Overview page.
* Fixed 0's showing up on CoursePress pages when Poll Voting Plugin is installed.
* Fixed new units automatically added to structure where it was not before.
* Fixed showing featured images in CoursePress theme.
* Fixed issue with paid courses not always enrolling when using MarketPress.
* Fixed issue with instructor marked mandatory results not calculating course completion correctly.
* Fixed broken 'Recent Posts' widget when viewing any CoursePress page.

= 1.2.5 =
* Added additional hooks and filters for developers

= 1.2.4.9 =
* Fixed: Auto correcting previous student responses for Single- and Multiple Choice questions without needing to re-submit answers.
* This release improves the changes made in version 1.2.4.8.

= 1.2.4.8 =
* Fixed potential issue when using quotation marks or special characters in Single- and Multiple Choice questions.
* Fixes auto-grading of questions and mandatory questions reporting. (Note: Students may need to resubmit some responses)

= 1.2.4.7 =
* Recommended performance update. Significant improvements made (e.g. From 17s down to 0.56s using high volume test sample.)
* Progress tracking changed from course focused to student focused reducing database queries. Pages might load a fraction slower (up to 1s in testing) the first time old students accesses a course.
* Shortcode performance improvements
* Removing redundant CoursePress metadata from database
* Fixing unit layout issues resulting in HTML being displayed on the screen.

= 1.2.4.6 =
* Performance: When persistent object caching (server setup or 3rd party) is not available CoursePress will fall back to using transients to speed up page loads.
* Fixed: [course_join_button] now works properly on pages (bug caused it only to work on posts).
* Changed: [course_thumbnail] deprecated. Will revert to preferred [course_media type="thumbnail"] using the proper Course List image as thumbnail.
* Fixed: Required fields error for enrolment popup.
* Fixed: 'Start Learning Now' button in enrolment popup.
* Fixed: Added missing translations.

= 1.2.4.5 =
* Fixes issue with marking an order as paid with MarketPress
* Fixed text domain issues with the CoursePress theme
* Fixes issue with the LOGIN_ADDRESS email tag and its URL
* Fixed jQuery issues on the front-end caused by "live" function

= 1.2.4.4 =
* Resolved issue with unit element content saving / removed unit HTML editor

= 1.2.4.2 =
* Updated MarketPress to 2.9.6
* Added Unit HTML editor back (for Mac)
* Fixed bug with unit editor (double editor on switch)

= 1.2.4.1 =
* Updated course structure (admin and front) to reflect recent changes in the units builder logic
* Fixed issue with Jatpack's CSS editor
* Added additional filters for developers in shortcodes

= 1.2.4 =
* Added option for deleting student answers / responses
* Added option for instructor to access units and other course inner pages without need to enroll into course
* Fixed JS conflicts caused issues with WP admin menu on hover
* Fixed responsive issues on the course archive page with the default CoursePress theme

= 1.2.3.9 =
* Added HTML editor to the units builder
* Fixed issue with hidden students in the reports list (multisite)
* Fixed issue with wrong redirection link when submitting data on the last unit page (front)

= 1.2.3.8 =
* Added scroll (slimscroll) for the long lists of units on the course unit admin page
* Added integration with Messaging (1.1.6.7 and above) plugin (http://premium.wpmudev.org/project/messaging/)
* Fixed issues with BBPress topics when CoursePress is active
* Fixed issues caused by clearfix located in the plugin
* Fixed UX issues with "Resubmit" answer link

= 1.2.3.7 =
* Course Calendar widget updated. New default CSS to work better across themes. Added date indicator selector for better presentation on light and dark themes. Including selector to use custom CSS defined by theme or CSS plugin.
* Fixed issue where the unit editor converts absolute URLs to relative URLs on sites hosted with WPEngine.
* Fixed issue with incorrect unit completion percentages.
* Fixed PHP warnings when using CoursePress with TwentyFifteen theme.

= 1.2.3.6 =

* Fixed: Date translations now work properly.
* Fixed issue with extra content on the unit page singe page
* Fixed Gravity Forms form submission and redirection on the unit pages

= 1.2.3.5 =

* Added STUDENT_USERNAME and STUDENT_PASSWORD placeholder to the student registration email 
* Fixed (potential) issue with student signup when FORCE_SSL_ADMIN is turned on
* Fixed conflicts with Gravity Forms (admin and unit pages)
* Fixed issue with multisite and granting and revoking instructor capabilities.
* Fixed: Comments section no longer showing on course details page.
* Fixed issue with 'Start Learning/Continue Learning' buttons not showing for courses set to manual enrollments.
* Fixed: Instructor Capabilities On User Profile Page Not Saving When Granting/Revoking Capabilities
* Fixed: coursepress_student_withdrawn hook is firing twice for a single withdrawal
* Fixed issue with unique course and units slugs

= 1.2.3.4 =

* Added additional instructor capability for managing Course Categories
* Added unit elements preloader
* Course completion actions added for developers: 'coursepress_student_course_completed', 'coursepress_student_course_unit_completed'
* Unit completion actions added for developers: 'coursepress_student_course_unit_pages_viewed', 'coursepress_student_course_unit_mandatory_question_answered', 'coursepress_student_course_unit_gradable_question_passed'
* New options for "Who can enroll" when not allowing anyone to register to your site.
* Fixed WordPress 4.1 issues (hidden course list in the admin, hidden assessment list)
* Fixed "administrator" role for network sites.
  CoursePress menus and permissions now work properly for new sites.
  For old sites the administrator's role will have to be reset (change to "subscriber" then back to "administrator").
* Fixed shortcode typos on the settings page
* Fixed issue with prerequisite courses for non-logged-in users
* Fixed issues with enrollment/signup button
* Fixes issue with unit editors upon reordering elements (Firefox)
* Strip html tags from the assessment comment ALT and TITLE
* Fixed issues with dummy course not being created upon first install 
* Other code improvements

= 1.2.3.3 =
* Fixed issue with thumbnails not displaying or getting generated for courses.

= 1.2.3.2 =
* Fixed translation file

= 1.2.3.1 =
* Updated MarketPress to 2.9.5.9
* Added additional set of instructor capabilities for Discussions
* CSS improvements (added better CSS styles on the feature course buttons in the CoursePress theme)
* Updated translation file
* Added support for WordPress "Week Starts On" day in the course date fields and the Unit Availability field
* Fixed issue with saving course categories
* Fixed issue with showing "No elements have been added to this page yet" on the last unit page
* Fixed issue where users saving their own profiles remove instructor capabilities
* Fixed issue with MarketPress sale price (not being saved)
* Fixed issue with primary blog on multisite
* Fixed issue with pagination class (not displaying more than 10 pages)
* Fixed issue with not showing draft units preview (for both admin and assigned instructors)
* Fixed issue with duplicate course and MarketPress products
* Other code improvements

= 1.2.2.9 =
* Added course reordering on courses admin page (drag & drop)
* Added new options under CoursePress general settings for controlling course order in admin and front 
* Added option for displaying different number of rows on the courses admin page
* New hooks for developers and code improvements
* Fixed issues with loosing element content 

= 1.2.2.8 =
* Critical Fix: Fixed bug preventing elements being added to units.

= 1.2.2.7 =
* Resolving translation issues on general settings page and email body (functions)
* Included new translation file containing all localization strings
* Added course calendar locale for month and day of the week names
* Fixed: Primary blog tweaks on multisite installs.
* Fixed: Instructor capabilities on multisite installs.
* Fixed: [course_list show_media="yes"] now correctly shows the media defined in settings.
* Updated MarketPress (2.9.5.8)
* Other small code improvements

= 1.2.2.6 =
* Fixed issue with wrong MD5 for instructor username in shortcodes which caused broken instructor single page if "Show Instructor Username in URL" option is not selected
* Fixed issue with table prefix (instructor_by_hash)
* Fixed issue with SKU not being shown on course overview page and product list in MarketPress
* Fix broken redirect to cart on signup
* Small code improvements

= 1.2.2.5 =
* Multisite improvements for students and instructors.
* Added course categories and course categories widget (in order to make it work please re-save CoursePress settings)
* Fixed: CoursePress theme navigation restored in responsive/mobile views.
* Improved some responsive elements of the CoursePress theme.
* Fixed issue with mobile menu not appearing on the some Android devices
* Small code improvements
* Updated MarketPress to 2.9.5.7

= 1.2.2.4 =
* Added integration with "Terms of Service" plugin http://premium.wpmudev.org/project/terms-of-service/
* Improved CoursePress for multi-site.
* Improved CoursePress security for multi-site.
* Improved UX for MarketPress in the admin (MarketPress activation and installation menu, links and messages shown to users who don't have required permissions)
* Future integration with Ultimate Facebook plugin to better promote courses on Facebook using OpenGraph data. (Currently works with CoursePress theme, but requires future Ultimate Facebook 2.7.8+ for all other themes.)
* Fixed: Instructors can now successfully create own courses (provided capability is set in CoursePress settings).

= 1.2.2.3=
* Changed the method of activation and installation of MarketPress
* Resolved issue with incorrect SKU being returned in checkout process.

= 1.2.2.2=
* Fixed issue with not showing HTML tags in excerpt
* Resolved issues with UTF-8 characters in filename in the TCPDF library
* Fixed up issue with translation files not working properly.
  - Updated languages files.
  - Updated cp-en_GB translation (Enrollment vs Enrolment).
  - Placing translations in /coursepress/languages now works correctly.
* Added additional hooks for developers in class.course.unit.php and class.course.unit.module.php.
* Fixed issue with some shortcodes displaying content out of place on a page.

= 1.2.2.1=
* Fixed issues caused e-newsletter plugin to show blank page in admin
* Fixed possible issues with MarketPress update
* Fixed issues with clearing cookie data in course checkout message
* Updated translation files

= 1.2.2.0=
* Added new option in settings for PDF report font & Added new fonts
* Updated MarketPress to 2.9.5.4
* More consistent filters and actions for developers (more to come).
* Improved database performance with new instructor 'Privacy' setting (may need to re-add instructors to old courses if you use the privacy option).

= 1.2.1.9=
* Added new settings (Privacy) for controlling visibility of instructor username in the URL
* Resolved issues with cp_get_file_size functions and fatal error if filesize cannot be retrieved

= 1.2.1.8 =
* Fixed issue course excerpt (not showing on course single and archive pages)
* Fixed issue with popup windows (responsive)

= 1.2.1.7 =
* Resolved issue with plugin update

= 1.2.1.6 =
* Fixed bug where visual editor prevented unit elements from saving.
* Fixed bug after duplicating course. Can now edit the course again.

= 1.2.1.5 =
* Fixed issue with instructor's profile avatar shortcode
* Fixed conflicts with bbPress (not showing topics when CoursePress is active)
* Resolved issue with course front-end edit links (caused by empty spaces)

= 1.2.1.4 =
* Fixed issue with incorrect registration of module post type
* Fixed issues with hard coded http:\\ resources (google fonts and images in the theme and plugin)
* Fixed issue with not saving Login Slug
* Added additional options in settings for pages (instead of virtual pages) for enrollment process, login page, signup page, student dashboard and student settings
* Visual editor improvements.  
* Small code improvements

= 1.2.1.3 =
* Fixed issue with MarketPress product page infinite loop when CoursePress is active
* Fixed issue with instructor avatars preview

= 1.2.1.2 =
* Fixed issue with enrollment date and time (it uses now current_time( 'timestamp') instead of time())
* Fixed issue with media shortcode display in the CoursePress theme
* Fixed issue with course archive for courses without media set

= 1.2.1.1 =
* Added additional settings for controlling wp-login redirection
* Fixed issue with "Instructor Capabilities" settings access as a student
* Various database improvements. 
* Added course progress display to student workbook.  
* Added unit progress to CoursePress theme on student workbook.  
* Added categories in the single post and blog archive
* Fixed issue with hidden comment form when plugin is activated
* Added passcode fields on login and signup popup forms
* Minor changes to enrollment popup window. 

= 1.2.1 =
* Fixed issue with incorrectly displayed footer on student login page
* Fixed issue with BuddyPress autocomplete on Compose Message page
* Added a number of hooks in the main CoursePress class

= 1.2 =
* Added Duplicate Course feature
* Fixed issue with "units" slugs
* Fixed jQuery conflicts with theme options in WPMU Dev themes  
* Added Unit restriction options to avoid confusion between 'completed answers' and 'successfull/passed answers'.  
* Fixed unit restriction checking on front end 'Units' page. Will now show restrictions required from previous unit.

= 1.1.1 = 
* Fixed issue with protection of the next unit when previous unit has set "User needs to complete current unit in order to access the next one"
* Fixed bug with removing a Single Choice element from a Unit

= 1.1.0 =
* Fixed issue with course limits in PRO version

= 1.0.9 =
* Resolved issue with details button on courses archive and inconsistent shortcode used

= 1.0.8 = 
-------------------------------------------------
* Upgraded MarketPress Bundle to 2.9.5.3
* Added warning message (for admins) to the course overview page if "anyone can register" is not selected
* Fixed issue with instructor capabilities settings and saving
* Fixes possible issues with rewrite rules formating and avoid 404s
* Fixed issue with non-protected discussions for students who didn't enroll to the course
* Fixed issue with visibility of the draft units for admins and instructors* Fixed up issues with course completion checking  
* Added file size indicator next to downloadable files  

= 1.0.7 = 
-------------------------------------------------
* Resolved issues with wrong pre_get_posts filtering within the admin

= 1.0.6 = 
-------------------------------------------------
* Improved security
* Fixed: Auto-update issue with text editor in course setup  
* Slightly larger content editor for more convenient editing
* Fixed: Course completion now calculates correctly
* Resolved issue with incorrect saving of Single Line / Multiple Lines option in input text element
* Added student username (and link to the student's profile) in the assessment column
* Dynamic MarketPress path set

= 1.0.5 =
-------------------------------------------------
* Resolved issues with displaced content when PopUp Pro plugin is active
* Resolved issue with (not honoring) WP Settings for registrations
* CoursePress Theme CSS fixes
* Settings changes and Improved security  


= 1.0.4 =
-------------------------------------------------
* Shortcode changes and Improved security
* Fixed textdomain issues
* Resolved potential issue if Mcrypt library is not installed on server

= 1.0.3 =
-------------------------------------------------
* Improved security
* Resolved CSS issues with MarketPress popup called from CoursePress
* Fixed issue with theme location in the CoursePress theme
* Fixed CSS issue with uploaded videos in CoursePress theme (plus better responsive)
* Resolved issue with output buffer in shortcodes
* Added missing text domain on a number of places
* Other code improvements

= 1.0.2 =
-------------------------------------------------
* Resolved issue with mobile menu
* Resolved issue with listing images, videos and overlapping content in the CoursePress theme
* Responsive fixes for admin pages

= 1.0.1 =
-------------------------------------------------
* Resolved issue with deleting media files (selected in elements) upon deleting a unit or a module.

= 1.0.0 =
-------------------------------------------------
* 1.0 First Release.