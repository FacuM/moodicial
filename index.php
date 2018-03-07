<?php
 require_once("config.php");
 require_once("beginning.php");
 $noposts = false;
 if (isset($_GET['reporterr']) && $_GET['reporterr'])
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
     echo "<div class='card-header'>$rows[date]" . ($reports ? "<button class='btn btn-danger float-right btn-sm' type='button' onclick='report(" . $rows['pid'] . ")'>" . $LANG['report_button'] . "</button><span class='badge $status float-right' id='rid" . $rows['pid'] . "'>" . $rows['rep'] . "/" . $maxrep . "</span>" : "") . "</div>
     <div class='card-body $rows[pid]'>$rows[cont]";
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
    echo "<a href='#' onclick='comment(" . $rows['pid'] . ")' class='float-right'><span class='octicon octicon-comment-discussion'></span> " . $LANG['comment_button_create'] . "</a>
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
        </div>";
      }
	   }
	 echo "</div>
	   </div>
    </div>
   </div>
  </div>
  ";
   }
  }
  else
  {
   $noposts = true;
   echo "
   <div class='alert alert-primary mx-auto'>" . $LANG['no_data_a'] . "<a href='#' data-toggle='modal' data-target='.cpdlg'>" . $LANG['no_data_b'] . "</a></div>
   ";
   }
 // Pass the divs that will show the loading status of the infinite scrolling mechanism (mimics IS behavior).
 echo "
  <div class='page-load-status'>
   <div class='alert alert-primary mx-auto' id='load'> " . $LANG['is_loading'] . "</div>
   <div class='alert alert-light mx-auto' id='end'>" . $LANG['is_lastpage_a'] . "<a href='#' onclick='gotop()'>" . $LANG['is_lastpage_b'] . "</a></div>
  </div>";
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
  <button type='submit' class='btn float-right sidebarbtns fixed-bottom' data-toggle='modal' data-target='.cpdlg' id='createpost' >
    <span class='octicon octicon-plus' aria-hidden='true'></span>
  </button>
  <button class='btn float-right sidebarbtns fixed-bottom' onclick='gotop()' id='gotop' >
    <span class='octicon octicon-chevron-up' aria-hidden='true'></span>
  </button>
  <div class='modal fade ccdlg' tabindex=-1 role='dialog' arialabelledby='commentpostdialog' aria-hidden='true'>
   <div class='modal-dialog modal-dialog-centered modal-lg'>
    <div class='modal-content'>
     <div class='modal-header'>
      <h5 class='modal-title'>"
      . $LANG['comment_button_create'] .
      "</h5>
     </div>
     <div class='modal-body'>
      <div class='form-group mx-auto'>
       <label for='post'>" . $LANG['comment_content_label'] . "</label>
       <br>
       <small>\"<span id='pcontent'></span>\"</small>
       <textarea type='text' class='form-control' id='contentc' name='content'></textarea>
      </div>
      <div class='form-group mx-auto'>
       <label class='nick' for='nick'>" . $LANG['nick_label'] . "</label>
       <input class='nick form-control' type='text' id='nickc' name='nick' maxlength=16 placeholder='" . $LANG['no_nick'] . "'>
      </div>
      <div class='form-group mx-auto'>
       <label class='image' for='image'>" . $LANG['image_url_label'] . "</label>
       <input class='image form-control' type='text' id='imagec' name='image'>
      </div>
      <div class='modal-footer'>
       <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
       <button type='button' class='btn btn-primary' id='submitc'>" . $LANG['forms_button_submit'] . "</button>
      </div>
    </div>
   </div>
  </div>
 </div>
  ";
  sendLoader();
 }
 echo "
   <div class='modal fade cpdlg' tabindex=-1 role='dialog' arialabelledby='createpostdialog' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered modal-lg'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title'>"
            . $LANG['post_content_label'] .
            "</h5>
          </div>
          <div class='modal-body'>
              <div class='form-group mx-auto'>
                <label for='post'>" . $LANG['post_content_label'] . "</label>
                <textarea type='text' class='form-control' name='content' id='content'></textarea>
              </div>
              <div class='form-group mx-auto'>
                <label class='nick' for='nick'>" . $LANG['nick_label'] . "</label>
                <input class='nick form-control' type='text' name='nick' id='nick' maxlength=16 placeholder='" . $LANG['no_nick'] . "'>
              </div>
              <div class='form-group mx-auto'>
                <label class='image' for='image'>" . $LANG['image_url_label'] . "</label>
                <input class='image form-control' type='text' name='image' id='image'>
              </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
            <button type='button' class='btn btn-primary' id='submitp'>" . $LANG['forms_button_submit'] . "</button>
        </div>
      </div>
    </div>
  </div>
  <script>
     var amountpage = " . $amountpage . ";
     var offset = " . $offset . ";
     var atime = " . $atime . ";
     var atimeb = " . $atimeb . ";
     var dynloadint = " . $dynloadint . ";
     var hint = '" . $LANG['langbadge_hint'] . "';
     var maxrep = " . $maxrep . ";
     var ui_loading = '" . $LANG['ui_loading'] . "';
     var submit = '" . $LANG['forms_button_submit'] . "';
  </script>
 <script src='resources/scripts/handlepost.js?v=2'></script>";
 require_once('footer.php');
?>
