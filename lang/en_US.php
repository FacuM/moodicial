<?php
 // This is the default language, it's a PHP file that contains an array with all the required strings for Moodicial to work.
 // Filename: en_US.php
 // Author:

 $maintainer = 'Facundo Montero <facumo.fm@gmail.com>';

 $LANG = array (
  // Home
   // Empty website
   'no_data_a'                => 'Hey! Seems like no one posted here yet. Would you like to ',
   'no_data_b'                => 'be the first one?',
   // Reporting
   'report_err_disabled'      => 'Reporting has been disabled by the site owner.',
   'report_button'            => 'Report',
   // Posts
   'posted_by'                => 'Posted by ',
   // Commenting
   'comment_button_create'    => 'Comment',
   'comment_after_nick'       => 'said...',
   // Images
   'alt_broken_image'         => 'Image',
   // Content loading status
   'is_loading'               => 'Loading...',
   'is_lastpage_a'            => 'No more content to display. Would you like to ',
   'is_lastpage_b'            => ' go back to the top?',
   'update_running'           => 'New content available!',
   'nojs_nocontent_a'         => 'No more content to display.',
   'nojs_nocontent_b'         => 'Reload?',
   'nojs_ro_alert_a'          => 'You\'re seeing this read-only version of ', //website name
   'nojs_ro_alert_b'          => 'because your browser doesn\'t support Javascript.',
  // Metrics
   // Visits
   'visits'                   => 'Visits',
  // Misc
   'langbadge'                => 'Language',
   'langbadge_hint'           => 'Click or tap here',
   'ui_loading'               => 'Loading...',
   'ui_nojs'                  => 'No Javascript? Click here!',
   'server_lag'               => 'It seems like the server is taking some time to process your request, please wait for a while.',
   'server_err'               => 'Unable to complete the request. Please try again later.',
   'rate_limited'             => 'Hey! You are too quick for me! Please try again later.',
   'rate_limited_sm'          => 'Limited',
   'img_unreachable'          => 'Unable to fetch image from remote server.',
   'ui_home'                  => 'Home',
   'ui_goback_adv'            => 'Would you like to go back to the main page?',
  // Forms
   // Comments
   'comment_content_label'    => 'Content',
   // Posts
   'post_content_label'       => 'Post content',
   // Both
   'nick_label'               => 'Nick (optional)',
   'image_url_label'          => 'Image URL (optional)',
   'forms_button_submit'      => 'Submit',
   'forms_button_cancel'      => 'Cancel',
  // Footer
  'footer_credits_a'          => 'Powered by Moodicial, written by Facundo Montero using Bootstrap. Check the ',
  'footer_credits_insource'   => 'source of this file',
  'footer_credits_b'          => ' or take a look at the ',
  'footer_credits_exsource'   => 'full repo',
  // Installer
  'installer_no_db'           => 'Hey, it looks like you totally missed creating the database before trying to install the website. But don\'t feel bad, I did it for you!',
  'installer_db_creation_ok'  => 'Successfully created database ',
  'installer_db_connecting'   => 'Connecting to the databases server...',
  'installer_db_connect_ok'   => 'Done. Connection successful!',
  'installer_db_err'          => 'Something went wrong, please check your configuration in ',
  'installer_db_creating'     => 'Creating the database...',
  'installer_db_c_ctable'     => 'Creating the comments table...',
  'installer_db_c_ptable'     => 'Creating the posts table...',
  'installer_db_c_mtable'     => 'Creating the metrics table...',
  'installer_db_c_btable'     => 'Creating the banned IPs table...',
  'installer_db_c_table_ok'   => 'Created table ',
  'installer_metrics_visits'  => 'Creating the visits entry on ',
  'installer_metrics_ok'      => 'Successfully initialized the metrics table.',
  'installer_success_a'       => 'Great job! It seems like everything works ;). Would you like to ',
  'installer_success_b'       => 'try your site now?',
  'installer_metrics_cleanup' => 'Removed all entries from ',
  'installer_dl_extras'       => 'Downloading third party content.',
  'installer_dl_ok'           => 'Download completed, you can now disconnect from the internet.',
  'installer_fol_mk'          => 'Creating directory for third party content...',
  'installer_fol_ok_a'        => 'Success creating ',
  'installer_fol_ok_b'        => ' folder.',
  // All
  'no_nick'                   => 'Anonymous',
  'time_seconds'              => ' seconds',
  // Errors
   // 403
   'err_403_a'                => 'Stand right where you are!',
   'err_403_b'                => 'You aren\'t allowed to view this page.',
   // 404
   'err_404_a'                => 'Not found',
   'err_404_b'                => 'The content you were looking for couldn\'t be found or has been removed.',
   // 500
   'err_500_a'                => 'Oh sh**, it crashed!',
   'err_500_b'                => 'The page can\'t be displayed cause the script couldn\'t complete it\'s operation.',
   // 503
   'err_503_a'                => 'Can\'t process request',
   'err_503_b'                => 'Ah... This is such a shame, but I\'m unable to complete your request due to server maintenance or overload.'
 );

?>
