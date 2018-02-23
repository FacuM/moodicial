<?php

if ((isset($_GET['file'])) && $_GET['file'] != 'config.php')
{
 $data = fopen("$_GET[file]",'r');
 while ($line = fgets($data)) {
  $line = strip_tags($line);
  echo($line) . '<br>';
 }
 fclose($data);
}
else
{
 require_once("config.php");
 require_once("head.php");
 require_once("beginning.php");
 echo "
 <script type='text/javascript'>
  window.location = '$root';
  </script>";
  }
?>