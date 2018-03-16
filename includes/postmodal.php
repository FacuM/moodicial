<?php
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
           <form enctype='multipart/form-data' method='post' id='post' action='create.php'>
            <input type='hidden' name='MAX_FILE_SIZE' value='30000' />
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
                <input class='image form-control' type='text' name='image' id='image' style='display: none'>
              </div>
              <div class='form-group mx-auto'>
               <input name='file' class='form-control-file' id='file' type='file'>
               <br><button class='btn btn-primary' type='button' name='button' id='tm'>Post remote image</button>
              </div>
          </div>
          <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
            <button type='button' class='btn btn-primary' id='submitp'>" . $LANG['forms_button_submit'] . "</button>
        </div>
      </div>
     </form>
    </div>
   </div>
 ";
?>
