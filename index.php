<?php
 require_once("config.php");
 require_once("beginning.php");
 $noposts = false;
 if ((isset($_GET['report'])) && $reports == false)
 {
  echo "<div class='alert alert-danger mx-auto'>" . $LANG['report_err_disabled'] . "</div>";
 }
 foreach ($server->query("SELECT COUNT(*) AS total FROM " . $credentials['ptable']) as $rows)
 {
 $amount = $rows['total'];
 }
  if ( $amount > 0 )
  {
   if (isset($_GET['p']))
   {
    $p = $_GET['p'];
   }
   else
   {
    $p = 1;
   }
   foreach($server->query("SELECT * FROM " . $credentials["ptable"] . " ORDER BY date DESC LIMIT " . ($p - 1) . $amountpage) as $rows) {
    echo "<div class='posts' id='" . $rows['pid'] . "'>
     " . ($reports ? "<form method=get action='" . $root . "'><input name='report' type=hidden value='$rows[pid]'>" : "") . "<div class='card text-white bg-dark mb-2 mx-auto' >";
     if ($reports)
	 {
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
	 }
     echo "<div class='card-header'>$rows[date]" . ($reports ? "<button class='btn btn-danger float-right btn-sm'>" . $LANG['report_button'] . "</button><span class='badge $status float-right'>" . $rows['rep'] . "/" . $maxrep . "</span>" : "") . "</div>
     " . ($reports ? "</form>" : "") . "
     <div class='card-body'>$rows[cont]";
	 if ( ! empty($rows['img']))
	 {
      echo "
	  <div class='imgcontainer mx-auto'>
	   <img class='img-thumbnail' src='" . $rows['img'] . "' alt='" . $LANG['alt_broken_image'] . "'>
	  </div>";
	 }
	 echo "
	 </div>
     <div class='card-footer'>" . $LANG['posted_by'];

    if ((isset($rows['nick'])) && (empty($rows['nick'])))
    {
     echo "<i>" . $LANG['no_nick'] . "</i>";
    }
    else
    {
   	echo "$rows[nick]";
    }
    echo "<a href='comment.php?pid=$rows[pid]' class='float-right'><span class='octicon octicon-comment-discussion'></span> " . $LANG['comment_button_create'] . "</a>
      </div>
	   ";
	   foreach($server->query("SELECT * FROM " . $credentials["ctable"] . " WHERE pid = " . $rows['pid']) as $rowscom)
	   {
	   echo "
     <div class='comments card bg-gradient-dark text-white pb-4'>
	    <div class='cheader card-header'>" . (empty($rowscom['nick']) ? "<i>" . $LANG['no_nick'] . "</i>":$rowscom['nick']) . " " . $LANG['comment_after_nick'] . "</div>
	    <div class='card-body'>" . $rowscom['cont'] . "</div>";
      if ( ! empty($rowscom['img']))
      {
       echo "
        <div class='imgcontainer mx-auto'>
         <img class='img-thumbnail' src='" . $rowscom['img'] . "' alt='" . $LANG['alt_broken_image'] . "' >
        </div>
   	   </div>";
      }
	   }
	 echo "
	  </div>
   </div>
  </div>";
   }
  }
  else
  {
   $noposts = true;
   echo "
   <div class='alert alert-primary mx-auto'>" . $LANG['no_data_a'] . "<a href='/create.php'>" . $LANG['no_data_b'] . "</a></div>
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
 // Pass the divs that will show the loading status of the infinite scrolling mechanism (mimics IS behavior).
 echo "
  <div class='page-load-status'>
   <div class='alert alert-primary mx-auto' id='load'> " . $LANG['is_loading'] . "</div>
   <div class='alert alert-light mx-auto' id='end'>" . $LANG['is_lastpage_a'] . "<a href='#' onclick='gotop()'>" . $LANG['is_lastpage_b'] . "</a></div>
  </div>";
 loadscripts();
 if (isset($_GET['report']))
 {
  echo  "
  <script>
   window.location = '" . $root . "';
  </script>
  ";
 }
 if ( ! $noposts)
 {
  echo "
   <form action='" . $root . "/create.php'>
    <button type='submit' class='btn float-right sidebarbtns fixed-bottom' id='createpost' >
	   <span class='octicon octicon-plus' aria-hidden='true'></span>
    </button>
   </form>
   <button class='btn float-right sidebarbtns fixed-bottom' onclick='gotop()' id='gotop' >
	   <span class='octicon octicon-chevron-up' aria-hidden='true'></span>
   </button>
  ";
 }
 echo "
  <script>
  var amountpage = " . $amountpage . ";
  var offset = " . $offset . ";
  var atime = " . $atime . ";
  var atimeb = " . $atimeb . ";
  var dynloadint = " . $dynloadint . ";
  </script>
  <script src='resources/scripts/extras.js'></script>
 ";
 require_once('footer.php');
?>
