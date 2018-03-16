// Handle comments and fill extra info on modal popup
function comment(pid)
{
  var boxes = $('input, textarea'); var formData = new FormData();
  $('#pcontent').html( $(('.') + pid).html().substr(0, 120) + '...' );
  $('.ccdlg').modal('show');
  var cbutton = $('#submitc');
  formData.append('pid', pid);
  formData.append('nick', $('#nickc').val());
  formData.append('content', $('#contentc').val());
  formData.append('image', $('#imagec').val());
  formData.append('file', $('#filec')[0].files[0]);
  cbutton.click(function ()
  {
    cbutton.prop('disabled', true).html(ui_loading);
    $.ajax({
      url: 'comment.php',
      type: 'POST',
      dataType: 'html',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data == 'Limited')
        {
          ratel();
        }
        else
        {
          $('.ccdlg').modal('hide');
          var eid = $('#' + pid).find('.card-footer'); var newclass = 'newcomment';
          if ($('#filec').val())
          {
           window.location.reload();
          }
          eid.after(''
          + '<div class="comments card bg-gradient-dark text-white pb-4 ' + newclass + '">'
          + '<div class="cheader card-header">' + (($('#nickc').val().length < 1 ) ? "<i>" + no_nick + "</i>": $('#nickc').val()) + ' ' + comment_after_nick + '</div>'
          + '<div class="card-body">' + $('#contentc').val() + '</div>'
          + (!($('#imagec').val().length < 1) ? '<div class="imgcontainer mx-auto"><img class="img-thumbnail" src="' + $('#imagec').val() + '" alt="' + alt_broken_image + '"></div>"' : ''));
          $('.' + newclass).fadeIn(atimeb).removeClass('.' + newclass);
        };
        setTimeout (function ()
        {
          boxes.val('').prop('disabled', false);
          cbutton.html(submit).prop('disabled', false);
        }, dynloadint);
      }
    });
  });
}

// Handle the modal image upload mode (local/remote).
var remotec = false;
function togglemethodc() {
 if (remotec)
 {
  $('#tmc').html('Upload image from your device');
  $('#imagec').css('display', 'block'); $('#filec').css('display', 'none');
  remotec = false;
 }
 else
 {
  $('#tmc').html('Post remote image');
  $('#imagec').css('display', 'none'); $('#filec').css('display', 'block');
  remotec = true;
 }
};

$(document).ready(function() {
 $('#tmc').on('click', function() {
  togglemethodc();
 });
});
