<?php
 echo "<html>
 <head>
  <title>$info[title]</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='apple-touch-icon' sizes='76x76' href='/resources/favicons/apple-touch-icon.png'>
  <link rel='icon' type='image/png' sizes='32x32' href='/resources/favicons/favicon-32x32.png'>
  <link rel='icon' type='image/png' sizes='16x16' href='/resources/favicons/favicon-16x16.png'>
  <link rel='manifest' href='/resources/favicons/site.webmanifest'>
  <link rel='mask-icon' href='/resources/favicons/safari-pinned-tab.svg' color='#5bbad5'>
  <meta name='msapplication-TileColor' content='#da532c'>
  <meta name='theme-color' content='#ffffff'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
  <link rel='stylesheet' href='https://bootswatch.com/4/cyborg/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.min.css'>
  <link rel='stylesheet' href='mod.css'>
 </head>
 ";
 function loadscripts()
 {
 echo "
  <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
  <script src='https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js'></script>
  <script type='text/javascript'>
   $('.posts').infiniteScroll({
   // options
   path: '/?p={{#}}',
   append: '.posts',
   prefill: true,
   history: false,
   status: '.page-load-status',
   });
  </script>
 ";
 }
?>
