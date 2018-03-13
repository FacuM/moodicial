<?php
 require_once("config.php");
 $loading = true;
 // Receive AJAX requests for availability checking.
 if (isset($_POST['testav']) && $_POST['testav'] == true)
 {
  if ($maintenance)
  {
   die('no');
  }
  else
  {
   die('yes');
  }
 }
 require_once("beginning.php");
 echo "
 <p class='mx-auto' id='loader'>" . $LANG['is_loading'] . "</p>
 <div class='fixed-bottom' id='pbarc'>
  <div class='progress'>
   <div class='progress-bar progress-bar-striped progress-bar-animated'>
   </div>
  </div>
 </div>
 <script src='resources/scripts/loadindex.js?v=12'></script>
 <noscript>
  <form action='main.php'>
   <button class='fixed-bottom btn btn-primary' id='nojs'>" . $LANG['ui_nojs'] . "</button>
  </form>
 </noscript>
 ";
?>
