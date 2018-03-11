$(document).ready( function() {

// Dummy variables
var scrolling = false; var doload = true; var original = $('#langbadge').html();

// Language badge initial animation (delayed to allow render completion)
setTimeout(function ()
{
  $('#langbadge').fadeOut(atimeb);
  setTimeout(function() {
    $('#langbadge').html(hint);
    $('#langbadge').fadeIn(atimeb);
  }, atimeb);
  setTimeout(function() {
    $('#langbadge').fadeOut(atimeb);
    setTimeout(function() {
      $('#langbadge').html(original);
      $('#langbadge').fadeIn(atimeb);
    }, atimeb);
  }, atimeb * 4);
}, atime);

// Language badge animation + language picker generator
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

// Go to the top of the page
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

// Dynamically load new posts and prepend them to the first one
var dynamicload = setInterval (
 function()
 {
   $.ajax({
    url: 'fetchdata.php',
    type: 'POST',
    data: {
      row: 'new',
      oldpid: $('.posts').first().attr('id')
    },
    success: function(newdata){
      if(!(newdata === '')) { $('.posts').first().before(newdata); $('.posts').first().css('display', 'none'); $('.posts').first().fadeIn(atimeb); $('#update').clearQueue().css('display', 'block').animate({ 'marginTop' : '3rem' }); };
    }
   });
}, dynloadint);

// Dynamically load old posts while reaching the bottom of the page
$(window).scroll(function (event) {
 {
  if (doload)
  {
   if($(window).scrollTop() + $(window).height() >= $(document).height() - offset)
   {
   doload = false;
   $('#load').css('display', 'block');
   $.ajax({
    url: 'fetchdata.php',
    type: 'POST',
    data: {
	  row: amountpage
    },
    success: function(data)
    {
     if(data === '') { doload = false; $('#load').css('display', 'none'); $('#end').fadeIn(atime); } else { doload = true; };
     $('.posts').last().after(data);
     amountpage = amountpage + 1;
    }
   });
   };
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

// Handle comments and fill extra info on modal popup
function comment(pid)
{
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
     success: function() {
       $('.ccdlg').modal('hide');
       window.location.reload();
     }
   });
 });
}

// Handle reporting
function report(pid)
{
  $.ajax({
    url: 'report.php',
    type: 'POST',
    data: {
      report: pid
    },
    success: function(data) {
      if (data == 'Limited')
      {
        var report_button_color = $('.btn-danger').css('backgroundColor'); var report_label_original = $('.btn-danger').first().html(); var report_buttons = $('.btn-danger');
        report_buttons.prop('disabled', true).animate({ 'borderColor' : '#dddddd' , 'backgroundColor' : '#dddddd' }, atimeb)
        setTimeout(function()
        {
         report_buttons.html(rate_limited_sm);
        }, atimeb);
        setTimeout(function()
        {
          report_buttons.prop('disabled', false).animate({ 'borderColor' : report_button_color, 'backgroundColor' : report_button_color }, atimeb);
          setTimeout(function()
          {
           report_buttons.html(report_label_original);
          }, atimeb);
        }, throttletime);
      }
      else
      {
        if (parseInt(data) - 1 >= maxrep)
        {
          window.location.reload();
        }
        else
        {
          var eid = $('#' + pid).find('.badge'); var newstatus = '';
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
      };
    }
  });
};

// Hide the element that's passed through this function.

function hideupd()
{
 $('#update').clearQueue().animate({ 'marginTop' : '-3rem' }).fadeOut(atimeb);
};

});
