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
  if (isset($_POST['pid']))
  {
    $pid = $server->quote($_POST['pid']);
  }
  if (isset($_POST['content']))
  {
    $_SESSION['lastinteraction'] = microtime(true);
    if (empty($_POST['content']))
    {
      echo "
      <script type='text/javascript'>
      window.location = '$root';
      </script>";
    }
    else
    {
      $content = strip_tags($_POST['content']);
      if (isset($_POST['nick']))
      {
        $nick = $server->quote($_POST['nick']);
      }
      else
      {
        $nick = '';
      }
      if (isset($_FILES['file']) && $allowuploads)
      {
        $target = 'uploads/' . $_POST['pid'];
        $final = $target . rand();
        if(FALSE === file_exists($final))
        {
         move_uploaded_file($_FILES['file']['tmp_name'], $final);
        }
        else
        {
         $final = $target . rand();
         while (file_exists($final)) {
          $final = $target . rand();
         }
         move_uploaded_file($_FILES['file']['tmp_name'], $final);
        }
        $image = $root . '/' . $final;
      }
      else
      {
        $image = $_POST['image'];
      }
      $server->query("INSERT INTO `" . $credentials['ctable'] . "` (`nick`, `date`, `pid`, `cont`, `img`) VALUES (" . $nick . ", now(), " . $pid . ", " . $server->quote($content) . ", " . (!@getimagesize($image) ? "''" : $server->quote($image)) . ")");
    }
  }
  else
  {
    echo "<script>
    window.location = '$root';
    </script>";
  }
}
?>
