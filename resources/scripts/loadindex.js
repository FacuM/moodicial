// Make objects out of the DOM elements we're gonna modify.

var title = $('#title'); var misc = $('#pbarc, #loader'); var time, interval = null; var glowtime = 1000;

// This function retrieves the full page.
function requester()
{
  var size = 0; var stime = performance.now();
  interval = setInterval( function() {
    $('.progress-bar').css('width', size + '%');
    title.toggleClass('glow_off');
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
  if (maintenance)
  {
    // Set up the highest amount of values possible in a single time.
    var body = $('body'); var retrytime = dynloadint * 4; var maintenance_label = title.html() + ' is under maintenance, please come back later.';
    body.animate({ backgroundColor: 'white' }, atime);
    title.animate({ color: 'black'}, atime);
    body.append('<div class="alert alert-info align-middle mx-auto" id="maintenance">' + maintenance_label + ' Retrying in ' + retrytime / 1000 + ' seconds.</div>');
    var maintenance_element = $('#maintenance');
    setTimeout(function () {
      maintenance_element.fadeIn(atime);
    }, atime * 2);
    setInterval(function (){
      maintenance_element.html(maintenance_label + ' Retrying...');
      setTimeout(function ()
      {
        $.ajax({
          url: 'index.php',
          type: 'POST',
          data: {
            testav: true
          },
          success: function(testing)
          {
            if (testing == 'yes')
            {
              window.location.reload();
            }
            else
            {
              maintenance_element.html(maintenance_label + ' Still unavailable, retrying in ' + retrytime / 1000 + ' seconds.')
            }
          }
        });
      }, atime);
    }, retrytime);
  }
  else
  {
    setTimeout(function() {
      title.addClass('glow');
      misc.fadeIn(atimeb);
      requester();
    }, atime);
  };
};

// This function makes the final animations and replaces the whole page with the one that'll be passed by the Ajax request.
function succeded(data)
{
  title.addClass('glow_off')
  setTimeout( function() {
    title.removeClass('glow glow_off');
  }, glowtime);
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
