function redesign(newhtml)
{
 $('#langbadge').fadeOut(1500);
 setTimeout(function() {
 $('#langbadge').removeClass('badge-info'); $('#langbadge').addClass('badge-secondary');
 $('#langbadge').html(newhtml);
 $('#langbadge').prop('onclick', null).off('click');
 $('#langbadge').fadeIn(1500);
}, 1500);
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
 $("html, body").animate({ scrollTop: 0 }, 2500);
}

var dynamicload = setInterval (
 function()
 {
  $.get('fetchdata.php?&row=new&oldpid=' + $('.posts').first().attr('id') + '&', function(newdata)
  {
   newcontent = newdata;
   if(!(newcontent === '')) { $('.posts').first().before(newcontent); $('.posts').first().css('display', 'none'); $('.posts').first().fadeIn(1500); };
 });
}, 2500);

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
    content = data;
    if(content === '') { $(window).off('scroll'); $('#load').css('display', 'none'); $('#end').fadeIn(500); }
    $('#last').append(content);
  });
  amountpage = amountpage + 1;
 };
});
