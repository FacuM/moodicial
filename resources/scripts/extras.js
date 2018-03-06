// Dummy variables
var scrolling = false; var doload = true; var original = $('#langbadge').html();

$('#langbadge').fadeToggle(atimeb);
setTimeout(function() {
 $('#langbadge').html(hint);
 $('#langbadge').fadeToggle(atimeb);
 }, atimeb);
setTimeout(function() {
$('#langbadge').fadeToggle(atimeb);
 setTimeout(function() {
  $('#langbadge').html(original);
  $('#langbadge').fadeToggle(atimeb);
 }, atimeb);
}, atimeb * 4);

function langsel(newhtml)
{
 $('#langbadge').fadeOut(atimeb);
 setTimeout(function() {
 $('#langbadge').replaceWith(''
 +  '<div class="badge badge-primary float-left langlink" id="langbadge">'
 +   '<a href="?lang=en" id="langlink">EN</a>'
 +  '</div>'
 +  '<div class="badge badge-primary float-left langlink" id="langlink">'
 +   '<a href="?lang=es" id="langlink">ES</a>'
 +  '</div>'
 +  '<div class="badge badge-primary float-left langlink" id="langlink">'
 +   '<a href="?lang=pt" id="langlink">PT</a>'
 +  '</div>');
 $('.langlink').css('display', 'none');
 $('.langlink').html(newhtml);
 $('#langbadge').prop('onclick', null).off('click');
 $('.langlink').fadeIn(atimeb);
}, atimeb);
};

function gotop()
{
 scrolling = true;
 $("html, body").animate({ scrollTop: 0 }, atime);
 $('#gotop').fadeOut(atimeb);
 setTimeout(function ()
 {
   scrolling = false;
 }, atime);
}

var dynamicload = setInterval (
 function()
 {
  $.get('fetchdata.php?&row=new&oldpid=' + $('.posts').first().attr('id') + '&', function(newdata)
  {
   if(!(newdata === '')) { $('.posts').first().before(newdata); $('.posts').first().css('display', 'none'); $('.posts').first().fadeIn(atime); };
 });
}, dynloadint);

if($('.posts').length > 1)
{
 $('.posts').last().attr('id', 'last');
};

$(window).scroll(function (event) {
 {
  if (doload)
  {
   if($(window).scrollTop() + $(window).height() >= $(document).height() - offset)
  $('#load').css('display', 'block');
  $.get('fetchdata.php?&row=' + amountpage + '&', function(data)
  {
    if(data === '') { doload = false; $('#load').css('display', 'none'); $('#end').fadeIn(atime); }
    $('#last').append(data);
  });
  amountpage = amountpage + 1;
  };
  if($(window).scrollTop() > 0 && !scrolling)
  {
   $('#gotop').fadeIn(atimeb);
  }
  else
  {
   $('#gotop').fadeOut(atimeb);
  }
 };
});

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
});

function comment(pid)
{
  $('#pcontent').html( $(('.') + pid).html().substr(0, 120) + '...' );
  $('.ccdlg').modal('show');
  $('#submitc').click(function ()
  {
   $('#submitc').prop('disabled', true);
   $('#submitc').html(ui_loading);
   $.ajax({
     url: 'comment.php',
     type: 'POST',
     data: {
       content: $('#contentc').val(),
       nick: $('#nickc').val(),
       image: $('#imagec').val(),
       pid: pid,
     },
     success: function() {
       $('.ccdlg').modal('hide');
       window.location.reload();
     }
   });
 });
}

function report(pid)
{
 $.ajax({
   url: 'report.php',
   type: 'POST',
   data: {
     report: pid
   },
   success: function(data) {
     if (parseInt(data) >= maxrep)
     {
      window.location.reload();
     }
     else
     {
      var eid = '#rid' + pid; var newstatus = '';
      if (parseInt(data) == 0)
      {
       newstatus = 'badge-success';
      }
      else if (parseInt(data) <= (maxrep / 2))
      {
        newstatus = 'badge-warning';
      }
      else
      {
        newstatus = 'badge-danger';
      }
      $(eid).removeClass('badge-success','badge-warning','badge-danger').addClass(newstatus);
      $(eid).html(parseInt(data) + '/' + maxrep);
     }
   }
 });
};
