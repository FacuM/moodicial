<?php
 require_once("lang/detect.php");
 if (isset($language) && file_exists("lang/" . $language . ".php"))
 {
  require_once("lang/" . $language . ".php");
 }
 else
 {
  require_once("lang/en_US.php");
 }
 // Detect required third part content availability.
 function availdet($url)
 {/*
  if (!isset($GLOBALS['failed']))
  {
   // NOTE: Global variable will be 'true' every time this function returns 'false'.
   $c = curl_init($url);
   curl_setopt($c, CURLOPT_NOBODY, true);
   $r = curl_exec($c);

   if ($r !== false)
   {
    $failed = false;
    $GLOBALS['final'] = $url;
    return true;
   }
   else
   {
    $failed = true;
    $GLOBALS['nocdn'] = true;
    return false;
   }

   curl_close($c);
  }
  else
  {
   if (!$failed)
   {
    $GLOBALS['final'] = $url;
    return true;
   }
   else
   {
    $GLOBALS['nocdn'] = true;
    return false;
   }
  }
  */
  // NOTE: Looking on a faster solution.
  $GLOBALS['final'] = $url;
  return true;
 }
 // If the whole page is requested ($noformat = false), use ternary operators and the previously defined 'availdet' function to detect whether CDNs are reachable or not.
 if (!$noformat)
 {
  echo "<!DOCTYPE html>
  <html>
  <head>
   <title>$info[title]</title>
   <meta charset='utf-8'>
   <meta name='theme-color' content='#060606'>
   <meta name='viewport' content='width=device-width, initial-scale=1'>
   <link rel='apple-touch-icon' sizes='76x76' href='/resources/favicons/apple-touch-icon.png'>
   <link rel='icon' type='image/png' sizes='32x32' href='/resources/favicons/favicon-32x32.png'>
   <link rel='icon' type='image/png' sizes='16x16' href='/resources/favicons/favicon-16x16.png'>
   <link rel='manifest' href='/resources/favicons/site.webmanifest'>
   <link rel='mask-icon' href='/resources/favicons/safari-pinned-tab.svg' color='#5bbad5'>
   <link href='" . (availdet('https://fonts.googleapis.com/css?family=Open+Sans') ? 'https://fonts.googleapis.com/css?family=Open+Sans' : $tpdir . '/opensans.css') . "' rel='stylesheet'>
   <meta name='msapplication-TileColor' content='#da532c'>
   <meta name='theme-color' content='#ffffff'>
   <link rel='stylesheet' href='" . (availdet('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css') ? $final : $tpdir . '/bootstrap.min.css') . "' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
   <link rel='stylesheet' href='" . (availdet('https://bootswatch.com/4/cyborg/bootstrap.min.css') ? $final : $tpdir . '/bootstrap_cyborg.min.css') . "'>
   <link rel='stylesheet' href='" . (availdet('https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.min.css') ? $final : $tpdir . '/octicons.min.css') . "'>
   <link rel='stylesheet' href='resources/style/mod.css?v=3'>
   <script src='" . (availdet('https://code.jquery.com/jquery-3.3.1.min.js') ? $final : $tpdir . '/jquery-3.3.1.min.js') . "' integrity='sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=' crossorigin='anonymous'></script>
   <script src='" . (availdet('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') ? $final : $tpdir . '/popper.min.js') . "' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
   <script src='" . (availdet('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') ? $final : $tpdir . '/bootstrap.min.js') . "' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
  </head>
  ";
 }
 function sendLoader($amountpage,$offset,$atime,$atimeb,$dynloadint,$hint)
 {
  echo "
    <script>
     var amountpage = " . $amountpage . ";
     var offset = " . $offset . ";
     var atime = " . $atime . ";
     var atimeb = " . $atimeb . ";
     var dynloadint = " . $dynloadint . ";
     var hint = '" . $hint . "';
   </script>
   <script src='resources/scripts/extras.js?v=3'></script>
  ";
 }
?>
