<?php
// Just the posts' arrays processor, Rowy :3.
$newpid = $rows['pid'];
if (!($row == 'new') || !($newpid == $oldpid))
  {
    echo "<div class='posts' id='" . $rows['pid'] . "'>
    <div class='card text-white bg-dark mb-2 mx-auto' >";
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
    echo "<div class='card-header'>$rows[date]" . ($reports ? "<button class='btn btn-danger float-right btn-sm' onclick='report(" . $rows['pid'] . ")'>" . $LANG['report_button'] . "</button><span class='badge $status float-right'>" . $rows['rep'] . "/" . $maxrep . "</span>" : "") . ($thumbsmod ? "<button class='btn btn-sm float-right btn-dark'><span class='octicon octicon-thumbsdown'></span></button><button class='btn btn-sm float-right btn-dark'><span class='octicon octicon-thumbsup'></span></button>" : "") . "</div>
    <div class='card-body " . $rows['pid'] . "'>$rows[cont]";
    if ( ! empty($rows['img']))
    {
      echo "<div class='imgcontainer mx-auto'><img class='img-thumbnail' src='" . $rows['img'] . "' alt='" . $LANG['alt_broken_image'] . "' onerror='imgerr(" . $rows['pid'] . ")'>
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
    echo "<a href='#' class='float-right' onclick='comment(" . $rows['pid'] . ")'><span class='octicon octicon-comment-discussion'></span> " . $LANG['comment_button_create'] . "</a>
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
        echo "<div class='imgcontainer mx-auto'><img class='img-thumbnail' src='" . $rowscom['img'] . "' alt='" . $LANG['alt_broken_image'] . "'></div>";
      }
    }
    echo "
       </div>
      </div>
     </div>
    </div>";
  }
 ?>
