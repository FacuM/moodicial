<?php
 if ($language == 'auto')
 {
  // Automatic language detection code block

  $language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
  if (isset($language[2]))
  {
   $language = explode(';', $language[2]);
   $language = str_replace('-', '_', $language[0]);

   switch ($language) {
     case 'es_AR':
       $language = 'es_LA';
       break;
     case 'es_MX':
       $language = 'es_LA';
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
