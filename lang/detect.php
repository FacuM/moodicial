<?php
 // Automatic language detection code block

 $langs = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
 $langs = explode(';', $langs[2]);
 $language = str_replace('-', '_', $langs[0]);

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
?>
