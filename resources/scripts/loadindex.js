// Make objects out of the DOM elements we're gonna modify.

var title = $('#title'); var misc = $('#pbarc, #loader');

// This function retrieves the full page.
function requester()
{
  $('.progress-bar').animate({ 'width' : '100%' }, atime);
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
  misc.fadeOut(atimeb);
  setTimeout(function ()
  {
    title.animate({ 'marginTop' : '0px'}, atimeb);
  setTimeout(function ()
  {
    var doc = $('body');
    doc.fadeOut(atimeb);
    setTimeout(function ()
    {
      doc.html(data).fadeIn(atimeb);
    }, atime);
  }, atime);
}, atimeb);
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
