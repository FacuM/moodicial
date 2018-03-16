<?php
 require_once("config.php");
 if ($maintenance)
 {
  header('location: ' . $root);
 }
 $loading = false;
 require_once("beginning.php");
 if (isset($outdated))
 {
  echo "<div class='alert alert-danger mx-auto'>The requested language is outdated as it contains " . $outdated . " strings and " . $minstr . " were expected, falling back to English (US). Please ask it's maintainer (" . $author . ") to update it.</div>";
 }
 require_once("includes/warn_nojs.php");
 require_once("includes/custreader.php");
 // At first, assume that at least one post will be present.
 $noposts = false;
 // Define the variable that'll make the page reload if it's the first time posting.
 echo "
 <script>
  var firstpost = false;
 </script>"
 ;
 if (isset($_GET['reporterr']) && $_GET['reporterr'])
 {
  echo "<div class='alert alert-danger mx-auto'>" . $LANG['report_err_disabled'] . "</div>";
 }
 $amount = $server->query("SELECT COUNT(pid) AS total FROM " . $credentials['ptable'])->fetch()['total'];
  if ( $amount > 0 )
  {
   require_once("includes/getposts.php");
  }
  else
  {
   $noposts = true;
   echo "
   <div class='alert alert-primary mx-auto'>" . $LANG['no_data_a'] . "<a href='#' data-toggle='modal' data-target='.cpdlg'>" . $LANG['no_data_b'] . "</a></div>
   <script>
    var firstpost = true;
   </script>
   ";
   }
 if (isset($_GET['report']))
 {
  echo  "
  <script>
   window.location = '" . $root . "';
  </script>
  ";
 }
 // Load the post modals.
 require_once("includes/postmodal.php");
 // Load the scripting (JS).
 require_once("includes/scripts_load.php");
 // If posts are present, load the sidebar.
 if ( ! $noposts)
 {
  require_once("includes/sidebar.php");
  // Pass the divs that will show the loading status of the infinite scrolling mechanism (mimics IS behavior).
  require_once("includes/statuses.php");
  // Call 'sendLoader' for dynamic loading and other non-crucial JS (animations, dynamic loading, etc.).
  sendLoader();
 }
 require_once("includes/nojs_nav.php");
 require_once('footer.php');
?>
