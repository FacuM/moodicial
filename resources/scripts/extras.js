function redesign(newhtml)
{
 $('#langbadge').removeClass('badge-info'); $('#langbadge').addClass('badge-secondary');
 $('#langbadge').html(newhtml);
 $('#langbadge').prop('onclick', null).off('click');
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
