<?php
require_once("config.php");
if ($maintenance)
{
 header('location: ' . $root);
}
session_start();
if (isset($_SESSION['lastinteraction']))
{
  $time = microtime(true) -  $_SESSION['lastinteraction'];
}
if (isset($_SESSION['lastinteraction']) && $time < $throttletime / 1000)
{
  die('Limited');
}
else
{
  // Handle post creation if POST data has been sent to the server
  if (isset($_POST))
  {
    $_SESSION['lastinteraction'] = microtime(true);
    $rndn = rand();
    $block = $server->query("SELECT * FROM `" . $credentials["ptable"] . "` WHERE `pid` = '" . $rndn . "'");
    $count = $block->rowCount();
    if ($count > 0)
    {
      while ($count > 0)
      {
        $rndn = rand();
        $block = $server->query("SELECT * FROM `" . $credentials["ptable"] . "` WHERE `pid` = '" . $rndn . "'");
        $count = $block->rowCount();
      }
    }
    if (isset($_FILES['file']) && $allowuploads)
    {
      $target = 'uploads/' . $rndn;
      move_uploaded_file($_FILES['file']['tmp_name'], $target);
      $image = $root . '/' . $target;
    }
    else
    {
      $image = $_POST['image'];
    }
    $content = strip_tags($_POST['content']);
    $server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`, `img`, `up`, `down`) VALUES (" . $server->quote($_POST['nick']) . ", now(), '" . $rndn . "', " . $server->quote($content) . ", 0, " . (!@getimagesize($image) ? "''" : $server->quote($image)) . ", 0, 0)");
  }
}
?>
