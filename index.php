<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 $noposts = false;
 foreach ($server->query("SELECT COUNT(*) FROM " . $credentials['ptable']) as $rows)
 {
 $amount = $rows[0];
 }
 if ( ! isset($_GET['request']))
 {
  if ( $amount > 0 )
  {
  foreach($server->query("SELECT * FROM " . $credentials["ptable"]) as $rows) {
   echo "<form method=get action=''><input name='report' id='report' type=hidden value='$rows[pid]'><div class='card text-white bg-dark mb-2 mx-auto' style='max-width: 95%' >
   <div class='card-header'>$rows[date]<button class='btn btn-danger float-right btn-sm'>Report</button></form></div>
   <div class='card-body'>$rows[cont]</div>
   <div class='card-footer'>Posted by ";

   if ((isset($rows['nick'])) && (empty($rows['nick'])))
   {
    echo "<i>Anonymous</i>";
   }
   else
   {
  	echo "$rows[nick]";
   }
   echo "
   </div>
  </div></form>";
  }
  }
  else
  {
   $noposts = true;
   echo "
   <div class='alert alert-primary mx-auto' style='width: 90%'>Hey! Seems like no one posted here yet. Would you like to <a href='?request=create'>be the first one?</a></div>
   ";
   }
  if (isset($_GET['report']))
  {
   foreach($server->query("SELECT * FROM `" . $credentials['ptable'] . "` WHERE `pid` = '" . $_GET['report'] . "'") as $rows)
   {
	if ($rows['rep'] > ($maxrep - 1))
	{
	 $server->query("DELETE FROM `" . $credentials['ptable'] . "` WHERE `pid` = " . $_GET['report']);
	}
	else
	{
     $server->query("UPDATE `" . $credentials['ptable'] . "` SET `rep`=rep+1 WHERE `pid` = '" . $_GET['report'] . "'"); 
    }
   }
//   header("location: index.php");
  }
 }
 else
 {
  if ($_GET['request'] == 'create')
  {
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
	$server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`) VALUES (" . $server->quote($_POST['nick']) . ", '" . $now['year'] . "-" . $now['mon'] . "-" . $now['mday'] . "', '" . $rndn . "', " . $server->quote($content) . ", 0)");
	echo "<script type='text/javascript'>
     window.location = '$root';
    </script>";
    }
   }
   else
   {
   echo "
   <form method=post action='' >
    <div class='form-group mx-auto' style='max-width: 80%'>
	 <label for='post'>Post content</label>
	 <input type='text' class='form-control' id='content' name='content'>
	</div>
	<div class='form-group mx-auto' style='max-width: 80%'>
	 <label for='nick' style='max-width: 15%'>Nick</label>
	 <input type='text' class='form-control' id='nick' name='nick' style='max-width: 15%' maxlength=16>
    </div>
    <div class='container-fluid sticky-bottom' style='max-width: 80%'>
     <button type='submit' class='btn float-right bg-success'>Submit</button>
    </div>
   </form>
   ";
   }
  }
 }
 loadscripts();
 if ((( ! isset($_GET['request'])) || ( ! $_GET['request'] == 'create')) && ( ! $noposts))
 {
  echo "
  <div class='container-fluid fixed-bottom mb-3'>
   <form method=get action='' >
    <input name='request' id='request' type=hidden value='create'>
    <button type='submit' class='btn float-right'>
	 <span class='octicon octicon-plus' aria-hidden='true'></span>
	</button>
   </form>
  </div>
  ";
 }
 echo "
 <footer class='page-footer mb-2 fixed-bottom' >
  <hr style='background-color: grey'>
  <div class='footer-copyright'>
   <div class='container-fluid'>
    Powered by Moodicial, written by Facundo Montero using Bootstrap. Check the <a href='" . $root . "/showastext.php?file=";
    if (empty($_SERVER['DOCUMENT_URI']))
    {
     echo 'index.php';
    }
    else
    {
     echo $_SERVER['DOCUMENT_URI'];
    }
    echo "'>source.</a>
   </div>
  </div>
 </footer>
 </body>
</html>
";
?>