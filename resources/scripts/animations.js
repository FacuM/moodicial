// Keep growing the bar till it reaches 100%.
function showload()
{
 {
  $('#pbarc').fadeIn(atimeb);
  setTimeout( function()
  {
   $('.progress-bar').animate({ width: '100%'}, atimeb);
  }, atimeb);
};

function hideload()
{
 $('#pbarc').fadeOut(atimeb);
 $('.progress-bar').css('width', '0%');
};
