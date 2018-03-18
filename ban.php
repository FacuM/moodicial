<?php
 require_once("config.php");
 // Simple jQuery powered IP-ban system.
 if(isset($_POST['password']) && $_POST['password'] == $credentials['password'])
 {
   if(isset($_POST['ip']) && isset($_POST['reason']))
   {
    $server->query('INSERT INTO `moodicial_banned` (`ip`, `reason`) VALUES (' . $server->quote($_POST['ip']) . ', ' . $server->quote($_POST['reason']) . ')');
   }
   else
   {
    echo 'IP address or reason weren\'t specified, please provide one.';
   }
 }
 else
 {
  echo "Wrong password, please try again.";
 }
?>
