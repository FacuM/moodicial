function redesign(newhtml)
{
 $('#langbadge').fadeOut(atimeb);
 setTimeout(function() {
 $('#langbadge').removeClass('badge-info'); $('#langbadge').addClass('badge-secondary');
 $('#langbadge').html(newhtml);
 $('#langbadge').prop('onclick', null).off('click');
 $('#langbadge').fadeIn(atimeb);
}, atimeb);
};

function badgefun()
{
 switch ($('#lang').html())
 {
  case 'en_US':
   redesign('English (United States)');
   break;
  case 'es_LA':
   redesign('Español (Latinoamérica)');
   break;
  case 'pt_BR':
   redesign('Português (Brasil)');
   break;
  default:
   console.log('If you are reading this, I shouldn\'t even try to write an easter egg.');
 };
};

function gotop()
{
 $("html, body").animate({ scrollTop: 0 }, atime);
 $('#gotop').fadeOut(atimeb);
 setTimeout(function() {
   $('#gotop').fadeIn(atimeb);
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
   if($(window).scrollTop() + $(window).height() >= $(document).height() - " . $offset . ")
  $('#load').css('display', 'block');
  $.get('fetchdata.php?&row=' + amountpage + '&', function(data)
  {
    if(data === '') { $(window).off('scroll'); $('#load').css('display', 'none'); $('#end').fadeIn(atime); }
    $('#last').append(data);
  });
  amountpage = amountpage + 1;
 };
});
