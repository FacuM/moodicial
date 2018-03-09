$('#submitp').click(function ()
{
 var boxes = $('input, textarea');
 $(this).prop('disabled', true).html(ui_loading);
 boxes.prop('disabled', true);
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
