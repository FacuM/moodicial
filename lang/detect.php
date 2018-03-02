<?php
 if ($language == 'auto')
 {
  // Automatic language detection code block

  $language = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
  $language = explode('-', $language[0]);
  if (isset($language[0]))
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
