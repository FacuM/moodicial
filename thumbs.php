<?php
require_once("config.php");
session_start();
if (isset($_SESSION['lastinteraction']))
{
 $time = microtime(true) -  $_SESSION['lastinteraction'];
}
if (isset($_SESSION['lastinteraction']) && $time < $throttletime / 1000)
{
  die('Limited');
}
else
{
 if (isset($_POST['action']) && isset($_POST['pid']) && $thumbsmod)
 {
  $_SESSION['lastinteraction'] = microtime(true);
  $server->query("UPDATE `" . $credentials['ptable'] . "` SET " . ($_POST['action'] === 'false' ? '`down`=down+1' : '`up`=up+1') . " WHERE pid = " . $server->quote($_POST['pid']));
  echo $server->query("SELECT * FROM " . $credentials['ptable'] . " WHERE pid = " . $server->quote($_POST['pid']))->fetch()[($_POST['action'] === 'false' ? 'down' : 'up')];
 }
 else
 {
  header('location: ' . $root);
 }
}
?>