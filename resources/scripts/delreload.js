// Delayed reload module (animate before real reload).

function delreload()
{
 $('body').fadeOut(atimeb);
 setTimeout( function()
 {
  window.location.href = root;
 },atimeb);
}
