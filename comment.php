<?php
 require_once("config.php");
 require_once("beginning.php");
 if (isset($_GET['pid']))
 {
  $pid = $server->quote($_GET['pid']);
 }
 elseif (isset($_POST['pid']))
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
   $content = str_replace('<', '&lt;', $_POST['content']);
   $content = str_replace('>', '&gt;', $content);
   if (isset($_POST['nick']))
   {
    $nick = $server->quote($_POST['nick']);
   }
   else
   {
    $nick = '';
   }
   $server->query("INSERT INTO `" . $credentials['ctable'] . "` (`nick`, `date`, `pid`, `cont`, `img`) VALUES (" . $nick . ", now(), " . $pid . ", " . $server->quote($content) . ", " . $server->quote($_POST['image']) . ")");
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
