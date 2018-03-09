// Make objects out of the DOM elements we're gonna modify.

var title = $('#title'); var misc = $('#pbarc, #loader'); var time, interval = null;

// This function retrieves the full page.
function requester()
{
  var size = 0; var stime = performance.now();
  interval = setInterval( function() {
    $('.progress-bar').css('width', size + '%');
    var etime = performance.now();
    time = etime - stime;
    // If time taken is greater than 5 seconds, show a warning.
    if (time >= maxload && !$('.alert-warning').length)
    {
      $('body').append("<div class='alert alert-warning' id='loader'>" + server_lag + " Took <span id='time'>" + (time / 1000).toString().substr(0, 5) + "</span> seconds.</div>")
      // Recreate the object including the new element.
      misc = $('#pbarc, #loader');
      misc.fadeIn(atimeb /2);
    };
    size++;
    $('#time').html((time / 1000).toString().substr(0, 5));
  }, atimeb);
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
  $('.progress-bar').animate({ backgroundColor : '#77B300' }, atime).css('width', '100%');
  setTimeout( function () {
    misc.fadeOut(atimeb /2);
    setTimeout(function ()
    {
      title.animate({ 'marginTop' : '0px'}, atimeb /2);
      setTimeout(function ()
      {
        $('body').fadeOut(atimeb);
        setTimeout(function ()
        {
          document.open();
          document.write(data);
          document.close();
        }, atimeb);
      }, atimeb / 2);
    }, atimeb / 2);
  }, atimeb * 2);
}

// This function serves as a handler whenever the server can't process the request.
function error()
{
  misc.fadeOut(atimeb);
  setTimeout( function()
  {
    $(document.body).append('<div class="alert alert-danger mx-auto fixed-bottom" id="err">' + server_err + '</div>');
    $('#err').fadeIn(atimeb);
  }, atimeb);
}
