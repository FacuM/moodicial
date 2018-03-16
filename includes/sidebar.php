<?php
 echo
 "
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
      <form enctype='multipart/form-data' method='post' id='post' action='comment.php'>
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
       <div class='form-group mx-auto'>
        <input name='file' class='form-control-file' id='filec' type='file'>
        <br><button class='btn btn-primary' type='button' name='button' id='tmc'>Post remote image</button>
       </div>
       <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
        <button type='button' class='btn btn-primary' id='submitc'>" . $LANG['forms_button_submit'] . "</button>
       </div>
     </div>
    </form>
   </div>
  </div>
 </div>
 ";
?>
