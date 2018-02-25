<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 $test = $server->query("SELECT * FROM " . $credentials['ctable'] . " WHERE pid = " . $_GET['pid']);
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
   $server->query("INSERT INTO `" . $credentials['ctable'] . "` (`pid`, `data`) VALUES (" . $server->quote($_GET['pid']) . ", " . $server->quote($content) . ")");
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
	 <label for='post'>Comment content</label>
	 <input type='text' class='form-control' id='content' name='content'>
	</div>
    <div class='form-group container-fluid sticky-bottom'>
     <button type='submit' class='btn float-right bg-success'>Submit</button>
    </div>
   </form>
  ";
 }
 loadscripts();
 require_once("footer.php");
?>