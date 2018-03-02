<?php
 require_once("head.php");
 if (($_SERVER['REQUEST_URI'] == ((empty($path) ? "/" : $path) . 'install.php?nodb=true')) || ($_SERVER['REQUEST_URI'] == ((empty($path) ? "/" : $path) . 'install.php')))
 {
  $visits = 0;
 }
 else
 {
  require_once("metrics.php");
 }
 echo "
 <body class='mb-5'>
  <div class='page-header'>";
    if ($metrics && $metricsset['visits'] == 'yes')
    {
     echo "<div class='badge badge-primary float-right' id='visits'>" . $LANG['visits'] . ": " . $visits . "</div>";
    }
    if ($langbadge)
    {
     echo "<div class='badge badge-info float-left' id='langbadge'>Language: " . $language . "</div>";
    }
  echo "<br>
    <a href='$root'><h1>$info[title]</h1></a>
  </div>
  ";
?>
