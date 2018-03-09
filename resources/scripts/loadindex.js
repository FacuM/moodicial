// Make objects out of the DOM elements we're gonna modify.

var title = $('#title'); var misc = $('#pbarc, #loader'); var interval = null;

// This function retrieves the full page.
function requester()
{
  var size = 0;
  interval = setInterval( function() {
   $('.progress-bar').css('width', size + '%');
   size++;
  }, 150);
  $.ajax({
    url: 'main.php',
    type: 'POST',
    data: {
      loading: true,
    },
    success: function(data)
    {
      setTimeout(function()
      {
        succeded(data);
      }, atime);
    },
    error: function()
    {
     error();
    }
  });
}

// This function makes the first animation.
function loader()
{
  title.animate({ 'marginTop' : $(window).height() / 3 }, atime);
  setTimeout(function() {
    $(misc).fadeIn(atimeb);
    requester();
  }, atimeb);
};

// This function makes the final animations and replaces the whole page with the one that'll be passed by the Ajax request.
function succeded(data)
{
  clearInterval(interval);
  $('.progress-bar').animate({ backgroundColor : '#77B300', width: '100%' }, atime);
  setTimeout( function () {
  misc.fadeOut(atimeb);
  setTimeout(function ()
  {
    title.animate({ 'marginTop' : '0px'}, atimeb);
  setTimeout(function ()
  {
    $('body').fadeOut(atimeb);
    setTimeout(function ()
    {
      document.open();
      document.write(data);
      document.close();
    }, atimeb);
  }, atime);
}, atimeb);
}, atimeb * 4);
}

// This function serves as a handler whenever the server can't process the request.
function error()
{
  misc.fadeOut(atimeb);
  setTimeout( function()
  {
    $(document.body).append('<div class="alert alert-danger mx-auto fixed-bottom" id="err">Couldn\'t complete the request. Please try again later.</div>');
    $('#err').fadeIn(atimeb);
  }, atimeb);
}
