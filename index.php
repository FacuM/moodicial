<?php
 require_once("config.php");
 require_once("beginning.php");
 echo "
 <div class='fixed-bottom' id='pbarc'>
  <p>" . $LANG['is_loading'] . "</p>
  <div class='progress'>
   <div class='progress-bar'>
   </div>
  </div>
 </div>
 <script src='resources/scripts/loadindex.js' onload='loader()'></script>
 ";
?>