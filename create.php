<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 if (isset($_POST['content']))
 {
  if (empty($_POST['content']))
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
   $now = getdate();
   $content = str_replace('<', '&lt;', $_POST['content']);
   $content = str_replace('>', '&gt;', $content);
   $server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`, `img`) VALUES (" . $server->quote($_POST['nick']) . ", now(), '" . $rndn . "', " . $server->quote($content) . ", 0, " . $server->quote($_POST['image']) . ")");
   echo "
    <script type='text/javascript'>
     window.location = '$root';
    </script>"
   ;
  }
 }
 else
 {
 echo "
  <form method=post action='' >
    <div class='form-group mx-auto'>
    <label for='post'>Post content</label>
    <input type='text' class='form-control' name='content'>
   </div>
   <div class='form-group mx-auto'>
    <label class='nick' for='nick'>Nick (optional)</label>
    <input class='nick form-control' type='text' name='nick' maxlength=16 placeholder='Anonymous'>
   </div>
   <div class='form-group mx-auto'>
    <label class='image' for='image'>Image URL (optional)</label>
    <input class='image form-control' type='text' name='image'>
   </div>
   <div class='form-group container-fluid sticky-bottom'>
    <button type='submit' class='btn float-right bg-success'>Submit</button>
   </div>
  </form>"
 ;
 }
 loadscripts();
 require_once("footer.php");
?>
