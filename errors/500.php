<?php
 require_once("../config.php");
 require_once("../beginning.php");
 echo '
 <div class="jumbotron mx-auto">
  <h1 class="display-4 text-left">' . $LANG['err_500_a'] . '</h1>
  <p class="lead">' . $LANG['err_500_b'] . '</p>
  <hr class="my-4">
  ';
 require_once("goback.php");
 echo '
 <small>HTTP code: <b>500 - Internal server error</b></small>
 </div>
 ';
 require_once("../footer.php");
?>
