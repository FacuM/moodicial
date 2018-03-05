// Dummy variables
var scrolling = false; var doload = true; var original = $('#langbadge').html();

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

function langsel(newhtml)
{
 $('#langbadge').fadeOut(atimeb);
 setTimeout(function() {
 $('#langbadge').replaceWith(''
 + '<div class="badge badge-primary float-left" id="langbadge">'
 +  '<a href="?lang=en" id="langlink">EN</a>'
 + '</div>'
 + '<div class="badge badge-primary float-left" id="langlink">'
 +  '<a href="?lang=es" id="langlink">ES</a>'
 + '</div>'
 + '<div class="badge badge-primary float-left" id="langlink">'
 +  '<a href="?lang=pt" id="langlink">PT</a>'
 + '</div>');
 $('#langbadge').html(newhtml);
 $('#langbadge').prop('onclick', null).off('click');
 $('#langbadge').fadeIn(atimeb);
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

$('#submit').click(function ()
{
 $(this).prop('disabled', true);
 $(this).html('Loading...');
 $.ajax({
   url: 'create.php',
   type: 'POST',
   data: {
     content: $('#content').val(),
     nick: $('#nick').val(),
     image: $('#image').val(),
   },
   success: function() {
    var button = $('#submit');
    setTimeout (function ()
    {
     button.html('Submit');
     button.prop('disabled', false);
    }, dynloadint);
    $('.cpdlg').modal('hide');
   }
 });
});
