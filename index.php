<?php
 require_once("config.php");
 require_once("beginning.php");
 $noposts = false;
 if ((isset($_GET['report'])) && $reports == false)
 {
  echo "<div class='alert alert-danger mx-auto'>" . $LANG['report_err_disabled'] . "</div>";
 }
 foreach ($server->query("SELECT COUNT(*) FROM " . $credentials['ptable']) as $rows)
 {
 $amount = $rows[0];
 }
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
	   <center><img class='img-thumbnail' src='" . $rows['img'] . "'></center>
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
     <div class='card bg-gradient-dark text-white pb-4' id='comments'>
	    <div class='card-header' id='cheader'>" . (empty($rowscom['nick']) ? "<i>" . $LANG['no_nick'] . "</i>":$rowscom['nick']) . " " . $LANG['comment_after_nick'] . "</div>
	    <div class='card-body'>" . $rowscom['cont'] . "</div>";
      if ( ! empty($rowscom['img']))
      {
       echo "
        <div class='imgcontainer mx-auto'>
         <center><img class='img-thumbnail' src='" . $rowscom['img'] . "' alt='" . $LANG['alt_broken_image'] . "' ></center>
        </div>
   	   </div>";
      }
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
 // Load the Infinite Scroll status indicator
 echo "
  <div class='page-load-status'>
   <div class='infinite-scroll-request alert alert-primary mx-auto'> " . $LANG['is_loading'] . "</div>
   <div class='infinite-scroll-last alert alert-light mx-auto'>" . $LANG['is_lastpage_a'] . "<a href='" . $root . "'>" . $LANG['is_lastpage_b'] . "</a></div>
   <div class='infinite-scroll-error alert alert-danger'>" . $LANG['is_err'] . "</div>
  </div>";
 loadscripts();
 if ( ! $noposts)
 {
  echo "
  <div class='container-fluid fixed-bottom' id='createpost' >
   <form action='" . $root . "/create.php'>
    <button type='submit' class='btn float-right'>
	   <span class='octicon octicon-plus' aria-hidden='true'></span>
    </button>
   </form>
  </div>
  ";
 }
 require_once('footer.php');
?>
