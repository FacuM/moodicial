$('#submitp').click(function ()
{
 $(this).prop('disabled', true);
 $(this).html(ui_loading);
 $.ajax({
   url: 'create.php',
   type: 'POST',
   data: {
     content: $('#content').val(),
     nick: $('#nick').val(),
     image: $('#image').val(),
   },
   success: function() {
    var button = $('#submitp');
    setTimeout (function ()
    {
     button.html(forms_button_submit);
     button.prop('disabled', false);
    }, dynloadint);
    $('.cpdlg').modal('hide');
   }
 });
 if (firstpost)
 {
  window.location.reload();
 }
});
