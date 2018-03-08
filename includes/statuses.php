<?php
 // Pass the divs that will show the loading status of the infinite scrolling mechanism (mimics IS behavior).
 echo
 "
  <div class='page-load-status'>
   <div class='alert alert-primary mx-auto' id='load'> " . $LANG['is_loading'] . "</div>
   <div class='alert alert-light mx-auto' id='end'>" . $LANG['is_lastpage_a'] . "<a href='#' onclick='gotop()'>" . $LANG['is_lastpage_b'] . "</a></div>
  </div>
 ";
?>