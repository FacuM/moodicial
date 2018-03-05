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
 /* If not, show a form where to write create one. The form will send the data using POST, then,
 the next time the file is processed, the previous condition will be true.*/
 echo "
  <form method=post action='' >
    <div class='form-group mx-auto'>
    <label for='post'>" . $LANG['post_content_label'] . "</label>
    <input type='text' class='form-control' name='content'>
   </div>
   <div class='form-group mx-auto'>
    <label class='nick' for='nick'>" . $LANG['nick_label'] . "</label>
    <input class='nick form-control' type='text' name='nick' maxlength=16 placeholder='" . $LANG['no_nick'] . "'>
   </div>
   <div class='form-group mx-auto'>
    <label class='image' for='image'>" . $LANG['image_url_label'] . "</label>
    <input class='image form-control' type='text' name='image'>
   </div>
   <div class='form-group container-fluid sticky-bottom'>
    <button type='submit' class='btn float-right bg-success'>" . $LANG['forms_button_submit'] . "</button>
   </div>
  </form>"
 ;
 }
 require_once("footer.php");
?>
