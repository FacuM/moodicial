<?php
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 $noposts = false;
 if ((isset($_GET['report'])) && $reports == false)
 {
  echo "<div class='alert alert-danger mx-auto'>Reporting has been disabled by the site owner.</div>";
 }
 foreach ($server->query("SELECT COUNT(*) FROM " . $credentials['ptable']) as $rows)
 {
 $amount = $rows[0];
 }
 if ( ! isset($_GET['request']))
 {
  if ( $amount > 0 )
  {
   if (isset($_GET['p']))
   {
    $p = $_GET['p'];
   }
   else
   {
    $p = 0;
   }
   foreach($server->query("SELECT * FROM " . $credentials["ptable"] . " ORDER BY date DESC LIMIT " . $p . ", 1") as $rows) {
    echo "<div class='posts'>
     " . ($reports ? "<form method=get action=''><input name='report' type=hidden value='$rows[pid]'>" : "") . "<div class='card text-white bg-dark mb-2 mx-auto' >";
	 if ($rows['rep'] == 0)
	 {
	  $status = 'badge-success';
	 }
	 else
	 {
	  if ($rows['rep'] <= ($maxrep / 2))
	  {
	   $status = 'badge-warning';
	  }
	  else
	  {
	   $status = 'badge-danger';
	  }
	 }
     echo "<div class='card-header'>$rows[date]" . ($reports ? "<button class='btn btn-danger float-right btn-sm'>Report</button><span class='badge $status float-right'>" . $rows['rep'] . "/" . $maxrep . "</span>" : "") . "</div>
     " . ($reports ? "</form>" : "") . "
     <div class='card-body'>$rows[cont]";
	 if ( ! empty($rows['img'])) 
	 {
      echo "
	  <div class='imgcontainer mx-auto'>
	   <img class='img-thumbnail' src='" . $rows['img'] . "'>
	  </div>";
	 }
	 echo "
	 </div>
     <div class='card-footer'>Posted by ";

    if ((isset($rows['nick'])) && (empty($rows['nick'])))
    {
     echo "<i>Anonymous</i>";
    }
    else
    {
   	echo "$rows[nick]";
    }
    echo "<a href='comment.php?pid=$rows[pid]' class='float-right'><span class='octicon octicon-comment-discussion'> Comment</span></a>
      </div>
	   ";
	   foreach($server->query("SELECT * FROM " . $credentials["ctable"] . " WHERE pid = " . $rows['pid']) as $rowscom)
	   {
	   echo "<div class='card bg-gradient-dark text-white' id='comments'>
	   <div class='card-header' id='cheader'><i>Anonymous</i> said...</div>
	   <div class='card-body'>" . $rowscom['data'] . "</div>
	  </div>";
	   }
	 echo "
	 </div>
   </div>";
   }
  }
  else
  {
   $noposts = true;
   echo "
   <div class='alert alert-primary mx-auto'>Hey! Seems like no one posted here yet. Would you like to <a href='?request=create'>be the first one?</a></div>
   ";
   }
  if ((isset($_GET['report'])) && $reports)
  {
   foreach($server->query("SELECT * FROM `" . $credentials['ptable'] . "` WHERE `pid` = " . $server->quote($_GET['report'])) as $rows)
   {
	if ($rows['rep'] > ($maxrep - 1))
	{
	 $server->query("DELETE FROM `" . $credentials['ptable'] . "` WHERE `pid` = " . $server->quote($_GET['report']));
	}
	else
	{
     $server->query("UPDATE `" . $credentials['ptable'] . "` SET `rep`=rep+1 WHERE `pid` = " . $server->quote($_GET['report'])); 
    }
   }
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
	echo "INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`, `img`) VALUES (" . $server->quote($_POST['nick']) . ", now(), '" . $rndn . "', " . $server->quote($content) . ", 0, " . $server->quote($_POST['image']) . ")";
	$server->query("INSERT INTO `" . $credentials['ptable'] . "` (`nick`, `date`, `pid`, `cont`, `rep`, `img`) VALUES (" . $server->quote($_POST['nick']) . ", now(), '" . $rndn . "', " . $server->quote($content) . ", 0, " . $server->quote($_POST['image']) . ")");
	echo "<script type='text/javascript'>
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
   </form>
   ";
   }
  }
 }
 loadscripts();
 if ((( ! isset($_GET['request'])) || ( ! $_GET['request'] == 'create')) && ( ! $noposts))
 {
  echo "
  <div class='container-fluid fixed-bottom' style='max-width: 95%; padding-bottom: 5em' >
   <form method=get action='' >
    <input name='request' id='request' type=hidden value='create'>
    <button type='submit' class='btn float-right'>
	 <span class='octicon octicon-plus' aria-hidden='true'></span>
	</button>
   </form>
  </div>
  ";
 }
 require_once("footer.php");
?>