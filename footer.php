<?php
 echo "
 <footer class='page-footer fixed-bottom' style='background-color: black'>
  <hr>
  <div class='footer-copyright'>
   <div class='container-fluid mb-2'>
    Powered by Moodicial, written by Facundo Montero using Bootstrap. Check the <a href='" . $root . "/showastext.php?file=";
    if (empty($_SERVER['DOCUMENT_URI']))
    {
     echo 'index.php';
    }
    else
    {
     echo $_SERVER['DOCUMENT_URI'];
    }
    echo "'>source of this file</a> or take a look at the <a href='https://github.com/FacuM/moodicial'>full repo</a>.
   </div>
  </div>
 </footer>
 </body>
</html>
";
?>
