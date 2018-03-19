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
 <body>";
 // Initialize the scripting (JS).
 require_once("includes/scripts_init.php");
 if (isset($_POST['loading']) && $_POST['loading'])
 {
 echo "
  <div class='page-header'>";
    if ($metrics && $metricsset['visits'] == 'yes')
    {
     echo "<div class='badge badge-primary float-right' id='visits'>" . $LANG['visits'] . ": " . $visits . "</div>";
    }
    if ($langbadge)
    {
     echo "<div class='badge badge-info float-left' id='langbadge'>" . $LANG['langbadge'] . ": <span id='lang'>" . $language . "</span></div>";
    }
  }
  echo "<br><br>
    <a " . (isset($hide) && $hide ? "class='jsrq'" : "") . " href='#' onclick='delreload()'><h1 id='title'>$info[title]</h1></a>
    <noscript><a href='" . $root . "'><h1 id='title'>$info[title]</h1></a></noscript>
  <br>
  "
  ;
?>
