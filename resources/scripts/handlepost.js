$('#submitp').click(function ()
{
    var boxes = $('input, textarea'); var formData = new FormData();
    $(this).prop('disabled', true).html(ui_loading);
    boxes.prop('disabled', true);
    formData.append('nick', $('#nick').val());
    formData.append('content', $('#content').val());
    formData.append('image', $('#image').val());
    formData.append('file', $('input[type=file]')[0].files[0]);
    $.ajax({
      url: 'create.php',
      type: 'POST',
      dataType: 'html',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(processing) {
        if (processing == 'Limited')
        {
          ratel();
        };
        var button = $('#submitp');
        setTimeout (function ()
        {
          boxes.val('').prop('disabled', false);
          button.html(submit).prop('disabled', false);
        }, dynloadint);
        $('.cpdlg').modal('hide');
      }
    });
  if (firstpost)
  {
    window.location.reload();
  }
});

function ratel()
{
  $('.posts').first().prepend("<div class='alert alert-warning mx-auto ratel'>" + rate_limited + "</div>").css('display', 'none').fadeIn(atimeb);
  setTimeout(function() {
    $('.ratel').fadeOut(atime);
  }, atime * 2);
}
