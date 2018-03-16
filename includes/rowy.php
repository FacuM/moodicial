<?php
// Just the posts' arrays processor, Rowy :3.


/* NOTE: The class 'jsrq' is attached to the HTML elements
that would require Javascript in order to work properly. */

$newpid = $rows['pid'];
if (!($row == 'new') || !($newpid == $oldpid))
  {
    echo "<div class='posts' id='" . $rows['pid'] . "'>
    <div class='card text-white bg-dark mb-2 mx-auto' >";
    if ($reports)
    {
      if ($rows['rep'] <= ($maxrep / 2))
      {
        $status = 'badge-success';
      }
      else
      {
        if ($rows['rep'] >= ($maxrep / 2) && $rows['rep'] <= ($maxrep - ($maxrep / 3)))
        {
          $status = 'badge-warning';
        }
        else
        {
          $status = 'badge-danger';
        }
      }
    }
    echo "<div class='card-header'>$rows[date]" . ($reports ? "<button class='btn btn-danger float-right btn-sm jsrq' onclick='report(" . $rows['pid'] . ")'>" . $LANG['report_button'] . "</button><span class='badge $status float-right rbg jsrq'>" . $rows['rep'] . "/" . $maxrep . "</span>" : "") .
    ($thumbsmod ? "<div class='thumbs jsrq'><div class='badge badge-secondary up'>" . $rows['up'] . "</div><button class='btn btn-sm btn-dark' onclick='react(true, " . $rows['pid'] . ")'><span class='octicon octicon-thumbsup'></span></button><button class='btn btn-sm btn-dark' onclick='react(false, " . $rows['pid'] . ")'><span class='octicon octicon-thumbsdown'></span></button><div class='badge badge-secondary down'>" . $rows['down'] . "</div></div>" : "") . "</div>
    <div class='card-body " . $rows['pid'] . "'>$rows[cont]";
    if ( ! empty($rows['img']))
    {
      echo "<div class='imgcontainer mx-auto'><img class='img-thumbnail' src='" . $rows['img'] . "' alt='" . $LANG['alt_broken_image'] . "' onerror='imgerr(" . $rows['pid'] . ")' />
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
    echo "<a href='#' class='float-right jsrq' onclick='comment(" . $rows['pid'] . ")'><span class='octicon octicon-comment-discussion'></span> " . $LANG['comment_button_create'] . "</a>
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
        echo "<div class='imgcontainer mx-auto'><img class='img-thumbnail' src='" . $rowscom['img'] . "' alt='" . $LANG['alt_broken_image'] . "' /></div>";
      }
      echo "</div>";
    }
    echo "
     </div>
    </div>";
  }
 ?>
