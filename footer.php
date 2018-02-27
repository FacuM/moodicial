<?php
 echo "
 <footer class='page-footer fixed-bottom' style='background-color: black'>
  <hr>
  <div class='footer-copyright'>
   <div class='container-fluid mb-2'>
    " . $LANG['footer_credits_a'] . "<a href='" . $root . "/showastext.php?file=";
    if (empty($_SERVER['DOCUMENT_URI']))
    {
     echo 'index.php';
    }
    else
    {
     echo $_SERVER['DOCUMENT_URI'];
    }
    echo "'>" . $LANG['footer_credits_insource'] . "</a>" . $LANG['footer_credits_b'] . "<a href='https://github.com/FacuM/moodicial'>" . $LANG['footer_credits_exsource'] . "</a>.
   </div>
  </div>
 </footer>
 </body>
</html>
";
?>
