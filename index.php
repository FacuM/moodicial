<?php
 require_once("config.php");
 $loading = true;
 require_once("beginning.php");
 echo "
 <p class='mx-auto' id='loader'>" . $LANG['is_loading'] . "</p>
 <div class='fixed-bottom' id='pbarc'>
  <div class='progress'>
   <div class='progress-bar'>
   </div>
  </div>
 </div>
 <script src='resources/scripts/loadindex.js' onload='loader()'></script>
 ";
?>
