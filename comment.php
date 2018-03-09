<?php
 require_once("config.php");
 require_once("beginning.php");
 if (isset($_POST['pid']))
 {
  $pid = $server->quote($_POST['pid']);
 }
 if (isset($_POST['content']))
 {
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
   $server->query("INSERT INTO `" . $credentials['ctable'] . "` (`nick`, `date`, `pid`, `cont`, `img`) VALUES (" . $nick . ", now(), " . $pid . ", " . $server->quote($content) . ", " . (!@getimagesize($server->quote($_POST['image'])) ? "''" : $server->quote($_POST['image'])) . ")");
   echo "
    <script type='text/javascript'>
     window.location = '$root';
    </script>"
   ;
  }
 }
 else
 {
  echo "<script>
   window.location = '$root';
  </script>";
 }
 require_once("footer.php");
?>
