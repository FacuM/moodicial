<?php
 if ($language == 'auto' && !isset($_SESSION['lang']))
 {
  // Automatic language detection code block
  if (isset($_GET['lang']))
  {
   $lang = $_GET['lang'];
  }
   $language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
   $language = explode('-', $language[0]);
  if (isset($lang))
  {
   if(session_status() == PHP_SESSION_NONE)
   {
    session_start();
   }
   $language[0] = $lang;
   $_SESSION['lang'] = $lang;
  }
  else
  {
   if(session_status() == PHP_SESSION_NONE)
   {
    session_start();
   }
   if (isset($_SESSION['lang']))
   {
    $language[0] = $_SESSION['lang'];
   }
  }
  if (isset($_GET['lang']) || isset($language[0]))
  {
   switch ($language[0]) {
     case 'en':
       $language = 'en_US';
       break;
     case 'es':
       $language = 'es_LA';
       break;
     case 'pt':
       $language = 'pt_BR';
       break;
     case 'bg':
       $language = 'bg_BG';
       break;
     default:
       $language = 'en_US';
       break;
   }
  }
  else {
   $language = 'en_US';
  }
 }
?>
