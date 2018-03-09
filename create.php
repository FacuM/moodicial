<?php
 require_once("config.php");
 require_once("beginning.php");
 // Handle post creation if POST data has been sent to the server
 if (isset($_POST['content']))
 {
  if (empty($_POST['content']) && $allowempty == false)
  /* If $allowempty is set to 'false' in 'config.php', even while there is POST data present, the operation will be rejected if no content has been sent and the
  user will be redirected to the home. If true, the post will succeed. */
  {
   echo "
    <script type='text/javascript'>
     window.location = '$root';
    </script>"
   ;
  }
  else
  {
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
   $content = str_replace('<', '&lt;', $_POST['content']);
   $content = str_replace('>', '&gt;', $content);
   $server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`, `img`) VALUES (" . $server->quote($_POST['nick']) . ", now(), '" . $rndn . "', " . $server->quote($content) . ", 0, " . (!@getimagesize($server->quote($_POST['image'])) ? "''" : $server->quote($_POST['image'])) . ")");
   echo "
    <script type='text/javascript'>
     window.location = '$root';
    </script>"
   ;
  }
 }
 require_once("footer.php");
?>
