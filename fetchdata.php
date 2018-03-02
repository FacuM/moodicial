<?php

require_once("config.php");
$noformat = true;
require_once("head.php");

$oldpid = (isset($_GET['oldpid']) ? $_GET['oldpid'] : NULL);

foreach ($server->query("SELECT * FROM " . $credentials['ptable'] . " ORDER BY date DESC LIMIT " . ($_GET['row'] == 'new' ? 0 : $_GET['row']) . ', ' . 1) as $rows)
{
  $newpid = $rows['pid'];
  if (!($_GET['row'] == 'new') || !($newpid == $oldpid))
  {
    echo "<div class='posts' id='" . $rows['pid'] . "'>
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

?>
