<?php
 require_once("head.php");
 if (!$_SERVER['REQUEST_URI'] == $path . 'install.php?nodb=true' || !$_SERVER['REQUEST_URI'] == $path . 'install.php')
 {
  require_once("metrics.php");
 }
 else
 {
  $visits = 0;
  }
 echo "
 <body class='mb-5'>
  <div class='page-header'>";
    if ($metrics && $metricsset['visits'] == 'yes')
    {
     echo "<div class='badge badge-primary float-right' id='visits'>" . $LANG['visits'] . ": " . $visits . "</div><br>";
    }
  echo "
    <a href='$root'><center><h1>$info[title]</h1></center></a>
  </div>
  ";
?>
