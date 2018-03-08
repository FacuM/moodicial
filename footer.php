<?php
 // Stop measuring the page generation time.
 $etime = microtime(true);
 // Calculate the time taken.
 $time = $etime - $stime;
 echo "
 <footer class='page-footer sticky-bottom' style='background-color: black' id='footer'>
  <hr>
  <div class='footer-copyright'>
   <div class='container-fluid mb-2'>
    " . $LANG['footer_credits_a'] . "<a href='" . $root . "/showastext.php?file=" . (empty($_SERVER['DOCUMENT_URI']) ? 'index.php' : $_SERVER['DOCUMENT_URI']) . "'>" . $LANG['footer_credits_insource'] . "</a>" . $LANG['footer_credits_b'] . "<a href='https://github.com/FacuM/moodicial'>" . $LANG['footer_credits_exsource'] . "</a><span class='octicon octicon-clock float-right'> " . substr($time, 0,5) . $LANG['time_seconds'] . "</span>" . "
   </div>
  </div>
 </footer>
 </body>
</html>
";
?>
