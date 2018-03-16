// Dummy variables
var scrolling = false; var doload = true; var original = $('#langbadge').html();

// Show sidebar and interactive elements ONLY if JS support is present.
function showall() {
 $('.sidebarbtns').fadeIn(atimeb);
 $('.jsrq').css('display', 'block');
};

$(document).ready(function() {
 showall();
});

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
    +  '</div>'
    +  '<div class="badge badge-primary float-left langlink" id="langlink">'
    +   '<a href="?lang=bg" id="langlink">BG</a>'
    +  '</div>');
    $('.langlink').css('display', 'none');
    $('.langlink').html(newhtml);
    $('#langbadge').prop('onclick', null).off('click');
    $('.langlink').fadeIn(atimeb);
  }, atimeb);
};

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
      $('#langbadge').on('click', function()
      {
        langsel();
      });
    }, atimeb);
  }, atimeb * 4);
}, atime);

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
        if(!(newdata === ''))
        {
         $('.posts').first().before(newdata);
         $('.posts').first().css('display', 'none');
         $('.posts').first().fadeIn(atimeb);
         $('#update').clearQueue().css('display', 'block').animate({ 'marginTop' : '3rem' });
         showall();
       };
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
            var eid = $('#' + pid).find('#rbg'); var newstatus = '';
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
            $('#' + pid).find('#rbg').removeClass('badge-success badge-warning badge-danger').addClass(newstatus);
            $('#' + pid).find('#rbg').html(parseInt(data) + '/' + maxrep);
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

  // Process thumbs up and down sending
  function react(thumbs, pid)
  {
    $.ajax({
      url: 'thumbs.php',
      type: 'POST',
      data: {
        action: thumbs,
        pid: pid
      },
      success: function(data)
      {
        var idr = $('#' + pid).find('.down, .up');
        if (data == 'Limited')
        {
          idr.animate({ backgroundColor: 'red' }, atime);
          setTimeout( function() {
            idr.animate({ backgroundColor: '#555' }, atime);
          }, throttletime);
        }
        else
        {
          if (thumbs)
          {
            idr = $('#' + pid).find('.up');
            idr.html(data);
          }
          else
          {
            idr = $('#' + pid).find('.down');
            idr.html(data);
          };
        };
      }
    });
  };

 var remote = false;
 function togglemethod() {
  if (remote)
  {
   $('#tm').html('Upload image from your device');
   $('#image').css('display', 'block'); $('#file').css('display', 'none');
   remote = false;
  }
  else
  {
   $('#tm').html('Post remote image');
   $('#image').css('display', 'none'); $('#file').css('display', 'block');
   remote = true;
  }
 };

 $('#tm').on('click', function() {
  togglemethod();
 });
