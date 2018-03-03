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
