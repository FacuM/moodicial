<?php
 echo "
 <footer class='page-footer fixed-bottom' style='background-color: black'>
  <hr>
  <div class='footer-copyright'>
   <div class='container-fluid mb-2'>
    " . $LANG['footer_credits_a'] . "<a href='" . $root . "/showastext.php?file=" . (empty($_SERVER['DOCUMENT_URI']) ? 'index.php' : $_SERVER['DOCUMENT_URI']) . "'>" . $LANG['footer_credits_insource'] . "</a>" . $LANG['footer_credits_b'] . "<a href='https://github.com/FacuM/moodicial'>" . $LANG['footer_credits_exsource'] . "</a>.
   </div>
  </div>
 </footer>
 </body>
</html>
";
?>
