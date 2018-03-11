<?php
require_once("config.php");
session_start();
$time = microtime(true) -  $_SESSION['lastinteraction'];
if (isset($_SESSION['lastinteraction']) && $time < $throttletime / 1000)
{
  die('Limited');
}
else
{
 $server->query("UPDATE `" . $credentials['ptable'] . "` SET " . (isset($_POST['action']) && $_POST['action'] ? '`up`=up+1' : '`down`=down+1') . "WHERE pid = " . $server->quote($_POST['pid']));
 echo $server->query("SELECT * FROM " . $credentials['ptable'] . " WHERE pid = " . $server->quote($_POST['pid']))->fetch[($_POST['action'] ? 'up' : 'down')];
}
?>