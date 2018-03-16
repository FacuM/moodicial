// Handle comments and fill extra info on modal popup
function comment(pid)
{
  var boxes = $('input, textarea');
  $('#pcontent').html( $(('.') + pid).html().substr(0, 120) + '...' );
  $('.ccdlg').modal('show');
  var cbutton = $('#submitc');
  cbutton.click(function ()
  {
    cbutton.prop('disabled', true).html(ui_loading);
    $.ajax({
      url: 'comment.php',
      type: 'POST',
      data: {
        content: $('#contentc').val(),
        nick: $('#nickc').val(),
        image: $('#imagec').val(),
        pid: pid,
      },
      success: function(data) {
        if (data == 'Limited')
        {
          ratel();
        }
        else
        {
          $('.ccdlg').modal('hide');
          var eid = $('#' + pid).find('.card-footer'); var newclass = 'newcomment';
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
